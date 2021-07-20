<?php
declare(strict_types=1);
include_once "DB.php";

class ModelChoice
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
     * insert choice in to db
     * @param string $choice choice content
     * @param string $questionId
     * @param string $order
     */
    public function insertChoice(string $choice, string $questionId, string $order)
    {
        //sql query string
        $sql = "INSERT INTO choice (question_id, choice_content, `order`) 
                        VALUE ('%s', '%s', '%s')";
        //sql injection, sql binding variable
        $sql = sprintf(
            $sql,
            mysqli_real_escape_string($this->getConnect(), $questionId),
            mysqli_real_escape_string($this->getConnect(), $choice),
            mysqli_real_escape_string($this->getConnect(), $order)
        );

        $this->db->query($sql);
    }

    /**
     * get all choice from surveyId
     * @param string $surveyId
     * @return array entityChoice
     */
    public function getAllChoice(string $surveyId): array
    {

        //sql query variable binding
        $sql = "SELECT * FROM choice WHERE question_id IN (SELECT `id` FROM question WHERE survey_id = '%s')";
        $sql = sprintf(
            $sql,
            mysqli_real_escape_string($this->getConnect(), $surveyId),
        );
        $choiceList = [];
        $result = $this->db->query($sql);
        if (is_object($result)) {
            while ($row = $result->fetch_assoc()) {
                $choice = new EntityChoice($row['id'], $row['question_id'], $row['choice_content'], $row['order']);
                array_push($choiceList, $choice);
            }
        }
        return $choiceList;
    }

    /**
     * return data for draw chart
     * @param string $surveyId
     * @return array entityChoice
     */
    public function getChartData(string $surveyId): string
    {
        $questionIdList = $this->getQuestionIdForChart($surveyId);
        $chartList = [];
        if (isset($questionIdList)) {
            foreach ($questionIdList as $questionId) {
                $sql = "SELECT choice.choice_content, COUNT(*) 
                        FROM answer 
                        INNER JOIN `choice`
                        ON choice.id = answer.choice_id
                        WHERE choice_id IN 
                        (
                            SELECT choice.id 
                            FROM choice 
                            WHERE question_id = '%s'
                        ) 
                        GROUP BY choice_id";
                $sql = sprintf(
                    $sql,
                    mysqli_real_escape_string($this->getConnect(), $questionId),
                );
                $chartItem = [['Title', 'value']];
                $result = $this->db->query($sql);
                if (is_object($result)) {
                    while ($row = $result->fetch_assoc()) {
                        $chart[0] = $row['choice_content'];
                        $chart[1] = (int)$row['COUNT(*)'];
                        array_push($chartItem, $chart);
                    }
                }
                array_push($chartList, $chartItem);
            }
        }


        return json_encode($chartList);
    }

    /**
     * get all question id from survey
     * @param string $surveyId
     * @return array
     */
    public function getQuestionIdForChart(string $surveyId)
    {

        //sql query variable binding
        $sql = "SELECT `id` FROM question WHERE survey_id = '%s'";
        $sql = sprintf(
            $sql,
            mysqli_real_escape_string($this->getConnect(), $surveyId),
        );
        $result = $this->db->query($sql);
        if (is_object($result)) {
            while ($row = $result->fetch_array()) {
                $questionIdList[] = $row['id'];
            }
        }
        if (isset($questionIdList)) {
            return $questionIdList;

        }
    }
}
