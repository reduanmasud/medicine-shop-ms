<?php

class User
{
    private $db;
    private $user;
    private $user_id;

    public function __construct($db_conn)
    {
        if ($this->db == null) {
            $this->db = $db_conn;
        }
    }

    /**
     * Register User Function
     *
     * @param [type] $data
     * @return void
     */
    public function register($data)
    {
        try {
            $pass = $data['password'];
            $pass = password_hash($pass, PASSWORD_DEFAULT);
            $fname = $data['first_name'];
            $lname = $data['last_name'];
            $email = $data['email'];

            $stmt = $this->db->prepare('INSERT INTO users(first_name, last_name, email, password) VALUES (:fname, :lname, :email, :pass)');
            $stmt->bindparam(':fname', $fname);
            $stmt->bindparam(':lname', $lname);
            $stmt->bindparam(':email', $email);
            $stmt->bindparam(':pass', $pass);
            $stmt->execute();

            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * LOGIN FUNCTION
     *
     * @param [type] $email
     * @param [type] $password
     * @return void
     */
    public function login($email, $password)
    {
        $sql = 'SELECT * FROM users WHERE email = ?';
        $res = $this->db->prepare($sql);
        $res->execute([$email]);
        $rowCount = $res->rowCount();
        $result = $res->fetch(PDO::FETCH_ASSOC);
        $digits = 4;
        $randomNum = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
        $timestamp = time();
        $hash = md5("$randomNum" . "$timestamp" . $email);
        if ($rowCount == 1) {
            if (password_verify($password, $result['password'])) {
                session_regenerate_id();
                //$_SESSION['login_hash'] = $hash;
                $_SESSION['login'] = true;
                $_SESSION['id'] = $result['id'];
                $_SESSION['last_login'] = time();
                $this->user = $result;
                $this->update('hash', $hash);

                return [$result['id'], $result['email']];
            }

            return false;
        }

        return false;
    }

    //DB Features

    public function update($column, $value)
    {
        $sql = "UPDATE users SET `$column` = ? WHERE `id` =  ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$value, $this->user['id']]);
    }

    //Getters

    public function getUserName()
    {
        return $this->user['first_name'];
    }

    public function getDB()
    {
        return $this->db;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function hasShop()
    {
        if ($this->user['has_shop'] == true) {
            return true;
        } else {
            return false;
        }
    }

    //Setters
    public function setBySession($id)
    {
        $sql = 'SELECT * FROM users WHERE id = ?';
        $res = $this->db->prepare($sql);
        $res->execute([$id]);
        $this->user = $res->fetch(PDO::FETCH_ASSOC);

        $this->user_id = $this->user['id'];
    }
}
