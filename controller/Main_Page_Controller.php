<?php
include_once("../model/User_Entity.php");
include_once("../model/User_Model.php");
include_once("../model/Survey_Entity.php");
include_once("../model/Survey_Model.php");
require_once("../smarty/My_Smarty.php");

class MainController
{
    public function invoke()
    {
        //using smarty template
        $template = new mySmarty();
        $template->assign('index', 1);
        $modelSurvey = new ModelSurvey();
        session_start();
        //check session if user already logged in then display main page
        if (!isset($_SESSION['login'])) {
            header("location:Signin_User_Controller.php");
        }
        if ($_SESSION['login']->is_admin) {
            if (!isset($_GET['page'])) {
                $_GET['page'] = 1;
            }
            $surveyList = $modelSurvey->getAllSurveyAdmin($_SESSION['login']->id, $_GET['page']);
            $template->assign('surveyList', $surveyList);
            $template->assign('prePage', $_GET['page'] - 1);
            $template->assign('thisPage', $_GET['page']);
            $template->assign('nextPage', $_GET['page'] + 1);
            $template->assign('maxPage', $modelSurvey->countSurveyAdmin() + 1);
            $template->display("main_admin.tpl");

        } else {
            if (!isset($_GET['page'])) {
                $_GET['page'] = 1;
            }
            $surveyList = $modelSurvey->getAllSurveyUser($_GET['page']);
            $template->assign('surveyList', $surveyList);
            $template->assign('prePage', $_GET['page'] - 1);
            $template->assign('thisPage', $_GET['page']);
            $template->assign('nextPage', $_GET['page'] + 1);
            $template->assign('maxPage', $modelSurvey->countSurveyUser() + 1);
            $template->display("main_user.tpl");

        }
    }
}

//////////////////////////////////////
//2. Process
$mainController = new MainController();
$mainController->invoke();
