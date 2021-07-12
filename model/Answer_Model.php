<?php
include_once "DB.php";
include_once "Validate_Post.php";

class ModelAnswer
{
    protected $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function getConnect()
    {
        $con = $this->db->getConnect();
        return $con;
    }

    /**
     * insert answer into DB
     * @param $questionId
     * @param $choiceId
     * @param $userId
     * @param $surveyId
     */
    public function insertAnswer($questionId, $choiceId, $userId, $surveyId)
    {
        //sql query string
        $sql = "INSERT INTO answer (question_id, choice_id, user_id, survey_id) 
                        VALUE ('%s', '%s', '%s', '%s')";
        //sql injection, sql binding variable
        $sql = sprintf(
            $sql,
            mysqli_real_escape_string($this->getConnect(), $questionId),
            mysqli_real_escape_string($this->getConnect(), $choiceId),
            mysqli_real_escape_string($this->getConnect(), $userId),
            mysqli_real_escape_string($this->getConnect(), $surveyId)
        );

        $this->db->query($sql);
    }

    /**
     * input answer from post value
     * @param $postValue
     * @param $surveyId
     * @param $userId
     */
    public function inputAnswer($postValue, $surveyId, $userId)
    {
        foreach ($postValue as $question) {
            for ($i = 1; $i < count($question); $i++) {
                $this->insertAnswer($question[0], $question[$i], $userId, $surveyId);

            }
        }
    }

    /** check validate input answer post
     * @param $postValue
     * @return string error
     */
    public function validateInputAnswer($postValue)
    {
        $error = '';
        $validate = new ValidatePostValue();
        if ($validate->validatePostAnswer($postValue) == false) {
            $error = 'Please choose answer for all question';
        }
        return $error;
    }
}
