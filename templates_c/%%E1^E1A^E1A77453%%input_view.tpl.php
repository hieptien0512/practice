<?php /* Smarty version 2.6.31, created on 2021-06-16 09:32:28
         compiled from input_view.tpl */ ?>
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
            <h2 class="text-center">Thêm mới và chỉnh sửa thông tin User</h2>
        </div>
        <form  method="post">
            <div class="panel-body">
                <div class="form-group">
                    <label for="usr">Name:</label>
                    <input type="number" name="id" value="<?php if (isset ( $this->_tpl_vars['user'] )): ?><?php echo $this->_tpl_vars['user']->id; ?>
<?php endif; ?>" style="display:none;" >
                    <input required="true" type="text" class="form-control" id="name" name="name" value="<?php if (isset ( $this->_tpl_vars['user'] )): ?><?php echo $this->_tpl_vars['user']->name; ?>
<?php endif; ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php if (isset ( $this->_tpl_vars['user'] )): ?><?php echo $this->_tpl_vars['user']->email; ?>
<?php endif; ?>">
                </div>
                <div class="form-group">
                    <label for="tel">Tel:</label>
                    <input type="number" class="form-control" id="tel" name="tel" value="<?php if (isset ( $this->_tpl_vars['user'] )): ?><?php echo $this->_tpl_vars['user']->tel; ?>
<?php endif; ?>">
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" class="form-control" id="address" name="address" value="<?php if (isset ( $this->_tpl_vars['user'] )): ?><?php echo $this->_tpl_vars['user']->address; ?>
<?php endif; ?>">
                </div>
                <button class="btn btn-success">Save</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>