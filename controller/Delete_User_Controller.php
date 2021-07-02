<?php
include_once("../model/User_Model.php");

class DeleteUserController
{
    public function invoke()
    {
        //create new user model
        $modelUser = new ModelUser();
        //delete user by id
        if (isset($_POST['id'])) {
            $modelUser->deleteUserById($_POST['id']);
        }
    }
}

//////////////////////////////////////
//2. Process
$deleteUser = new DeleteUserController();
$deleteUser->invoke();
