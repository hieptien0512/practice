<?php
require_once("../smarty/My_Smarty.php");

class LandingController
{
    public function invoke()
    {
        $template = new mySmarty();
        session_start();
        if (isset($_SESSION['login'])) {
            header("location:Main_Page_Controller.php");
        }
        $template->display("landing.tpl");
    }
}

$landingController = new LandingController();
$landingController->invoke();
