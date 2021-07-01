<?php

class Entity_User
{
    public $id;
    public $email;
    public $password;
    public $name;
    public $phone;
    public $is_admin;

    public function __construct($_id, $_email, $_password, $_name, $_phone, $_is_admin)
    {
        $this->id = $_id;
        $this->email = $_email;
        $this->password = $_password;
        $this->name = $_name;
        $this->phone = $_phone;
        $this->is_admin = $_is_admin;
    }


}
