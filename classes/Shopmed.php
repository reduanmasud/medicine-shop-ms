<?php

class Shopmed extends Medicine
{
    private $user;
    private $shop;

    public function __construct(User $user, Shop $shop)
    {
        $this->user = $user;
        $this->shop = $shop;

        if ($this->db == null) {
            try {
                $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE . '', DB_USER, DB_PASSWORD);
            } catch (PDOException $e) {
                print_r($e);
            }
        }
    }

    public function check()
    {
        return $this->medicineCount();
    }

    public function medicineCount()
    {
        $sql = 'SELECT * FROM `shop_medicine` WHERE `shop_id`=?';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$this->shop->getId()]);

        $count = $stmt->rowCount();

        return $count;
    }



    public function addMedicineHistory()
    {
        $sql = 'SELECT A.*, B.quantity, B.added_time FROM medicine AS A INNER JOIN add_medicine_shop AS B ON A.id = B.med_id WHERE B.shop_id = ? ORDER BY B.added_time DESC';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$this->shop->getId()]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);



        return $res;
        
    }



    public function addMedicineToShop($medID, $quantity)
    {
        
        try{
            $sql = 'SELECT * FROM `shop_medicine` WHERE `shop_id` = ? AND `med_id` = ?';
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$this->shop->getId(), $medID]);
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            $count = $stmt->rowCount();
        }catch(PDOException $e)
        {
            var_dump($e);
        }
        

        $shopID = $this->shop->getId();
        if ($count) {
            $qnty = $res['quantity'] + $quantity;
            $sql = 'UPDATE `shop_medicine` SET `quantity` = ? WHERE `shop_id` = ? AND `med_id` = ?';
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$qnty, $this->shop->getId(), $medID]);

        } else {
            $sql = 'INSERT INTO `shop_medicine`(`med_id`, `shop_id`, `quantity`) VALUES (:medID, :shopID, :quantity)';
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':medID', $medID);
            $stmt->bindparam(':shopID', $shopID);
            $stmt->bindparam(':quantity', $quantity);
            $stmt->execute();
        }


        try{
            $sql = 'INSERT INTO `add_medicine_shop`(`med_id`, `shop_id`, `quantity`) VALUES (:medID, :shopID, :quantity)';
            $stmt1 = $this->db->prepare($sql);
            $stmt1->bindparam(':medID', $medID);
            $stmt1->bindparam(':shopID', $shopID);
            $stmt1->bindparam(':quantity', $quantity);
            $stmt1->execute();


            return $stmt1->rowCount();
            if($stmt1->rowCount())
            return true;
        else
            return false;
        }catch(PDOException $e)
        {
            var_dump($e);
        }



        

        
    }
}
