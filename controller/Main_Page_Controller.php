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
        $template = new mySmarty();
        $template->assign('index', 1);
        $modelSurvey = new ModelSurvey();
        $modelUser = new ModelUser();
        session_start();
        if (!isset($_SESSION['login'])) {
            header("location:Signin_User_Controller.php");
        }
        if (!isset($_GET['page'])) {
            $_GET['page'] = 1;
        }
        $surveyList = $modelSurvey->getAllSurvey($_SESSION['login'], $_GET['page']);
        $userName = $modelUser->getUserInfo($_SESSION['login']);
        $template->assign('userName', $userName);
        $template->assign('surveyList', $surveyList);
        $template->assign('prePage', $_GET['page'] - 1);
        $template->assign('thisPage', $_GET['page']);
        $template->assign('nextPage', $_GET['page'] + 1);
        $template->assign('maxPage', $modelSurvey->countSurvey($_SESSION['login']) + 1);
        if ($modelUser->checkUserRole($_SESSION['login'])) {
            $template->display("main_admin.tpl");
        } else {
            $template->display("main_user.tpl");
        }
    }
}

$mainController = new MainController();
$mainController->invoke();
