<?php
include_once "DB.php";

class ModelUser
{
    protected $db;                              //database instance

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
     * this function is not using now
     **/
    public function getAllUser()
    {
        //sql query string
        $sqlQuery = "SELECT *
                     FROM user as US
                     ORDER BY US.name ";

        //query data
        $result = $this->db->query($sqlQuery);
        $userList = [];
        if (is_object($result)) {
            while ($row = $result->fetch_assoc()) {
                $user = new EntityUser($row['id'], $row['name'], $row['email'], $row['tel'], $row['address']);
                array_push($userList, $user);
            }
        }
        return $userList;
    }

    /**
     * check if signin user email and password is match in db
     * input $userEmail string: email of user
     * input $password string: password of user
     * output return false if $userEmail does not exist
     * output return $user UserEntity if email and password match
     **/
    public function getUserDetail($userEmail, $password)
    {
        //check if email exist return false
        $user = $this->validateUserEmail($userEmail);
        if (!isset($user)) {
            return false;
        }
        //check if password match
        if (password_verify($password, $user->password)) {
            return $user;
        }
    }

    /**
     * Check if email exist in db
     * input $userEmail string: email of user
     * output return $user UserEntity if email exist in db
     **/
    public function validateUserEmail($userEmail)
    {
        //sql query string
        $sqlQuery = "SELECT *
                 FROM user as US
                 WHERE US.email = '%s'";
        $sqlQuery = sprintf(
            $sqlQuery,
            mysqli_real_escape_string($this->getConnect(), $userEmail),
        );
        //query data
        $result = $this->db->query($sqlQuery);
        if (is_object($result)) {
            while ($row = $result->fetch_assoc()) {
                $user = new EntityUser($row['id'], $row['email'], $row['password'], $row['name'], $row['phone'], $row['is_admin']);
            }
        }
        if (isset($user)) {
            return $user;
        }
    }

    /**
     * this function is not using now
     **/
    public function searchUser($name)
    {
        $name = str_replace('\'', '\\\'', $name);

        //sql query string
        $sqlQuery = "SELECT *
                     FROM user
                     WHERE name LIKE '%$name%'";
        //query data
        $result = $this->db->query($sqlQuery);
        $userList = [];
        if (is_object($result)) {
            while ($row = $result->fetch_assoc()) {
                $userForView = new EntityUser($row['id'], $row['name'], $row['email'], $row['tel'], $row['address']);
                array_push($userList, $userForView);
            }
        }

        return $userList;
    }

    /**
     * this function is not using now
     **/
    public function deleteUserById($userId)
    {
        if (is_numeric($userId) == true) {
            //sql query string
            $sqlQuery = "DELETE FROM user WHERE id = '$userId'";
            $this->db->query($sqlQuery);
            echo 'Xóa Thành Công';
        } else {
            echo 'Xóa thất bại';
        }
    }

    /**
     * validate all input field from sign up form post
     * input $postValue: array string of email, name, phone, password
     * output $error string if any field is invalid
     **/
    public function validateInsert($postValue)
    {
        //validate phone field
        $error = '';
        if (isset($postValue['phone'])) {
            if (strlen($postValue['phone']) != 10) {
                $error = 'Phone is 10 number character';
            }
            if ($postValue['phone'] == '') {
                $error = 'Phone can not be empty';
            }
        }
        //validate name field
        if (isset($postValue['name'])) {
            if (strlen($postValue['name']) > 100) {
                $error = 'Name can not be longer than 100 character';
            }
            if ($postValue['name'] == '') {
                $error = 'Name can not be empty';
            }
        }
        //validate password field
        if (isset($postValue['password'])) {
            if (strlen($postValue['password']) < 6 || strlen($postValue['password']) > 50) {
                $error = 'Password can not be shorter than 6 or longer than 50 character';
            }
            if ($postValue['password'] == '') {
                $error = 'Password can not be empty';
            }
        }
        //validate passwordconfirm field
        if (isset($postValue['confirmPassword'])) {
            if (strlen($postValue['confirmPassword']) < 6 || strlen($postValue['confirmPassword']) > 50) {
                $error = 'Password can not be shorter than 6 or longer than 50 character';
            }
            if ($postValue['confirmPassword'] == '') {
                $error = 'Confirm password can not be empty';
            }
        }
        //Check password confirm match with password
        if ($postValue['password'] != $postValue['confirmPassword']){
            $error = 'Password confirm does not match with password';
        }
        //validate email field
        if (isset($postValue['email'])) {
            if (!filter_var($postValue['email'], FILTER_VALIDATE_EMAIL)) {
                $error = 'Invalid email format';
            }
            //check email duplicate
            $result = $this->validateUserEmail($postValue['email']);
            if (isset($result)) {
                $error = 'Email is duplicate';
            }
            if ($postValue['email'] == '') {
                $error = 'Email can not be empty';
            }
            if (strlen($postValue['email']) > 100) {
                $error = 'Email can not be longer than 100 character';
            }
        }
        return $error;
    }

    /**
     * insert user in to db
     * input $postValue: array string of email, name, phone, password
     * password bcrypt hash before insert to db
     **/
    public function insertUser($postValue)
    {
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
        $sqlQuery = "INSERT INTO user (email, password, name, phone) VALUE ('%s', '%s', '%s', '%s')";
        //sql injection, sql binding variable
        $sqlQuery = sprintf(
            $sqlQuery,
            mysqli_real_escape_string($this->getConnect(), $email),
            mysqli_real_escape_string($this->getConnect(), $password),
            mysqli_real_escape_string($this->getConnect(), $name),
            mysqli_real_escape_string($this->getConnect(), $phone)
        );

        $this->db->query($sqlQuery);
    }

    /**
     * this function is not using now
     **/
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
        $sqlQuery = "UPDATE user SET name = '$name', email = '$email', tel = '$tel', address = '$address' WHERE id=" . $id;
        $this->db->query($sqlQuery);
        echo 'Sửa user thành công';
    }


}
