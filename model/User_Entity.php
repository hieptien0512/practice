<?php

class Entity_User
{
    public $id;
    public $name;
    public $email;
    public $tel;
    public $address;

    public function __construct($_id, $_name, $email, $tel, $address)
    {
        $this->id = $_id;
        $this->name = $_name;
        $this->email = $email;
        $this->tel = $tel;
        $this->address = $address;
    }


}

?>