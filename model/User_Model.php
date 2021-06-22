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
        $userList = array();
        if (is_object($result)) {
            while ($row = $result->fetch_assoc()) {
                $userForView = new Entity_User($row['id'], $row['name'], $row['email'], $row['tel'], $row['address']);
                array_push($userList, $userForView);
            }
        }

        return $userList;
    }

    public function getUserDetail($userId)
    {
        if (is_numeric($userId) == true) {
            //sql query string
            $sqlquery = "SELECT *
                     FROM user as US
                     WHERE US.id = '$userId'";
            //query data
            $result = $this->db->query($sqlquery);
            if (is_object($result)) {
                while ($row = $result->fetch_assoc()) {
                    $user = new Entity_User($row['id'], $row['name'], $row['email'], $row['tel'], $row['address']);
                }
            }
        }
        return $user;
    }

    public function searchUser($name)
    {
        $name = str_replace('\'', '\\\'', $name);

        //sql query string
        $sqlquery = "SELECT *
                     FROM user
                     WHERE name LIKE '%$name%'";
        //query data
        $result = $this->db->query($sqlquery);
        $userList = array();
        if (is_object($result)) {
            while ($row = $result->fetch_assoc()) {
                $userForView = new Entity_User($row['id'], $row['name'], $row['email'], $row['tel'], $row['address']);
                array_push($userList, $userForView);
            }
        }

        return $userList;
    }

    public function deleteUserById($userId)
    {
        if (is_numeric($userId) == true) {
            //sql query string
            $sqlquery = "DELETE FROM user WHERE id = '$userId'";
            $this->db->query($sqlquery);
            echo 'Xóa Thành Công';
        } else {
            echo 'Xóa thất bại';
        }
    }

    public function insertUser($postValue)
    {
        $name = $email = $address = $tel = '';
        if (isset($postValue['name'])) {
            $name = $postValue['name'];
        }
        if (isset($postValue['email'])) {
            $email = $postValue['email'];
        }
        if (isset($postValue['tel'])) {
            $tel = $postValue['tel'];
        }
        if (isset($postValue['address'])) {
            $address = $postValue['address'];
        }


        //check các kí tự đặt biệt
        $name = str_replace('\'', '\\\'', $name);
        $email = str_replace('\'', '\\\'', $email);
        $tel = str_replace('\'', '\\\'', $tel);
        $address = str_replace('\'', '\\\'', $address);
        //sql query string
        $sqlquery = "INSERT INTO user (name, email, tel, address) VALUE ('$name', '$email', '$tel', '$address') ";
        $this->db->query($sqlquery);
        echo 'Thêm user thành công';
    }

    public function updateUser($postValue)
    {
        //insert/update user nếu $_post đã được set giá trị
        $name = $email = $address = $tel = $id = '';
        if (isset($postValue['name'])) {
            $name = $postValue['name'];
        }
        if (isset($postValue['email'])) {
            $email = $postValue['email'];
        }
        if (isset($postValue['tel'])) {
            $tel = $postValue['tel'];
        }
        if (isset($postValue['address'])) {
            $address = $postValue['address'];
        }
        if (isset($postValue['id'])) {
            $id = $postValue['id'];
        }

        //check các kí tự đặt biệt
        $name = str_replace('\'', '\\\'', $name);
        $email = str_replace('\'', '\\\'', $email);
        $tel = str_replace('\'', '\\\'', $tel);
        $address = str_replace('\'', '\\\'', $address);
        $id = str_replace('\'', '\\\'', $id);
        //sql query string
        $sqlquery = "UPDATE user SET name = '$name', email = '$email', tel = '$tel', address = '$address' WHERE id=" . $id;
        $this->db->query($sqlquery);
        echo 'Sửa user thành công';
    }


}
