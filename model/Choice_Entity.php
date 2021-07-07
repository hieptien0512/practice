<?php

class EntityChoice
{
    public $id;
    public $question_id;
    public $choice;
    public $order;

    public function __construct($_id, $_question_id, $_choice, $_order)
    {
        $this->id = $_id;
        $this->question_id = $_question_id;
        $this->choice = $_choice;
        $this->order = $_order;
    }


}

