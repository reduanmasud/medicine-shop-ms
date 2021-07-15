<?php
function isLoggedIn()
{
    if(isset($_SESSION["login"]) && $_SESSION["login"] == true && isset($_SESSION['hash']))
    {

        return true;
    }
    else
    {

        return false;
    }
}