<?php
include_once("../model/User_Entity.php");
include_once("../model/User_Model.php");
require_once("../smarty/My_Smarty.php");

class Signup_User
{
    public function invoke()
    {
//        //using smarty template
        $template = new mySmarty();
        $modelUser = new Model_User();
        if (!empty($_POST)) {
            $error = $modelUser->validateInsert($_POST);
            if ($error != '') {
                $template->assign('error', $error);
                $template->display("signup.tpl");
            } else {
                $modelUser->insertUser($_POST);

                header('Location: ../index.php');
            }

        } else {
            //load template login view
            $template->display("signup.tpl");
        }
    }
}

//////////////////////////////////////
//2. Process
$C_Student = new Signup_User();
$C_Student->invoke();
