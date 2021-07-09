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
     * check if signin user email and password is match in db
     * @param string $userEmail
     * @param string $password
     * @return EntityUser|false
     */
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
     * @param string $userEmail
     * @return EntityUser
     */
    public function validateUserEmail($userEmail)
    {
        //sql query string
        $sql = "SELECT *
                 FROM user as US
                 WHERE US.email = '%s'";
        $sql = sprintf(
            $sql,
            mysqli_real_escape_string($this->getConnect(), $userEmail),
        );
        //query data
        $result = $this->db->query($sql);
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
     * validate all input field from sign up form post
     * @param $postValue
     * @return string error
     */
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
        if ($postValue['password'] != $postValue['confirmPassword']) {
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
     * @param $postValue
     * password bcrypt hash before insert to db
     */
    public function insertUser($postValue)
    {
        //validate field format
        $email = $this->validateParam($postValue['email']);
        $password = $this->validateParam($postValue['password']);
        $name = $this->validateParam($postValue['name']);
        $phone = $this->validateParam($postValue['phone']);


        //hash password bcrypt
        $options = [
            'cost' => 12
        ];
        $password = password_hash($password, PASSWORD_BCRYPT, $options);

        //sql query string
        $sql = "INSERT INTO user (email, password, name, phone) VALUE ('%s', '%s', '%s', '%s')";
        //sql injection, sql binding variable
        $sql = sprintf(
            $sql,
            mysqli_real_escape_string($this->getConnect(), $email),
            mysqli_real_escape_string($this->getConnect(), $password),
            mysqli_real_escape_string($this->getConnect(), $name),
            mysqli_real_escape_string($this->getConnect(), $phone)
        );

        $this->db->query($sql);
    }

    /**
     * validate param isset
     * @param $param : string
     * @return param if isset
     **/
    public function validateParam($param)
    {
        //validate param
        if (isset($param)) {
            return $param;
        }
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
     * @param $userId
     * @return array
     */
    public function getUserInfo($userId)
    {
        //sql query string
        $sql = "SELECT `name`
                 FROM user as US
                 WHERE US.id = '%s'";
        $sql = sprintf(
            $sql,
            mysqli_real_escape_string($this->getConnect(), $userId),
        );
        //query data
        $result = $this->db->query($sql);
        $name = $result->fetch_row();
        return $name[0];
    }
}
