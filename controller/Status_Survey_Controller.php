<?php
include_once("../model/Survey_Model.php");

class StatusSurveyController
{
    public function invoke()
    {
        session_start();
        if (isset($_SESSION['login'])) {
            header("location:Main_Page_Controller.php");
        }
        $modelSurvey = new ModelSurvey();
        if (isset($_POST['id'])) {
            $modelSurvey->changeSurveyStatus($_POST['id'], $_POST['status']);
        }
    }
}

$statusController = new StatusSurveyController();
$statusController->invoke();
