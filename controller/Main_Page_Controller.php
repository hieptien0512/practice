<?php
include_once("../model/User_Entity.php");
include_once("../model/User_Model.php");
include_once("../model/Survey_Entity.php");
include_once("../model/Survey_Model.php");
require_once("../smarty/My_Smarty.php");

class Main_Page
{
    public function invoke()
    {
//        //using smarty template
        $template = new mySmarty();
        $template->assign('index', 1);
        $modelSurvey = new Model_Survey();
        session_start();
        //check session if user already logged in then display main page
        if (!isset($_SESSION['login'])) {
            header("location:Signin_User_Controller.php");
        }
        if ($_SESSION['login']->is_admin) {
            $surveyList = $modelSurvey->getAllSurveyAdmin();
            $template->assign('surveyList', $surveyList);
            $template->display("main_admin.tpl");

        } else {
            $surveyList = $modelSurvey->getAllSurveyUser();
            $template->assign('surveyList', $surveyList);
            $template->display("main_user.tpl");

        }
    }
}

//////////////////////////////////////
//2. Process
$C_Student = new Main_Page();
$C_Student->invoke();