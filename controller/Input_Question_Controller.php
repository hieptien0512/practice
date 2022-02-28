<?php
include_once("../model/User_Entity.php");
include_once("../model/User_Model.php");
include_once("../model/Survey_Entity.php");
include_once("../model/Survey_Model.php");
include_once("../model/Question_Entity.php");
include_once("../model/Question_Model.php");
require_once("../smarty/My_Smarty.php");

class InputQuestionController
{
    public function invoke()
    {
        session_start();
        if (!isset($_SESSION['login'])) {
            header("location:Signin_User_Controller.php");
        }
        $template = new mySmarty();
        $modelSurvey = new ModelSurvey();
        $modelQuestion = new ModelQuestion();
        $modelUser = new ModelUser();

        if ($modelUser->checkUserRole($_SESSION['login']) == 0 || !isset($_GET['surveyId'])) {
            header('location:Main_Page_Controller.php');
        }

        $survey = $modelSurvey->getSurveyDetail($_GET['surveyId'], $_SESSION['login']);
        if (!isset($survey)) {
            header('location:Input_Survey_Controller.php');
        }

        if (!empty($_POST)) {
            $error = $modelQuestion->validateInputQuestion($_POST);
            if ($error != '') {
                $template->assign('error', $error);
            } else {
                $modelQuestion->inputQuestion($_POST, $_GET['surveyId']);
                header('location:View_Survey_Controller.php?surveyId=' . $_GET['surveyId']);
            }
        }

        $template->assign('survey', $survey);
        $userName = $modelUser->getUserInfo($_SESSION['login']);
        $template->assign('userName', $userName);
        $template->display("create_question.tpl");
    }
}

$inputQuestion = new InputQuestionController();
$inputQuestion->invoke();
