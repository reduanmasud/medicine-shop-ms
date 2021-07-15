<?php

function checkLoggedin($redirect = null)
{
    if(!(isset($_SESSION["login"]) && $_SESSION["login"] == true))
    {
        header('location: ../login.php');
    }
}


function isLoggedIn()
{
    if(!(isset($_SESSION["login"]) && $_SESSION["login"] == true && isset($_SESSION['hash'])))
    {

        return true;
    }
    else
    {

        return false;
    }
}


function activeUrlSidebar($filename)
{
    $URI = $_SERVER['PHP_SELF'];
    if(basename($URI) == $filename) echo "w3-blue";
}