<?php /* Smarty version 2.6.31, created on 2021-06-17 06:37:36
         compiled from index.tpl */ ?>
<!doctype html>
<html lang="vi">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test template view</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h2 class="text-center">Danh sách thông tin user</h2>

        </div>

        <div class="panel-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Họ và Tên</th>
                    <th>Email</th>
                    <th>Số Điện Thoại</th>
                    <th>Địa Chỉ</th>
                    <th width="60px"></th>
                    <th width="60px"></th>
                </tr>
                </thead>
                <tbody>
                <?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['result']):
?>
                    <tr>
                        <td><?php echo $this->_tpl_vars['index']++; ?>
</td>
                        <td><?php echo $this->_tpl_vars['result']->name; ?>
</td>
                        <td><?php echo $this->_tpl_vars['result']->email; ?>
</td>
                        <td><?php echo $this->_tpl_vars['result']->tel; ?>
</td>
                        <td><?php echo $this->_tpl_vars['result']->address; ?>
</td>
                        <td>
                            <button class="btn btn-warning"
                                    onclick="window.open('Input_Controller.php?id=<?php echo $this->_tpl_vars['result']->id; ?>
','_self')">Edit
                            </button>
                        </td>
                        <td>
                            <button class="btn btn-danger " onclick="deleteUser(<?php echo $this->_tpl_vars['result']->id; ?>
)">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; endif; unset($_from); ?>
                </tbody>
            </table>
            <button class="btn btn-success" onclick="window.open('Input_Controller.php','_self')">Add student</button>

        </div>
    </div>
</div>

<?php echo '
    <script type="text/javascript">
        function deleteUser(id) {
            if (confirm("Bạn có chắc muốn xóa")) {
                $.post(\'C_User.php\', {
                    \'id\': id
                }, function (data) {
                    alert(data)
                    location.reload()
                })
            }

        }
    </script>
'; ?>

</body>
</html>