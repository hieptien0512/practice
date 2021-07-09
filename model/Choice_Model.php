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
     * @param int $questionId
     * @param int $order
     */
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
