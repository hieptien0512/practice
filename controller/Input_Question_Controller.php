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
        //check session if user already logged in then display main page
        if (!isset($_SESSION['login'])) {
            header("location:Signin_User_Controller.php");
        }
        //using smarty template
        $template = new mySmarty();
        $modelSurvey = new ModelSurvey();
        $modelQuestion = new ModelQuestion();

        if (!$_SESSION['login']->is_admin || !isset($_GET['surveyId'])) {
            header('location:Main_Page_Controller.php');
        } else {
            $survey = $modelSurvey->getSurveyDetail($_GET['surveyId'], $_SESSION['login']->id);
            if (isset($survey)) {
                $template->assign('survey', $survey);
            } else {
                header('location:Input_Survey_Controller.php');
            }
            if (!empty($_POST)) {
                $error = $modelQuestion->validateInputQuestion($_POST, $_GET['surveyId']);
                //check validate if not have error then insert new question
                if ($error != '') {
                    $template->assign('error', $error);
                } else {
                    $modelQuestion->inputQuestion($_POST, $_GET['surveyId']);
                    header('location:Main_Page_Controller.php');
                }
            }
        }

        $template->display("create_question.tpl");
    }
}

//////////////////////////////////////
//2. Process
$inputQuestion = new InputQuestionController();
$inputQuestion->invoke();
