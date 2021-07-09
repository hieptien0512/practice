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
        //using smarty template
        $template = new mySmarty();
        $modelSurvey = new ModelSurvey();
        session_start();
        //check session if user already logged in then display main page
        if (!isset($_SESSION['login'])) {
            header("location:Signin_User_Controller.php");
        }
        if ($_SESSION['login']->is_admin) {
            if (!empty($_POST)) {
                $error = $modelSurvey->validateInputSurvey($_POST);
                if ($error != '') {
                    $template->assign('error', $error);
                } else {
                    $idInsert = $modelSurvey->insertSurvey($_POST, $_SESSION['login']->id);
                    header("location:Input_Question_Controller.php?surveyId=$idInsert");
                }
            }
        } else {
            header('location:Main_Page_Controller.php');
        }
        $template->display("create_survey.tpl");
    }
}

//////////////////////////////////////
//2. Process
$inputSurvey = new InputSurveyController();
$inputSurvey->invoke();
