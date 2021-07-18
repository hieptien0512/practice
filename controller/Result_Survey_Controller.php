<?php
include_once("../model/User_Entity.php");
include_once("../model/User_Model.php");
include_once("../model/Survey_Entity.php");
include_once("../model/Survey_Model.php");
include_once("../model/Question_Entity.php");
include_once("../model/Question_Model.php");
include_once("../model/Chart_Entity.php");
include_once("../model/Choice_Entity.php");
include_once("../model/Choice_Model.php");
require_once("../smarty/My_Smarty.php");

class SurveyResultController
{
    public function invoke()
    {
        $template = new mySmarty();
        $modelQuestion = new ModelQuestion();
        $modelSurvey = new ModelSurvey();
        $modelChoice = new ModelChoice();
        $modelUser = new ModelUser();

        session_start();
        if (!isset($_SESSION['login'])) {
            header("location:Signin_User_Controller.php");
        }
        if (!isset($_GET['surveyId'])) {
            header('location:Main_Page_Controller.php');

        } else {
            $survey = $modelSurvey->getSurveyResult($_GET['surveyId']);
            if (isset($survey)) {
                $template->assign('survey', $survey);
                $questionList = $modelQuestion->getAllQuestion($_GET['surveyId']);
                $choiceList = $modelChoice->getAllChoice($_GET['surveyId']);
                $template->assign('index', 1);
                $template->assign('choiceList', $choiceList);
                $template->assign('questionList', $questionList);
            } else {
                header('location:Main_Page_Controller.php');
            }
        }
        $chart = $modelChoice->testChart($_GET['surveyId']);
        $template->assign('chart', $chart);
        var_dump($chart);
        $userName = $modelUser->getUserInfo($_SESSION['login']);
        $template->assign('userName', $userName);
        $template->display("result_survey.tpl");
    }
}

$resultController = new SurveyResultController();
$resultController->invoke();
