<?php
include_once("../model/Survey_Model.php");

class Ctrl_Survey_Input
{
    public function invoke()
    {
        echo 'trang input survey';
    }
}

//////////////////////////////////////
//2. Process
$C_Student = new Ctrl_Survey_Input();
$C_Student->invoke();
