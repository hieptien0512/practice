<?php
include_once("../model/Survey_Model.php");

class StatusSurveyController
{
    public function invoke()
    {
        session_start();
        //check session if user already logged in then display main page
        if (isset($_SESSION['login'])) {
            header("location:Main_Page_Controller.php");
        }
        //create new user model
        $modelSurvey = new ModelSurvey();
        //delete user by id
        if (isset($_POST['id'])) {
            $modelSurvey->changeSurveyStatus($_POST['id'], $_POST['status']);
        }
    }
}

//////////////////////////////////////
//2. Process
$statusController = new StatusSurveyController();
$statusController->invoke();
