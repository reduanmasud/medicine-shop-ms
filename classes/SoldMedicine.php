<?php

class SoldMedicine{


    protected $db;
    private $med_id;
    private $quantity;
    private $unit_price;
    private $total_price;
    private $shop_id;
    private $storedQuantity;

    public function __construct($med_id, $quentity, $shop_id = null)
    {
        if ($this->db == null) {
            try {
                $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE . '', DB_USER, DB_PASSWORD);
            } catch (PDOException $e) {
                print_r($e);
            }
        }

        $this->med_id = $med_id;
        $this->quantity = $quentity;
        $this->shop_id = $shop_id;
        $this->unit_price = $this->setUnitPrice($med_id);
        $this->total_price = $this->setTotalPrice();
        $this->storedQuantity = $this->setStoredQuantity();
        return $this->unit_price;
    }


    public function getQuantity()
    {

        return $this->quantity;
    }
    
    public function getMedId()
    {

        return $this->med_id;
    }
    
    public function getTotalPrice()
    {

        return $this->total_price;
    }

    public function updateStoredQuantity()
    {
        $sql = 'UPDATE `shop_medicine` SET `quantity` = ? WHERE med_id = ? AND `shop_id` = ?';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([ ($this->storedQuantity - $this->quantity), $this->med_id, $this->shop_id] );
    }
    
    public function getStoredQuantity()
    {


        return $this->storedQuantity;
    }

    private function setStoredQuantity()
    {
        $sql = 'SELECT quantity FROM `shop_medicine` WHERE `med_id` = ? AND `shop_id` = ?';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$this->med_id, $this->shop_id]);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        return $res['quantity'];
    }

    private function setTotalPrice()
    {

        return $this->quantity * $this->unit_price;
    }


    private function setUnitPrice($med_id)
    {
        $sql = 'SELECT price FROM `shop_medicine` WHERE `med_id` = ? AND `shop_id` = ?';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$med_id, $this->shop_id]);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);


        if($res['price'] == 0)
        {
            $sql = 'SELECT unit_price FROM `medicine` WHERE `id` = ?';
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$med_id]); 
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res['unit_price'];
        }
        return $res['price'];
    }
}