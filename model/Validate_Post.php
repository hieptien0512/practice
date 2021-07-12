<?php
include_once "DB.php";

class ValidatePostValue
{
    protected $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    /**
     * check value post create question is valid
     * @param $postValue
     * @param $surveyId
     * @return bool
     */
    public function validatePostQuestion($postValue)
    {
        if (is_array($postValue)) {
            foreach ($postValue as $item) {
                foreach ($item as $value) {
                    if ($value == '') {
                        return false;
                    }
                }
            }
            return true;
        }
        return false;
    }

    /**
     * check validate post input answer
     * @param $postValue
     * @return bool
     */
    public function validatePostAnswer($postValue)
    {
        foreach ($postValue as $question) {
            if (count($question) < 2) {
                return false;
            }
        }
        return true;
    }

    /**
     * check value post create survey is valid
     * @param $postValue
     * @return bool
     */
    public function validatePostSurvey($postValue)
    {
        if (is_array($postValue)) {
            foreach ($postValue as $item) {
                if ($item == '') {
                    return false;
                }
            }
            return true;
        }
        return false;
    }
}
