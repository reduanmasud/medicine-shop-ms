<?php

class Customer
{
    private $shop;
    private $db;

    public function __construct(Shop $shop)
    {
        $this->shop = $shop;

        if ($this->db == null) {
            try {
                $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE . '', DB_USER, DB_PASSWORD);
            } catch (PDOException $e) {
                print_r($e);
            }
        }
    }

    public function addCustomer($data)
    {
        array_pop($data);
        $data['shop_id'] = $this->shop->getId();
        try {
            $cols = ' ';
            $params = ' ';
            foreach ($data as $key => $value) {
                $cols .= $key . ',';
                $params .= '? ,';
            }
            
            $cols = substr($cols, 0, -1);
            $params = substr($params, 0, -1);
            $sql = 'INSERT INTO customer ( ' . $cols . ') VALUES (' . $params . ')';

            $stmt = $this->db->prepare($sql);
           
            $dta = [];
            foreach($data as $val)
            {
                array_push($dta, $val);
            }
            $stmt->execute($dta);

            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getAllCustomers()
    {
        $sql = 'SELECT * FROM `customer` WHERE `shop_id` = ?';
        $stmt = $this->db->prepare("$sql");
        $stmt->execute([$this->shop->getId()]);

        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }



    public function getCustomerByShopAndId($id)
    {
        $sql = 'SELECT * FROM `customer` WHERE `shop_id` = ? AND `id` = ?';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$this->shop->getID(), $id]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);


        return $res;
    }

    public function getAllCustomersByShopId($id)
    {
        $sql = 'SELECT * FROM `customer` WHERE `shop_id` = ?';
        $stmt = $this->db->prepare("$sql");
        $stmt->execute([$id]);

        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }
}
