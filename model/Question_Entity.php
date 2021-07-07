<?php

class EntityQuestion
{
    public $id;
    public $survey_id;
    public $question_contain;
    public $order;

    public function __construct($_id, $_survey_id, $_question_contain, $_order)
    {
        $this->id = $_id;
        $this->survey_id = $_survey_id;
        $this->question_contain = $_question_contain;
        $this->order = $_order;
    }


}

