<?php

class SingleCustomer
{
    private $shop;
    private $db;


    private $owned_by_the_shop = true;
    private $first_name;
    private $last_name;
    private $name;
    private $address;
    private $id;
    private $due;
    private $mobile;
    private $profile_image;
    private $total_buy;
    private $total_paid;
    private $invoice = [];
    private $medicine = [];
    private $remark;

    public $dbg;

    

    public function __construct(Shop $shop, $id)
    {
        $this->shop = $shop;

        if ($this->db == null) {
            try {
                $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE . '', DB_USER, DB_PASSWORD);
            } catch (PDOException $e) {
                print_r($e);
            }
        }

        $this->id = $id;
        $this->init();

    }



    //Getter
    public function getId()
    {
        return $this->id;
    }
    public function isOwner()
    {
        return $this->owned_by_the_shop;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function getLastName()
    {

        return $this->last_name;
    }

    public function getName()
    {
        return $this->first_name." ". $this->last_name;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getMobile()
    {
        return $this->mobile;
    }

    public function getDue()
    {
        return $this->total_buy - $this->total_paid;
    }

    public function getPaid()
    {
        return $this->total_paid;
    }

    public function getTotalBuy()
    {
        return $this->total_buy;
    }

    public function getProfileImage()
    {
        return $this->profile_image;
    }

    public function getUniqueMedicineNumber()
    {

        return sizeof($this->medicine);
    }

    public function getRemark()
    {
        return $this->remark;
    }




    //setter
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    }

    public function setRemark($remark)
    {
        $this->remark = $remark;
    }

    public function setProfileImage($profile_image)
    {
        $this->profile_image = $profile_image;
    }


    public function update()
    {

        $elm = $this->getUpdateElements();
        $sql = "UPDATE `customer` SET ".$elm['statement_string']." WHERE `shop_id` = ? AND `id` = ?";

        array_push($elm['values'], $this->shop->getId());
        array_push($elm['values'], $this->id);

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($elm['values']);
               

    }

    public function delete()
    {

        foreach ($this->invoice as $key => $value) {
            $sql = 'DELETE FROM `invoice_med` WHERE `invoice_id` = ?';
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$value["id"]]);
        }

        $ok = 2;
        $sql = 'DELETE FROM `invoice` WHERE `customer_id` = ? AND `shop_id` = ?';
        $stmt = $this->db->prepare($sql);
        if($stmt->execute([$this->id, $this->shop->getId()]))
        {
            $ok--;
        }

        $sql = 'DELETE FROM `customer` WHERE id = ? AND shop_id = ?';
        $stmt = $this->db->prepare($sql);
      
        if ($stmt->execute([$this->id, $this->shop->getId()]))
        {
            $ok--;
        }

        if(!empty($this->profile_image))
            unlink('customer/images/' . $this->profile_image);

        

        if ($ok == 0) {
            return 1;
        }
        else return 0;
    }

    //Supportive Functions
    private function getUpdateElements()
    {
        $db_row_map = [
            'first_name' => 'first_name',
            'last_name' => 'last_name',
            'mobile' => 'mobile',
            'address' => 'address',
            'profile_image' => 'profile_photo',
            'remark' => 'remark'
        ];

        $col_string = '';
        $val_arr = [];
        
        

        foreach ($db_row_map as $key => $value) {
            $col_string .= $value." = ?, ";
            array_push($val_arr, htmlspecialchars($this->$key));
        }

        $col_string = substr($col_string, 0, -2);
        $return =[
            "statement_string" => $col_string,
            "values"=> $val_arr,
        ];


        return $return;

        
    }
    private function init(){
        $sql = 'SELECT * FROM `customer` WHERE `shop_id` = ? AND `id` = ?';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$this->shop->getId(), $this->id]);

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (sizeof($result) == 0) {
            $this->owned_by_the_shop = false;
        }
        else
        {
            //Set Basic Profile Info
            $this->first_name = $result[0]['first_name'];$result[0]['last_name'];
            $this->last_name = $result[0]["last_name"];
            $this->address = $result[0]["address"];
            $this->profile_image = $result[0]['profile_photo'];
            $this->mobile = $result[0]['mobile'];
            $this->remark = $result[0]['remark'];

            //DUE, COST, PAID fatch

            $sql = 'SELECT sum(due) as total_due, sum(sub_total) as total_cost, sum(paid) as total_paid FROM invoice WHERE `shop_id` = ? AND `customer_id` = ?';
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$this->shop->getId(), $this->id]);
            $res = $stmt->fetchAll(PDO::FETCH_OBJ);

            $this->total_paid = $res[0]->total_paid;
            $this->due = $res[0]->total_due;
            $this->total_buy = $res[0]->total_cost;

            $this->getInvoices();
            $this->getMedicines();

        }

    }
   

    private function getInvoices($limit = null, $offset = null)
    {
        $sql = 'SELECT * FROM `invoice` WHERE `shop_id` = ? AND `customer_id`=? ORDER BY created_at DESC';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$this->shop->getId(), $this->id]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->invoice = $res;
        $this->dbg = $res;
    }

    private function getMedicines($limit = null, $offset = null)
    {
        $sql = 'SELECT `invoice_med`.*, `medicine`.* FROM `invoice_med` INNER JOIN `medicine` ON `invoice_med`.medicine_id = `medicine`.id WHERE `invoice_med`.invoice_id IN (SELECT id FROM invoice WHERE shop_id = ? AND customer_id = ?) GROUP BY `medicine`.id';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$this->shop->getId(), $this->id]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->medicine = $res;
        //$this->dbg = $res;
        // $this->dbg = $this->invoice;
    }





}
