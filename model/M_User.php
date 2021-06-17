<?php
include_once "DB.php";

class Model_User
{
    protected $db;                              //database instance

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    //1. Get all student
    //input: no input
    //output: list of student
    public function getAllUser()
    {
        //sql query string
        $sqlquery = "SELECT *
                     FROM user as US
                     ORDER BY US.name ";

        //query data
        $result = $this->db->query($sqlquery);

        return $result;
    }

    public function getUserDetail($usid)
    {
        //sql query string
        $sqlquery = "SELECT *
                     FROM user as US
                     WHERE US.id = '$usid'";

        //query data
        $result = $this->db->query($sqlquery);

        return $result;
    }

    public function deleteUserById($usid)
    {
        //sql query string
        $sqlquery = "DELETE FROM user WHERE id = '$usid'";
        $this->db->query($sqlquery);
        echo "Xóa Thành Công";
    }

    public function insertUser($name, $email, $tel, $address)
    {
        //sql query string
        $sqlquery = "INSERT INTO user (name, email, tel, address) VALUE ('$name', '$email', '$tel', '$address') ";
        $this->db->query($sqlquery);
        echo "Thêm user thành công";
    }

    public function updateUser($id, $name, $email, $tel, $address)
    {
        //sql query string
        $sqlquery = "UPDATE user SET name = '$name', email = '$email', tel = '$tel', address = '$address' WHERE id=".$id;
        $this->db->query($sqlquery);
        echo "Sửa user thành công";
    }

}
