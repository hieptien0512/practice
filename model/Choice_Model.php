<?php
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
     * @param string $surveyId
     * @return array entityChoice
     */
    public function testChart(string $surveyId): string
    {

        //sql query variable binding
        $sql = "SELECT choice_id, COUNT(*) 
                FROM answer 
                WHERE choice_id IN 
                (
                    SELECT choice.id 
                    FROM choice 
                    WHERE question_id 
                    IN
                    (
                        SELECT question.id 
                        FROM question 
                        WHERE survey_id = '%s'
                    )
                ) 
                GROUP BY choice_id";
        $sql = sprintf(
            $sql,
            mysqli_real_escape_string($this->getConnect(), $surveyId),
        );
        $chartList = [['Work', 11],
            ['Eat', 2],
            ['Commute', 2],
            ['Watch TV', 2],
            ['Sleep', 7]];
        $result = $this->db->query($sql);
//        if (is_object($result)) {
//            while ($row = $result->fetch_assoc()) {
//                $chart = new EntityChart($row['choice_id'], (int)$row['COUNT(*)']);
//                array_push($chartList, $chart);
////                $chartList[] = $row['choice_id'];
////                $chartList[] = $row['COUNT(*)'];
////                $value = $row['choice_id'].','.$row['COUNT(*)'];
////                array_push($chartList, $value);
//            }
//        }

        return json_encode($chartList);
    }
}
