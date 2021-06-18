<!doctype html>
<html lang="vi">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit & New User</title>
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
            <h2 class="text-center">Thêm mới và chỉnh sửa thông tin User</h2>
        </div>
        <form  method="post">
            <div class="panel-body">
                <div class="form-group">
                    <label for="usr">Name:</label>
                    <input type="number" name="id" value="{if isset($user) }{$user->id}{/if}" style="display:none;" >
                    <input required="true" type="text" class="form-control" id="name" name="name" value="{if isset($user) }{$user->name}{/if}">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="{if isset($user) }{$user->email}{/if}">
                </div>
                <div class="form-group">
                    <label for="tel">Tel:</label>
                    <input type="number" class="form-control" id="tel" name="tel" value="{if isset($user)}{$user->tel}{/if}">
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" class="form-control" id="address" name="address" value="{if isset($user)}{$user->address}{/if}">
                </div>
                <button class="btn btn-success">Save</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>