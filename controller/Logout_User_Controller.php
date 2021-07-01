<?php
include_once("../model/User_Entity.php");
include_once("../model/User_Model.php");
require_once("../smarty/My_Smarty.php");

class Log_Out_User
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
$C_Student = new Log_Out_User();
$C_Student->invoke();
