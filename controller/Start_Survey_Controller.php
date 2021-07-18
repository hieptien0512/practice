<?php
include_once("../model/User_Entity.php");
include_once("../model/User_Model.php");
include_once("../model/Survey_Entity.php");
include_once("../model/Survey_Model.php");
include_once("../model/Question_Entity.php");
include_once("../model/Question_Model.php");
include_once("../model/Choice_Entity.php");
include_once("../model/Choice_Model.php");
include_once("../model/Answer_Entity.php");
include_once("../model/Answer_Model.php");
require_once("../smarty/My_Smarty.php");

class StartSurveyController
{
    public function invoke()
    {
        $template = new mySmarty();
        $modelQuestion = new ModelQuestion();
        $modelSurvey = new ModelSurvey();
        $modelChoice = new ModelChoice();
        $modelUser = new ModelUser();
        $modelAnswer = new ModelAnswer();

        session_start();
        if (!isset($_SESSION['login'])) {
            header("location:Signin_User_Controller.php");
        }
        if ($modelUser->checkUserRole($_SESSION['login']) == 1 || !isset($_GET['surveyId'])) {
            header('location:Main_Page_Controller.php');

        } elseif ($modelUser->checkSurveyDone($_SESSION['login'], $_GET['surveyId']) > 0) {
            header('location:Result_Survey_Controller.php?surveyId='.$_GET['surveyId']);

        } else {
            $survey = $modelSurvey->getSurveyDetailUser($_GET['surveyId']);
            if (isset($survey)) {
                $template->assign('survey', $survey);
                $questionList = $modelQuestion->getAllQuestion($_GET['surveyId']);
                $choiceList = $modelChoice->getAllChoice($_GET['surveyId']);
                $template->assign('index', 1);
                $template->assign('choiceList', $choiceList);
                $template->assign('questionList', $questionList);
            } else {
                header('location:Input_Survey_Controller.php');
            }
        }
        if (!empty($_POST)) {
            $error = $modelAnswer->validateInputAnswer($_POST);
            if ($error != '') {
                $template->assign('error', $error);
            } else {
                $modelAnswer->inputAnswer($_POST, $_GET['surveyId'], $_SESSION['login']);
                header('location:Main_Page_Controller.php');
            }
        }
        $userName = $modelUser->getUserInfo($_SESSION['login']);
        $template->assign('userName', $userName);
        $template->display("start_survey.tpl");
    }
}

$startSurvey = new StartSurveyController();
$startSurvey->invoke();
