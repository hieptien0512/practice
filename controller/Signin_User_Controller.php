<?php
include_once("../model/User_Entity.php");
include_once("../model/User_Model.php");
require_once("../smarty/My_Smarty.php");

class SignInUserController
{
    public function invoke()
    {
        session_start();
        //check session if user already logged in then display main page
        if (isset($_SESSION['login'])) {
            header("location:Main_Page_Controller.php");
        }
//        //using smarty template
        $template = new mySmarty();
        $modelUser = new ModelUser();
        if (!empty($_POST)) {
            $result = $modelUser->getUserDetail($_POST['email'], $_POST['password']);
            if ($result) {
                $_SESSION['login'] = $result;
                header("location:Main_Page_Controller.php");
            } else {
                $template->assign('error', 'Invalid Password Or Email');
            }
        }

        //load template login view
        $template->display("signin.tpl");
    }
}

//////////////////////////////////////
//2. Process
$signInController = new SignInUserController();
$signInController->invoke();
