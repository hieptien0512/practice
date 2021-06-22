<?php
include_once("../model/User_Entity.php");
include_once("../model/User_Model.php");
require_once("../smarty/My_Smarty.php");

class Ctrl_Input_User
{
    public function invoke()
    {
        //sử dụng smarty template hiển thị trang input
        $template = new mySmarty();
        $modelUser = new Model_User();
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
        //nếu có giá trị $_get thì tiến hành truy xuất xữ liệu theo id nhận vào
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

$C_Student = new Ctrl_Input_User();
$C_Student->invoke();
