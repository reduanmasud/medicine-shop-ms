<?php

class Medicine
{
    protected $db;
    private $brand_name;
    private $generic_name;
    private $dosage_form;
    private $strangth;
    private $manufactured_by;

    public function __construct()
    {
        if ($this->db == null) {
            try {
                $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE . '', DB_USER, DB_PASSWORD);
            } catch (PDOException $e) {
                print_r($e);
            }
        }
    }

    //gatters

    public function getAllGenericName()
    {
        $data = [];
        $sql = 'SELECT generic_name FROM medicine';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($res as  $value) {
            array_push($data, $value['generic_name']);
        }

        return $data;
    }

    public function getAllManufacturar()
    {
        $data = [];
        $sql = 'SELECT manufactured_by FROM medicine';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($res as  $value) {
            array_push($data, $value['manufactured_by']);
        }

        return $data;
    }

    public function getAllBrandName()
    {
        $data = [];
        $sql = 'SELECT brand_name FROM medicine';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($res as  $value) {
            array_push($data, $value['brand_name']);
        }

        return $data;
    }

    public function getFullMedInfo()
    {
        $sql = 'SELECT * FROM medicine';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $res;
    }
}
