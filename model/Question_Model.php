<?php
include_once "DB.php";
include_once "Choice_Model.php";
include_once "Validate_Post.php";

class ModelQuestion
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
     * get all question from surveyId
     * @param $surveyId
     * @return array entityQuestion
     */
    public function getAllQuestion($surveyId)
    {

        //sql query variable binding
        $sql = "SELECT *
                        FROM question as Q
                        WHERE Q.survey_id = '%s'
                        ORDER BY Q.order";
        $sql = sprintf(
            $sql,
            mysqli_real_escape_string($this->getConnect(), $surveyId),
        );
        $questionList = [];
        $result = $this->db->query($sql);
        if (is_object($result)) {
            while ($row = $result->fetch_assoc()) {
                $question = new EntityQuestion($row['id'], $row['survey_id'], $row['question_content'], $row['order'], $row['question_type']);
                array_push($questionList, $question);
            }
        }
        return $questionList;
    }

    /**
     * input question from post value
     * @param $postValue
     * @param int $surveyId
     */
    public function inputQuestion($postValue, $surveyId)
    {
        $modelChoice = new ModelChoice();
        $order = 0;

        foreach ($postValue as $question) {
            $order++;
            $questionId = $this->insertQuestion($question[1], $surveyId, $order, $question[0]);

            for ($j = 2; $j < count($question); $j++) {
                $modelChoice->insertChoice($question[$j], $questionId, $j);
            }
        }
    }

    /**
     * validate all input field not blank
     * @param $postValue
     * @param int $surveyId
     * @return string
     */
    public function validateInputQuestion($postValue)
    {
        $error = '';
        $validate = new ValidatePostValue();
        if ($validate->validatePostQuestion($postValue) == false) {
            $error = 'Invalid insert value';
        }
        return $error;
    }


    /**
     * insert QUESTION in to db table survey
     * @param string $question question content
     * @param int $surveyId
     * @param int $order
     * @return int
     */
    public function insertQuestion($question, $surveyId, $order, $question_type)
    {
        //sql query string
        $sql = "INSERT INTO question (survey_id, question_content, `order`, question_type) 
                        VALUE ('%s', '%s', '%s', '%s')";
        //sql injection, sql binding variable
        $sql = sprintf(
            $sql,
            mysqli_real_escape_string($this->getConnect(), $surveyId),
            mysqli_real_escape_string($this->getConnect(), $question),
            mysqli_real_escape_string($this->getConnect(), $order),
            mysqli_real_escape_string($this->getConnect(), $question_type)
        );

        $this->db->query($sql);
        $sql = "SELECT LAST_INSERT_ID() AS id";
        $result = $this->db->query($sql);
        $idInsert = $result->fetch_assoc();
        $idInsert = (int)$idInsert['id'];
        return $idInsert;
    }
}
