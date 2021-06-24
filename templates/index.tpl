<!doctype html>
<html lang="vi">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Display</title>
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
            <form method="get" action="/practice/controller/Search_User_Controller.php">
                <input type="text" name="key" class="form-control" style="margin-top: 15px; margin-bottom: 15px;" placeholder="Tìm Kiếm Theo tên">
            </form>
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
                {foreach from=$list item=result}
                    <tr>
                        <td>{$index++}</td>
                        <td>{$result->name}</td>
                        <td>{$result->email}</td>
                        <td>{$result->tel}</td>
                        <td>{$result->address}</td>
                        <td>
                            <button class="btn btn-warning"
                                    onclick="window.open('Input_User_Controller.php?id={$result->id}','_self')">Edit
                            </button>
                        </td>
                        <td>
                            <button class="btn btn-danger " onclick="deleteUser({$result->id})">Delete</button>
                        </td>
                    </tr>
                {/foreach}
                </tbody>
            </table>
            <button class="btn btn-success" onclick="window.open('Input_User_Controller.php','_self')">Add student</button>

        </div>
    </div>
</div>

{literal}
    <script type="text/javascript">
        function deleteUser(id) {
            if (confirm("Bạn có chắc muốn xóa")) {
                $.post('Delete_User_Controller.php', {
                    'id': id
                }, function (data) {
                    alert(data)
                    location.reload()
                })
            }

        }
    </script>
{/literal}
</body>
</html>
