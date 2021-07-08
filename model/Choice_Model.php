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
     * @param $choice string: choice content
     * @param $questionId int: id of question contain this choice
     * @param $order int: ordered number choice
     **/
    public function insertChoice($choice, $questionId, $order)
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
}
