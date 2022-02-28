<?php
declare(strict_types=1);
include_once "DB.php";

class ValidatePostValue
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
     * check value post create question is valid
     * @param $postValue
     * @return bool
     */
    public function validatePostQuestion($postValue): bool
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
     * validate post for insert answer
     * @param $postValue
     * @param string $surveyId
     * @return bool
     */
    public function validatePostAnswer($postValue, string $surveyId): bool
    {
        foreach ($postValue as $question) {
            if (count($question) < 2) {
                return false;
            }
            if ($this->checkQuestionIsInSurvey($question[0], $surveyId) == 0) {
                return false;
            }
            for ($i = 1; $i < count($question); $i++) {
                if ($this->checkChoiceIsInQuestion($question[$i], $question[0]) == 0) {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * check if question is valid in survey
     * @param string $questionId
     * @param string $surveyId
     * @return int 0 is mean not exist question in survey
     */
    public function checkQuestionIsInSurvey(string $questionId, string $surveyId): int
    {
        $sql = "SELECT COUNT(*) 
                    FROM question 
                    WHERE id='%s' AND survey_id='%s'";

        $sql = sprintf(
            $sql,
            mysqli_real_escape_string($this->getConnect(), $questionId),
            mysqli_real_escape_string($this->getConnect(), $surveyId)
        );
        $result = $this->db->query($sql);
        $isExist = $result->fetch_assoc();
        return (int)$isExist['COUNT(*)'];
    }

    /**
     * check if choice is valid in question
     * @param string $choiceId
     * @param string $QuestionId
     * @return int 0 is mean not exist choice question
     */
    public function checkChoiceIsInQuestion(string $choiceId, string $QuestionId): int
    {
        $sql = "SELECT COUNT(*) 
                    FROM choice 
                    WHERE id='%s' AND question_id='%s'";

        $sql = sprintf(
            $sql,
            mysqli_real_escape_string($this->getConnect(), $choiceId),
            mysqli_real_escape_string($this->getConnect(), $QuestionId)
        );
        $result = $this->db->query($sql);
        $isExist = $result->fetch_assoc();
        return (int)$isExist['COUNT(*)'];
    }

    /**
     * check value post create survey is valid
     * @param $postValue
     * @return bool
     */
    public function validatePostSurvey($postValue): bool
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
