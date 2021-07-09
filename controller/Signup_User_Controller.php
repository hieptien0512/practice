<?php
include_once("../model/User_Entity.php");
include_once("../model/User_Model.php");
require_once("../smarty/My_Smarty.php");

class SignUpUserController
{
    public function invoke()
    {
        session_start();
        //check session if user already logged in then display main page
        if (isset($_SESSION['login'])) {
            header("location:View_User_Controller.php");
        }
        //using smarty template
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

        //load template login view
        $template->display("signup.tpl");
    }
}

//////////////////////////////////////
//2. Process
$signUpController = new SignUpUserController();
$signUpController->invoke();
