<?php
include_once("../model/User_Entity.php");
include_once("../model/User_Model.php");
require_once("../smarty/My_Smarty.php");

class Main_Page
{
    public function invoke()
    {
//        //using smarty template
        $template = new mySmarty();
        session_start();
        //check session if user already logged in then display main page
        if(!isset($_SESSION['login'])){
            header("location:Signin_User_Controller.php");
        }

        $template->display("main.tpl");

    }
}

//////////////////////////////////////
//2. Process
$C_Student = new Main_Page();
$C_Student->invoke();
