<?php
include_once("../model/User_Entity.php");
include_once("../model/User_Model.php");
require_once("../smarty/My_Smarty.php");

class SignUpUserController
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
            $error = $modelUser->validateInsert($_POST);
            if ($error != '') {
                $template->assign('error', $error);
            } else {
                $modelUser->insertUser($_POST);
                header('Location: ../index.php');
            }
        }

        $template->display("signup.tpl");
    }
}

$signUpController = new SignUpUserController();
$signUpController->invoke();
