<?php

try{
    $db_conn = new PDO('mysql:host='.DB_HOST.';dbname='.DB_DATABASE.'', DB_USER, DB_PASSWORD);
    $db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo $e->getMessage();

}

$user = new User($db_conn);