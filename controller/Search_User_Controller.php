<?php
include_once("../model/User_Entity.php");
include_once("../model/User_Model.php");
require_once("../smarty/My_Smarty.php");

class Ctrl_User
{
    public function invoke()
    {
//        //using smarty template
        $template = new mySmarty();
        //create new user model
        $modelUser = new Model_User();

        if (isset($_GET['key'])) {
            //search user
            $userList = $modelUser->searchUser($_GET['key']);
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
