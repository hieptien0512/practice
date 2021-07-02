<?php
include_once("../model/User_Entity.php");
include_once("../model/User_Model.php");
require_once("../smarty/My_Smarty.php");

class Ctrl_User
{
    public function invoke()
    {
//        //using smarty template
        $template = new mySmarty();
        //create new user model
        $modelUser = new ModelUser();
        session_start();
        //check session if user already logged in then display main page
        if (!isset($_SESSION['login'])) {
            header("location:Signin_User_Controller.php");
        }


        //get all user model
        $userList = $modelUser->getAllUser();
        //load template user view
        $template->assign('index', 1);
        $template->assign('list', $userList);
        $template->display("index.tpl");
    }
}

//////////////////////////////////////
//2. Process
$viewUserController = new Ctrl_User();
$viewUserController->invoke();
