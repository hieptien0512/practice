<?php
include_once("../model/Survey_Model.php");

class Survey_Input
{
    public function invoke()
    {
        echo 'trang input survey';
    }
}

//////////////////////////////////////
//2. Process
$C_Student = new Survey_Input();
$C_Student->invoke();
