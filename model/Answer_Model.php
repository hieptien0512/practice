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
     * @param string $questionId
     * @param string $choiceId
     * @param string $userId
     * @param string $surveyId
     */
    public function insertAnswer(string $questionId, string $choiceId, string $userId, string $surveyId)
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
     * @param string $surveyId
     * @param string $userId
     */
    public function inputAnswer($postValue, string $surveyId, string $userId)
    {
        foreach ($postValue as $question) {
            for ($i = 1; $i < count($question); $i++) {
                $this->insertAnswer($question[0], $question[$i], $userId, $surveyId);

            }
        }
    }

    /**
     * return error after validate post insert answer
     * @param $postValue
     * @param string $surveyId
     * @return string
     */
    public function validateInputAnswer($postValue, string $surveyId): string
    {
        $error = '';
        $validate = new ValidatePostValue();
        if ($validate->validatePostAnswer($postValue, $surveyId) == false) {
            $error = 'Invalid question or choice. Please answer all question.';
        }
        return $error;
    }
}
