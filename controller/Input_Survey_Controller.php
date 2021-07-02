<?php
include_once("../model/Survey_Model.php");

class InputSurveyController
{
    public function invoke()
    {
        echo 'trang input survey';
    }
}

//////////////////////////////////////
//2. Process
$inputSurvey = new InputSurveyController();
$inputSurvey->invoke();
