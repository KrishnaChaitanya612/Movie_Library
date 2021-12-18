<?php

include_once "database.php";
session_start();

if(!$_SESSION['email'])
{
     
    header("Location: ".$base_url."/login.php");
}


?>