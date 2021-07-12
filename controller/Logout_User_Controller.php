<?php
include_once("../model/User_Entity.php");
include_once("../model/User_Model.php");
require_once("../smarty/My_Smarty.php");

class LogOutUserController
{
    public function invoke()
    {
        session_start();
        unset($_SESSION['login']);
        header("location:../index.php");
    }
}

$logOutUser = new LogOutUserController();
$logOutUser->invoke();
