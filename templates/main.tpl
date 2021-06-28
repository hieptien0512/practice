<!doctype html>
<html lang="vi">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Main Page Survey Tool</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <style>
        {literal}
        .myDiv{
            background-image: url('../bg.jpeg');
            height: 100%; width:100%;
            position:absolute;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .strokeme {
            color: white;
            text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
        }
        .lb{
            font-size: 20px;
        }
        .panel-body{
            display:flex;
            justify-content: center;
            align-items: center;
        }
        .form-group{
            width:600px;
        }
        {/literal}
    </style>
</head>
<body >
<div class="myDiv">
    <nav class="navbar navbar-dark bg-dark navbar-expand-lg ">
        <a class="navbar-brand text-warning font-weight-bold" href="../index.php">Survey Tool</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto" >
                <li class="nav-item dropleft">
                    <a class="nav-link dropdown-toggle text-warning" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        User
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <div class="dropdown-item disable">{$smarty.session.login->name|escape:"html"}</div>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../controller/Logout_User_Controller.php">Log Out</a>
                    </div>
                </li>
            </ul>

        </div>
    </nav>
    <div class="panel panel-primary" >
        <div class="panel-heading" >
            <h2 class="strokeme display-3 text-center text-warning font-weight-bold">Main Page</h2>
        </div>

    </div>
</div>


</body>
</html>
