<?php
include_once("../model/Survey_Model.php");

class Ctrl_Survey_Status
{
    public function invoke()
    {
        //create new user model
        $modelSurvey = new Model_Survey();
        //delete user by id
        if (isset($_POST['id'])) {
            $modelSurvey->changeSurveyStatus($_POST['id'], $_POST['status']);
        }
    }
}

//////////////////////////////////////
//2. Process
$C_Student = new Ctrl_Survey_Status();
$C_Student->invoke();
