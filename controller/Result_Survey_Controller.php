<?php
include_once("../model/Survey_Model.php");

class Ctrl_Survey_Result
{
    public function invoke()
    {
        echo 'trang Result survey';
    }
}

//////////////////////////////////////
//2. Process
$C_Student = new Ctrl_Survey_Result();
$C_Student->invoke();
