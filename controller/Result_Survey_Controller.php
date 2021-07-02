<?php
include_once("../model/Survey_Model.php");

class SurveyResultController
{
    public function invoke()
    {
        echo 'trang Result survey';
    }
}

//////////////////////////////////////
//2. Process
$resultController = new SurveyResultController();
$resultController->invoke();
