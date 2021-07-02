<?php
include_once("../model/User_Entity.php");
include_once("../model/User_Model.php");
require_once("../smarty/My_Smarty.php");

class LogOutUserController
{
    public function invoke()
    {
        //using smarty template
        session_start();
        unset($_SESSION['login']);
        header("location:../index.php");
    }
}

//////////////////////////////////////
//2. Process
$logOutUser = new LogOutUserController();
$logOutUser->invoke();
