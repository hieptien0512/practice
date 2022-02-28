<?php

class EntityAnswer
{
    public $id;
    public $question_id;
    public $choice_id;
    public $user_id;
    public $survey_id;

    public function __construct($_id, $_question_id, $_choice_id, $_user_id, $_survey_id)
    {
        $this->id = $_id;
        $this->question_id = $_question_id;
        $this->choice_id = $_choice_id;
        $this->user_id = $_user_id;
        $this->survey_id = $_survey_id;
    }
}

