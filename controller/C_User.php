<?php
include_once("../model/E_User.php");
include_once("../model/M_User.php");
require_once("../smarty/Smarty.class.php");

class Ctrl_User
{
    public function invoke()
    {
        //sử dụng smarty template
        $template = new Smarty();

        //xóa user bằng id
        if(isset($_POST['id']))
        {
            $id = $_POST['id'];
            $modelUser = new Model_User();
            $modelUser->deleteUserById($id);

        }else
        {
            $modelUser = new Model_User();
            $userData = $modelUser->getAllUser();
            $userList = array();
            if (is_object($userData)) {


                while ($row = $userData->fetch_assoc()) {
                    $tmpUser = new Entity_User($row['id'], $row['name'], $row['email'], $row['tel'], $row['address']);
                    array_push($userList, $tmpUser);

                }

            }
            //include ("../templates/index.tpl");
            $template->assign('index', 1);
            $template->assign('list', $userList);
            $template->template_dir = "../templates";
            $template->compile_dir = "../templates_c";
            $template->display("index.tpl");
        }


    }
}

//////////////////////////////////////
//2. Process

$C_Student = new Ctrl_User();
$C_Student->invoke();