<?php
include_once("../model/User_Model.php");

class Delete_User
{
    public function invoke()
    {
        //create new user model
        $modelUser = new Model_User();
        //delete user by id
        if (isset($_POST['id'])) {
            $modelUser->deleteUserById($_POST['id']);
        }
    }
}

//////////////////////////////////////
//2. Process
$C_Student = new Delete_User();
$C_Student->invoke();
