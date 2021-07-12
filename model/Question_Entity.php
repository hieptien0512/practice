<?php

class EntityQuestion
{
    public $id;
    public $survey_id;
    public $question_content;
    public $order;
    public $question_type;

    public function __construct($_id, $_survey_id, $_question_content, $_order, $_question_type)
    {
        $this->id = $_id;
        $this->survey_id = $_survey_id;
        $this->question_content = $_question_content;
        $this->order = $_order;
        $this->question_type = $_question_type;
    }
}

