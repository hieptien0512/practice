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
        //using smarty template
        $template = new mySmarty();
        $modelSurvey = new ModelSurvey();
        $modelQuestion = new ModelQuestion();
        session_start();
        //check session if user already logged in then display main page
        if (!isset($_SESSION['login'])) {
            header("location:Signin_User_Controller.php");
        }
        if ($_SESSION['login']->is_admin) {
            if (isset($_GET['surveyId'])) {
                $survey = $modelSurvey->getSurveyDetail($_GET['surveyId']);
                $template->assign('index', 1);
                $template->assign('survey', $survey);
                $template->assign('index', 1);
                if (!empty($_POST)) {
                    var_dump($_POST);
//                    $modelQuestion->insertQuestion($_POST, $_GET['surveyId']);
                }

            } else {
                header('location:Main_Page_Controller.php');

            }


//            if (!empty($_POST)) {
//                $modelSurvey->insertSurvey($_POST, $_SESSION['login']->id);
//                header('location:Input_Question_Controller.php');
//            }
        } else {
            header('location:Main_Page_Controller.php');
        }

        $template->display("create_question.tpl");

    }
}

//////////////////////////////////////
//2. Process
$inputQuestion = new InputQuestionController();
$inputQuestion->invoke();
