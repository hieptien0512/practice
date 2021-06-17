<?php
include_once("../model/E_User.php");
include_once("../model/M_User.php");
require_once("../smarty/Smarty.class.php");

class Ctrl_Input_User
{
    public function invoke()
    {
        //sử dụng smarty template hiển thị trang input
        $template = new Smarty();
        $template->template_dir = "../templates";
        $template->compile_dir = "../templates_c";

        $name = $email = $address = $tel = '';
        $modelUser = new Model_User();

        //insert user nếu $_post đã được set giá trị
        if (!empty($_POST)) {
            $id = '';
            if (isset($_POST['name'])) {
                $name = $_POST['name'];
            }
            if (isset($_POST['email'])) {
                $email = $_POST['email'];
            }
            if (isset($_POST['tel'])) {
                $tel = $_POST['tel'];
            }
            if (isset($_POST['address'])) {
                $address = $_POST['address'];
            }
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
            }

            //check các kí tự đặt biệt
            $name = str_replace('\'', '\\\'', $name);
            $email = str_replace('\'', '\\\'', $email);
            $tel = str_replace('\'', '\\\'', $tel);
            $address = str_replace('\'', '\\\'', $address);
            $id = str_replace('\'', '\\\'', $id);

            //nếu có giá trị id thì tiến hành update
            if ($id != '') {
                $modelUser->updateUser($id, $name, $email, $tel, $address);
                header('Location: C_User.php');
                die();
            } //nếu không có id thì tiến hành insert new
            else {
                $modelUser->insertUser($name, $email, $tel, $address);
                header('Location: C_User.php');
                die();
            }
        }
        $id = "";
        //nếu có giá trị $_get thì tiến hành truy xuất xữ liệu theo id nhận vào
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $userData = $modelUser->getUserDetail($id);
            if (is_object($userData)) {

                while ($row = $userData->fetch_assoc()) {
                    $user = new Entity_User($row['id'], $row['name'], $row['email'], $row['tel'], $row['address']);

                }
            } else {
                $id = "";
            }
        }
        if ($id != null) {
            $template->assign('user', $user);
            $template->display("input_view.tpl");

        } else {

            $template->display("input_view.tpl");

        }


    }
}

//////////////////////////////////////
//2. Process

$C_Student = new Ctrl_Input_User();
$C_Student->invoke();