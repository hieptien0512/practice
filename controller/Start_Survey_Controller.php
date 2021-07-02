<?php
include_once("../model/Survey_Model.php");

class StartSurveyController
{
    public function invoke()
    {
        echo 'trang Bắt Đầu làm Result survey';
    }
}

//////////////////////////////////////
//2. Process
$startSurvey = new StartSurveyController();
$startSurvey->invoke();
