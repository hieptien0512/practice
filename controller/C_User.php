<?php
include_once("../model/E_User.php");
include_once("../model/M_User.php");
require_once("../My_Smarty.php");

class Ctrl_User
{
    public function invoke()
    {
        //using smarty template
        $template = new mySmarty();
        //delete user by id
        if (isset($_POST['id'])) {
            $modelUser = new Model_User();
            $modelUser->deleteUserById($_POST['id']);
        } elseif (isset($_GET['s']) && $_GET['s'] != '') {
            //search user
            $modelUser = new Model_User();
            $userList = $modelUser->searchUser($_GET['s']);
            //load template user view
            $template->assign('index', 1);
            $template->assign('list', $userList);
            $template->display("index.tpl");
        } else {
            //get all user model
            $modelUser = new Model_User();
            $userList = $modelUser->getAllUser();
            //load template user view
            $template->assign('index', 1);
            $template->assign('list', $userList);
            $template->display("index.tpl");
        }
    }
}

//////////////////////////////////////
//2. Process
$C_Student = new Ctrl_User();
$C_Student->invoke();
