<?php
include_once("../model/User_Entity.php");
include_once("../model/User_Model.php");
require_once("../smarty/My_Smarty.php");

class SignInUserController
{
    public function invoke()
    {
        session_start();
        if (isset($_SESSION['login'])) {
            header("location:Main_Page_Controller.php");
        }
        $template = new mySmarty();
        $modelUser = new ModelUser();
        if (!empty($_POST)) {
            $result = $modelUser->getUserDetail($_POST['email'], $_POST['password']);
            if ($result) {
                $_SESSION['login'] = $result->id;
                header("location:Main_Page_Controller.php");
            } else {
                $template->assign('error', 'Invalid Password Or Email');
            }
        }
        $template->display("signin.tpl");
    }
}

$signInController = new SignInUserController();
$signInController->invoke();
