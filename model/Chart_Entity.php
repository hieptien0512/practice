<?php

class EntityChart
{
    public $choice_id;
    public $count;


    public function __construct($_choice_id, $_count)
    {
        $this->choice_id = $_choice_id;
        $this->count = $_count;
    }
}

