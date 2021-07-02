<?php
include_once("../model/User_Entity.php");
include_once("../model/User_Model.php");
require_once("../smarty/My_Smarty.php");

class InputUserController
{
    public function invoke()
    {
        //use smarty
        $template = new mySmarty();
        $modelUser = new ModelUser();
        //call model if $_POST isset
        if (!empty($_POST)) {
            //if id is set => update user with id
            if ($_POST['id'] != '') {
                $modelUser->updateUser($_POST);
                header('Location: View_User_Controller.php');
                die();
            } else {
                $modelUser->insertUser($_POST);
                header('Location: View_User_Controller.php');
                die();
            }
        }
        //if $get isset, fill user data in form
        if (isset($_GET['id'])) {
            $userData = $modelUser->getUserDetail($_GET['id']);
            $template->assign('user', $userData);
            $template->display("input_view.tpl");
        } else {
            $template->display("input_view.tpl");
        }
    }
}

//////////////////////////////////////
//2. Process

$signUpController = new InputUserController();
$signUpController->invoke();
