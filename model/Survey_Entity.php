<?php

class Entity_Survey
{
    public $id;
    public $name;
    public $description;
    public $status;
    public $user_id;

    public function __construct($_id, $_name, $_description, $_status, $_user_id)
    {
        $this->id = $_id;
        $this->name = $_name;
        $this->description = $_description;
        $this->status = $_status;
        $this->user_id = $_user_id;
    }


}

