<?php

class Entity_User
{
    public $id;
    public $name;
    public $email;
    public $password;
    public $phone;

    public function __construct($_id, $_email, $_password, $_name, $_phone)
    {
        $this->id = $_id;
        $this->email = $_email;
        $this->password = $_password;
        $this->name = $_name;
        $this->phone = $_phone;
    }


}

?>
