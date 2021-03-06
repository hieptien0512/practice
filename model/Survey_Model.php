<?php
include_once "DB.php";
include_once "Validate_Post.php";

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
     * check user role
     * @param $userId
     * @return bool|mysqli_result 1:admin, 0:user
     */
    public function checkUserRole($userId)
    {
        $sql = "SELECT is_admin
                        FROM user as US
                        WHERE US.id = '%s'";
        $sql = sprintf(
            $sql,
            mysqli_real_escape_string($this->getConnect(), $userId),
        );
        $result = $this->db->query($sql);
        $role = $result->fetch_row();
        return $role[0];
    }

    /**
     * get all survey from db
     * @param int $userId
     * @param int $page
     * @return array
     */
    public function getAllSurvey($userId, $page)
    {
        $offset = $page * 10 - 10;
        if ($this->checkUserRole($userId)) {
            $sql = "SELECT *
                        FROM survey as SV
                        WHERE SV.user_id = '%s'
                        ORDER BY SV.id DESC
                        LIMIT 10 OFFSET " . $offset;
            $sql = sprintf(
                $sql,
                mysqli_real_escape_string($this->getConnect(), $userId),
            );
        } else {
            $sql = "SELECT *
                        FROM survey as SV
                        WHERE SV.status = 1 OR SV.status =2
                        LIMIT 10 OFFSET " . $offset;
        }

        $surveyList = [];
        $result = $this->db->query($sql);
        if (is_object($result)) {
            while ($row = $result->fetch_assoc()) {
                $survey = new EntitySurvey($row['id'], $row['name'], $row['description'], $row['status'], $row['user_id']);
                array_push($surveyList, $survey);
            }
        }
        return $surveyList;
    }

    /**
     * count number of survey page for pagination ADMIN and USER main page, each page contain 10 survey record
     * @param $userId
     * @return float|int
     */
    public function countSurvey($userId)
    {
        if ($this->checkUserRole($userId)) {
            $sql = "SELECT COUNT(id)
                        AS id
                        FROM survey
                        WHERE user_id = '%s'";
            $sql = sprintf(
                $sql,
                mysqli_real_escape_string($this->getConnect(), $userId),
            );
        } else {
            $sql = "SELECT COUNT(id) 
                        AS id
                        FROM survey 
                        WHERE `status` = 1 OR `status` =2";
        }
        $result = $this->db->query($sql);
        $count = $result->fetch_assoc();
        $total = (int)$count['id'];
        return $total / 10;
    }


    /**
     * change survey status form 0->1 and 1->2 in db
     * @param int $surveyId
     * @param int $surveyStatus
     */
    public function changeSurveyStatus($surveyId, $surveyStatus)
    {
        $status = !$surveyStatus ? 1 : 2;

        $sql = "UPDATE survey
                        SET status = '$status'
                        WHERE id = '%s'";
        $sql = sprintf(
            $sql,
            mysqli_real_escape_string($this->getConnect(), $surveyId),
        );
        $this->db->query($sql);
    }

    /**
     * insert SURVEY in to db table survey
     * @param $postValue
     * @param int $userId
     * @return int id of survey just inserted
     */
    public function insertSurvey($postValue, $userId)
    {
        //validate field format
        if (isset($postValue['name'])) {
            $name = $postValue['name'];
        }
        if (isset($postValue['description'])) {
            $description = $postValue['description'];
        }

        $sql = "INSERT INTO survey (name, description, user_id) VALUE ('%s', '%s', '%s')";
        $sql = sprintf(
            $sql,
            mysqli_real_escape_string($this->getConnect(), $name),
            mysqli_real_escape_string($this->getConnect(), $description),
            mysqli_real_escape_string($this->getConnect(), $userId)
        );
        $name = $name . "aloalo";
        $this->db->query($sql);
        $sql = "SELECT LAST_INSERT_ID() AS id";
        $result = $this->db->query($sql);
        $idInsert = $result->fetch_assoc();
        $idInsert = (int)$idInsert['id'];
        return $idInsert;
    }

    /**
     * query data of survey in DB
     * @param int $surveyId
     * @param int $userId
     * @return EntitySurvey
     */
    public function getSurveyDetail($surveyId, $userId)
    {
        $sql = "SELECT *
                        FROM survey as SV
                        WHERE SV.id = '%s' AND SV.user_id = '%s' ";

        $sql = sprintf(
            $sql,
            mysqli_real_escape_string($this->getConnect(), $surveyId),
            mysqli_real_escape_string($this->getConnect(), $userId)
        );

        $result = $this->db->query($sql);
        if (is_object($result)) {
            while ($row = $result->fetch_assoc()) {
                $survey = new EntitySurvey($row['id'], $row['name'], $row['description'], $row['status'], $row['user_id']);
            }
        }
        return $survey;
    }


    /**
     * validate all input field not space or null
     * @param $postValue
     * @return string error
     */
    public function validateInputSurvey($postValue)
    {
        $error = '';
        $validate = new ValidatePostValue();
        if ($validate->validatePostSurvey($postValue) == false) {
            $error = 'Invalid insert value';
        }
        return $error;
    }
}
