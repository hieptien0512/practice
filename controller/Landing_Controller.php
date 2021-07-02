<?php
require_once("../smarty/My_Smarty.php");

class LandingController
{
    public function invoke()
    {
        $template = new mySmarty();
        session_start();
        //check session if user already logged in then display main page
        if (isset($_SESSION['login'])) {
            header("location:Main_Page_Controller.php");
        }
        $template->display("landing.tpl");
    }
}

//////////////////////////////////////
//2. Process
$landingController = new LandingController();
$landingController->invoke();
