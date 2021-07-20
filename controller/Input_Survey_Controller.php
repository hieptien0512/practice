<?php
include_once("../model/User_Entity.php");
include_once("../model/User_Model.php");
include_once("../model/Survey_Entity.php");
include_once("../model/Survey_Model.php");
require_once("../smarty/My_Smarty.php");

class InputSurveyController
{
    public function invoke()
    {
        $template = new mySmarty();
        $modelSurvey = new ModelSurvey();
        $modelUser = new ModelUser();

        session_start();
        if (!isset($_SESSION['login'])) {
            header("location:Signin_User_Controller.php");
        }
        if ($modelUser->checkUserRole($_SESSION['login']) != 1) {
            header('location:Main_Page_Controller.php');
        }
        if (!empty($_POST)) {
            $error = $modelSurvey->validateInputSurvey($_POST);
            if ($error != '') {
                $template->assign('error', $error);
            } else {
                $idInsert = $modelSurvey->insertSurvey($_POST, $_SESSION['login']);
                header("location:Input_Question_Controller.php?surveyId=$idInsert");
            }
        }
        $userName = $modelUser->getUserInfo($_SESSION['login']);
        $template->assign('userName', $userName);
        $template->display("input_survey.tpl");
    }
}

$inputSurvey = new InputSurveyController();
$inputSurvey->invoke();
