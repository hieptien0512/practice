<?php
include_once "DB.php";

class Model_Survey
{
    protected $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    //get all survey of user from db
    public function getAllSurveyAdmin($userId)
    {
        $con = $this->db->getConnect();
        //sql query variable binding
        $sqlquery = "SELECT *
                        FROM survey as SV
                        WHERE SV.user_id = '%s'
                        ORDER BY SV.id";
        $sqlquery = sprintf(
            $sqlquery,
            mysqli_real_escape_string($con,$userId),
        );
        $surveyList = array();
        $result = $this->db->query($sqlquery);
        if (is_object($result)) {
            while ($row = $result->fetch_assoc()) {
                $survey = new Entity_Survey($row['id'], $row['name'], $row['description'], $row['status'], $row['user_id']);
                array_push($surveyList, $survey);
            }
        }
        return $surveyList;
    }

    public function getAllSurveyUser()
    {
        //sql query variable binding
        $sqlquery = "SELECT *
                        FROM survey as SV
                        WHERE SV.status = 1 OR SV.status =2
                        ORDER BY SV.id";
        $surveyList = array();
        $result = $this->db->query($sqlquery);
        if (is_object($result)) {
            while ($row = $result->fetch_assoc()) {
                $survey = new Entity_Survey($row['id'], $row['name'], $row['description'], $row['status'], $row['user_id']);
                array_push($surveyList, $survey);
            }
        }
        return $surveyList;
    }

    public function changeSurveyStatus($surveyId, $surveyStatus)
    {
        //if survey status is 0 means created then update to 1 means open
        if ($surveyStatus == 0) {
            $sqlquery = "UPDATE survey
                        SET status = 1
                        WHERE id = '$surveyId'";

        } else {
            //update to 2 means close
            $sqlquery = "UPDATE survey
                        SET status = 2
                        WHERE id = '$surveyId'";
        }
        //excute query update survey status
        $this->db->query($sqlquery);
    }
}
