<?php
include_once "DB.php";

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
     * get all survey of ADMIN from db
     * input $userId int: the user id
     * output $surveylist: array object survey entity
     **/
    public function getAllQuestion($surveyId)
    {

        //sql query variable binding
        $sqlQuery = "SELECT *
                        FROM question as Q
                        WHERE Q.survey_id = '%s'
                        ORDER BY Q.order";
        $sqlQuery = sprintf(
            $sqlQuery,
            mysqli_real_escape_string($this->getConnect(), $surveyId),
        );
        $questionList = [];
        $result = $this->db->query($sqlQuery);
        if (is_object($result)) {
            while ($row = $result->fetch_assoc()) {
                $question = new EntityQuestion($row['id'], $row['survey_id'], $row['question_contain'], $row['order']);
                array_push($questionList, $question);
            }
        }
        return $questionList;
    }

    /**
     * count number of survey page for pagination ADMIN main page, each page contain 10 survey record
     * output int number of max page
     **/
    public function countSurveyAdmin()
    {
        $sqlQuery = "SELECT COUNT(id)
                        AS id
                        FROM survey";
        $result = $this->db->query($sqlQuery);
        $count = $result->fetch_assoc();
        $total = (int)$count['id'];
        return $total / 10;
    }

    /**
     * count number of survey page for pagination USER main page, each page contain 10 survey record
     * output int number of max page
     **/
    public function countSurveyUser()
    {
        $sqlQuery = "SELECT COUNT(id) 
                        AS id
                        FROM survey 
                        WHERE `status` = 1 OR `status` =2";
        $result = $this->db->query($sqlQuery);
        $count = $result->fetch_assoc();
        $total = (int)$count['id'];
        return $total / 10;
    }

    /**
     * get all survey of USER from db
     * output $surveylist: array object survey with status 1 and 2(1:opened, 2:closed)
     **/
    public function getAllSurveyUser($page)
    {
        $offset = $page * 10 - 10;

        //sql query variable binding
        $sqlQuery = "SELECT *
                        FROM survey as SV
                        WHERE SV.status = 1 OR SV.status =2
                        LIMIT 10 OFFSET " . $offset;
        $surveyList = [];
        $result = $this->db->query($sqlQuery);
        if (is_object($result)) {
            while ($row = $result->fetch_assoc()) {
                $survey = new EntitySurvey($row['id'], $row['name'], $row['description'], $row['status'], $row['user_id']);
                array_push($surveyList, $survey);
            }
        }
        return $surveyList;
    }

    /**
     * change survey status form 0->1 and 1->2 in db
     * input $surveyId int: the id of survey
     * input $surveyStatus int: the status of survey
     **/
    public function changeSurveyStatus($surveyId, $surveyStatus)
    {
        //if survey status is 0 means created then update to 1 means open
        if ($surveyStatus == 0) {
            $status = 1;
        } else {
            //if survey status is 0 means created then update to 1 means open
            $status = 2;
        }
        $sqlQuery = "UPDATE survey
                        SET status = '$status'
                        WHERE id = '%s'";
        $sqlQuery = sprintf(
            $sqlQuery,
            mysqli_real_escape_string($this->getConnect(), $surveyId),
        );
        //excute query update survey status
        $this->db->query($sqlQuery);
    }

    /**
     * insert SURVEY in to db table survey
     * input $postValue: array string of email, name, phone, password
     * input $userid: int form session value
     * output $idInsert: int id of survey insert
     **/
    public function insertQuestion($postValue, $surveyId)
    {
//        //validate field format
//        if (isset($postValue['name'])) {
//            $name = $postValue['name'];
//        }
//        if (isset($postValue['description'])) {
//            $description = $postValue['description'];
//        }
//
//        //sql query string
//        $sqlQuery = "INSERT INTO survey (name, description, user_id) VALUE ('%s', '%s', '%s')";
//        //sql injection, sql binding variable
//        $sqlQuery = sprintf(
//            $sqlQuery,
//            mysqli_real_escape_string($this->getConnect(), $name),
//            mysqli_real_escape_string($this->getConnect(), $description),
//            mysqli_real_escape_string($this->getConnect(), $userId)
//        );
//
//        $this->db->query($sqlQuery);
//        $sqlQuery = "SELECT LAST_INSERT_ID() AS id";
//        $result = $this->db->query($sqlQuery);
//        $idInsert = $result->fetch_assoc();
//        $idInsert = (int)$idInsert['id'];
//        return $idInsert;
    }

    /**
     * insert SURVEY in to db table survey
     * input $postValue: array string of email, name, phone, password
     * input $userid: int form session value
     * output $idInsert: int id of survey insert
     **/
    public function getSurveyDetail($surveyId)
    {
        //sql query variable binding
        $sqlQuery = "SELECT *
                        FROM survey as SV
                        WHERE SV.id = '%s' ";

        $sqlQuery = sprintf(
            $sqlQuery,
            mysqli_real_escape_string($this->getConnect(), $surveyId),
        );

        $result = $this->db->query($sqlQuery);
        if (is_object($result)) {
            while ($row = $result->fetch_assoc()) {
                $survey = new EntitySurvey($row['id'], $row['name'], $row['description'], $row['status'], $row['user_id']);
            }
        }
        return $survey;
    }
}
