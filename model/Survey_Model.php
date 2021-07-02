<?php
include_once "DB.php";

class ModelSurvey
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
    public function getAllSurveyAdmin($userId)
    {
        //sql query variable binding
        $sqlQuery = "SELECT *
                        FROM survey as SV
                        WHERE SV.user_id = '%s'
                        ORDER BY SV.id DESC
                        LIMIT 10 OFFSET 5";
        $sqlQuery = sprintf(
            $sqlQuery,
            mysqli_real_escape_string($this->getConnect(), $userId),
        );
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
     * get all survey of USER from db
     * output $surveylist: array object survey with status 1 and 2(1:opened, 2:closed)
     **/
    public function getAllSurveyUser()
    {
        //sql query variable binding
        $sqlQuery = "SELECT *
                        FROM survey as SV
                        WHERE SV.status = 1 OR SV.status =2
                        ORDER BY SV.id DESC";
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
}
