<?php
include_once("../model/User_Entity.php");
include_once("../model/User_Model.php");
require_once("../smarty/My_Smarty.php");

class SignInUser
{
    public function invoke()
    {
        session_start();
        if (isset($_SESSION['login'])) {
            header("location:View_User_Controller.php");
        }
//        //using smarty template
        $template = new mySmarty();
        $modelUser = new Model_User();
        if (!empty($_POST)) {
            $result = $modelUser->getUserDetail($_POST['email'], $_POST['password']);
            if ($result) {
                $_SESSION['login'] = $result;
                header("location:View_User_Controller.php");
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
$C_Student = new SignInUser();
$C_Student->invoke();
