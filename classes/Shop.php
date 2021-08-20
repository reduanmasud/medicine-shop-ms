<?php

class Shop
{
    private $owner;
    private $db;
    private $shop;

    public function __construct($user)
    {
        $this->owner = $user;
        if ($this->db == null) {
            $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE . '', DB_USER, DB_PASSWORD);
        }

        $this->shopByUserId($user['id']);
    }

    public function sell($data)
    {
        $keys = ['med_id', 'quantity', 'discount', 'paid'];

        foreach ($keys as $value) {
            if (!array_key_exists($value, $data)) {
                return "Warrning:Don't try to manipulate data!!!";
            }
        }

        $num_of_med = count($data['med_id']);
        $sold_item = [];
        $total_price = 0;
        $discount = $data['discount'];
        $paid = $data['paid'];

        $customer_id = null;
        if (array_key_exists('customer_id', $data)) {
            $customer_id = $data['customer_id'];
        }

        for ($i = 0; $i < $num_of_med; $i++) {
            array_push($sold_item, new SoldMedicine($data['med_id'][$i], $data['quantity'][$i], $this->getId()));
            $total_price += $sold_item[$i]->getTotalPrice();
        }

        $temp = [];
        $temp['sold_item'] = $sold_item;
        $temp['discount'] = $discount;
        $temp['paid'] = $paid;
        $temp['customer_id'] = $customer_id;

        $init_invoice_data = [
            'shop_id' => $this->getId(),
            'customer_id' => $customer_id,
            'total' => $total_price,
            'discount' => $discount,
            'paid' => $paid,
            'due' => ($total_price - $paid)
        ];
        $invoice_id = $this->createInvoice($init_invoice_data);

        for ($i = 0; $i < $num_of_med; $i++) {
            $sql = 'INSERT INTO `invoice_med` (`invoice_id`, `medicine_id`, `quantity`, `cost`) VALUES (?, ?, ?, ?)';
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$invoice_id, $sold_item[$i]->getMedId(), $sold_item[$i]->getQuantity(), $sold_item[$i]->getTotalPrice()]);
            $sold_item[$i]->updateStoredQuantity();
        }
    }

    private function createInvoice($data)
    {
        $sql = 'INSERT INTO `invoice` (`shop_id`, `customer_id`, `total`, `discount`, `paid`, `due`) VALUES (?,?,?,?,?,?)';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$data['shop_id'], $data['customer_id'], $data['total'], $data['discount'], $data['paid'], $data['due']]);

        return $this->db->lastInsertId();
    }

    /**
     * SETUP SHOP FUNCTION
     *
     * @param [type] $data
     * @return void
     */
    public function shopSetup($data)
    {
        array_pop($data);

        $data['id'] = $this->owner['id'];
        try {
            $cols = ' ';
            $params = ' ';
            foreach ($data as $key => $value) {
                $cols .= $key . ',';
                $params .= ':' . $key . ',';
            }

            $cols = substr($cols, 0, -1);
            $params = substr($params, 0, -1);

            $sql = 'INSERT INTO shop ( ' . $cols . ') VALUES (' . $params . ')';

            $stmt = $this->db->prepare($sql);
            foreach ($data as $key => $value) {
                $stmt->bindparam(':' . $key, $value);
            }
            $stmt->execute();

            $res = $this->db->prepare("UPDATE users SET `has_shop` = 1 WHERE id = {$this->owner['id']}");
            $res->execute();

            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function update($column, $value)
    {
        $sql = "UPDATE `shop` SET `{$column}`='{$value}' WHERE `id`={$this->owner['id']}";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
    }

    public function shopUpdate($data)
    {
        array_pop($data);
        foreach ($data as $key => $value) {
            $this->update($key, $value);
        }
    }

    //Getters

    public function getHasShop()
    {
        return $this->owner['has_shop'];
    }

    public function inputValue($column)
    {
        if ($this->shop["$column"]) {
            return $this->shop["$column"];
        } else {
            return '';
        }
    }

    private function getMedCost($medId, $Quantity)
    {
        //should have add a security features that checks if the medicine is owned by the shop.
        $sql = 'SELECT * FROM shop_medicine WHERE shop_id = ? AND med_id = ?';
        $res = $this->db->prepare($sql);
        $res->execute([$this->getId(), $medId]);

        $result = $res->fetch(PDO::FETCH_ASSOC);
        $price = $result['price'];
        if ($result['price'] == 0) {
            $sql2 = 'SELECT * FROM medicine WHERE id = ?';
            $res2 = $this->db->prepare($sql2);
            $res2->execute([$medId]);
            $dta = $res2->fetch(PDO::FETCH_ASSOC);
            $price = $dta['unit_price'];
        }

        return $price * $Quantity;
    }

    public function getId()
    {
        return $this->shop['id'];
    }

    //Setters

    public function shopByUserId($id)
    {
        $sql = 'SELECT * FROM shop WHERE id = ?';
        $res = $this->db->prepare($sql);
        $res->execute([$id]);
        $this->shop = $res->fetch(PDO::FETCH_ASSOC);
    }
}
