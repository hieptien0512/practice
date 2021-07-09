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
    public function validatePostQuestion($postValue, $surveyId)
    {
        if (is_int($surveyId) && is_array($postValue)) {
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
     * check value post create survey is validßßß
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
