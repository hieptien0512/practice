<!doctype html>
<html lang="vi">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign In Survey Tool</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <style>
        {literal}
        .myDiv {
            background-image: url('../bg.jpeg');
            height: 100%;
            width: 100%;
            position: absolute;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .strokeme {
            color: white;
            text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
        }

        .lb {
            font-size: 20px;
        }

        .panel-body {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-group {
            width: 600px;
        }

        {/literal}
    </style>
</head>
<body>
<div class="myDiv">
    <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
        <a class="navbar-brand text-warning font-weight-bold" href="../index.php">Survey Tool</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            </ul>
        </div>
    </nav>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h2 class="strokeme display-3 text-center text-warning font-weight-bold">Sign In</h2>
        </div>
        <div class="panel-body">
            <form method="post">
                <div class="form-group">
                    <label class="lb text-warning" for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control form-control-lg" id="email" name="email"
                           aria-describedby="emailHelp" placeholder="Enter Email">
                </div>
                <div class="form-group">
                    <label class="lb text-warning" for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control form-control-lg" id="password" name="password"
                           placeholder="Enter Password">
                </div>
                <div class="text-danger font-weight-bold">{if isset($error) }{$error}{/if}</div>
                <button type="submit" class="btn btn-outline-warning ">Sign In</button>
                <br>
                <a href="Signup_User_Controller.php">You Don't Have An Account ?</a>
            </form>
        </div>
    </div>
</div>


</body>
</html>
