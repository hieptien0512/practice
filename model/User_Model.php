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
                $user = new Entity_User($row['id'], $row['name'], $row['email'], $row['tel'], $row['address']);
                array_push($userList, $user);
            }
        }

        return $userList;
    }

    public function getUserDetail($userEmail, $password)
    {
        //
        $user = $this->validateUserEmail($userEmail);
        if(!isset($user)){
            return false;
        }

        if (password_verify($password, $user->password)) {
            return $user;
        }
    }

    public function validateUserEmail($userEmail)
    {
        //
        $con = $this->db->getConnect();
        //sql query string
        $sqlquery = "SELECT *
                 FROM user as US
                 WHERE US.email = '%s'";
        $sqlquery = sprintf(
            $sqlquery,
            mysqli_real_escape_string($con, $userEmail),
        );
        //query data
        $result = $this->db->query($sqlquery);
        if (is_object($result)) {
            while ($row = $result->fetch_assoc()) {
                $user = new Entity_User($row['id'], $row['email'], $row['password'], $row['name'], $row['phone'], $row['is_admin']);
            }
        }
        if (isset($user)){
            return $user;
        }

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
    public function validateInsert($postValue)
    {
        //validate field format
        $error = '';
        if (isset($postValue['phone'])) {
            if (strlen($postValue['phone']) != 10) {
                $error =  'Phone is 10 number character';
            }
            if ($postValue['phone'] == ''){
                $error = 'Phone can not be empty';
            }
        }
        //validate name field
        if (isset($postValue['name'])) {
            if (strlen($postValue['name']) > 40) {
                $error =  'Name can not be longer than 40 character';
            }
            if ($postValue['name'] == ''){
                $error = 'Name can not be empty';
            }
        }
        //validate password field
        if (isset($postValue['password'])) {
            if (strlen($postValue['password'])  < 6 || strlen($postValue['password']) > 50) {
                $error =  'Password can not be shorter than 6 or longer than 50 character';
            }
            if ($postValue['password'] == ''){
                $error = 'Password can not be empty';
            }
        }
        //validate email field
        if (isset($postValue['email'])) {
            //check email exist
            $result = $this->validateUserEmail($postValue['email']);
            if (isset($result)) {
                $error =  'Email is duplicate';
            }
            if ($postValue['email'] == ''){
                $error = 'Email can not be empty';
            }
        }
        return $error;
    }

    public function insertUser($postValue)
    {
        //
        $con = $this->db->getConnect();
        //validate field format
        if (isset($postValue['email'])) {
            $email = $postValue['email'];
        }
        if (isset($postValue['password'])) {
            $password = $postValue['password'];
        }
        if (isset($postValue['name'])) {
            $name = $postValue['name'];
        }
        if (isset($postValue['phone'])) {
            $phone = $postValue['phone'];
        }


        //hash password bcrypt
        $options = [
            'cost' => 12
        ];
        $password = password_hash($password, PASSWORD_BCRYPT, $options);

        //sql query string
        $sqlquery = "INSERT INTO user (email, password, name, phone) VALUE ('%s', '%s', '%s', '%s')";
        //sql injection, sql binding variable
        $sqlquery = sprintf(
            $sqlquery,
            mysqli_real_escape_string($con, $email),
            mysqli_real_escape_string($con, $password),
            mysqli_real_escape_string($con, $name),
            mysqli_real_escape_string($con, $phone)
        );

        $this->db->query($sqlquery);
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
