<?php
include_once("../model/Survey_Model.php");

class Survey_Result
{
    public function invoke()
    {
        echo 'trang Result survey';
    }
}

//////////////////////////////////////
//2. Process
$C_Student = new Survey_Result();
$C_Student->invoke();
