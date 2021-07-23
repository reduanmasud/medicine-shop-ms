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
        //return $data;

        //return gettype($data);

        // return $this->getId();

        // $arrSize = count($data['med_id']);
        // $valuesMed = '';
        // for ($i = 0; $i < $arrSize; $i++) {
        //     $valuesMed .= '( ';
        //     $valuesMed .= '`' . $data['med_id'][$i] . '`';
        //     $valuesMed .= ', `' . $data['quantity'][$i]."`";
        //     $valuesMed .= ' )';
        // }

        //return $valuesMed;

        return $this->getMedCost(1, 3);

        
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