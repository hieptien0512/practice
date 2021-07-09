<?php
include_once "DB.php";
include_once "Choice_Model.php";

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
     * @param $surveyId
     * @return array
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
                $question = new EntityQuestion($row['id'], $row['survey_id'], $row['question_contain'], $row['order']);
                array_push($questionList, $question);
            }
        }
        return $questionList;
    }


    /**
     * insert QUESTION and choice in to db table survey
     * @param $postValue : array string of question array, each question contain array of choice
     * @param $surveyId : int surveyId value
     **/
    public function inputQuestion($postValue, $surveyId)
    {
        $modelChoice = new ModelChoice();
        $order = 0;
        foreach ($postValue as $question) {
            $order++;
            $questionId = $this->insertQuestion($question[0], $surveyId, $order);

            for ($j = 1; $j < count($question); $j++) {
                $modelChoice->insertChoice($question[$j], $questionId, $j);
            }
        }
    }

    /**
     * validate all input field not space or null
     * @param $postValue : array string of question array, each question contain array of choice
     * @param $surveyId : int surveyId value
     * @return $error : string error
     **/
    public function validateInputQuestion($postValue, $surveyId)
    {
        $error = '';
        foreach ($postValue as $item) {
            foreach ($item as $value) {
                if ($value == '') {
                    $error = 'You can not insert empty question or empty choice';
                }
            }
        }
        return $error;
    }

    /**
     * insert QUESTION in to db table survey
     * @param $question : string  of question content
     * @param $surveyId : int surveyId value
     * @param $order : int question ordered number
     * @return $idInsert : int id of question just insert into db
     **/
    public function insertQuestion($question, $surveyId, $order)
    {
        //sql query string
        $sql = "INSERT INTO question (survey_id, question_content, `order`) 
                        VALUE ('%s', '%s', '%s')";
        //sql injection, sql binding variable
        $sql = sprintf(
            $sql,
            mysqli_real_escape_string($this->getConnect(), $surveyId),
            mysqli_real_escape_string($this->getConnect(), $question),
            mysqli_real_escape_string($this->getConnect(), $order)
        );

        $this->db->query($sql);
        $sql = "SELECT LAST_INSERT_ID() AS id";
        $result = $this->db->query($sql);
        $idInsert = $result->fetch_assoc();
        $idInsert = (int)$idInsert['id'];
        return $idInsert;
    }
}
