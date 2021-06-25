<!doctype html>
<html lang="vi">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Landing Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <style>
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
    </style>
</head>
<body >
<div class="myDiv">
    <div class="panel panel-primary" >
        <div class="panel-heading">
            <h2 class="strokeme display-1 text-center text-warning font-weight-bold">Wellcome To The Survey Tool</h2>
        </div>
        <div class="panel-body" style="display:flex; justify-content: center; align-items: center;">
            <button class="btn btn-outline-warning btn-lg" style="margin: 4px 2px;" >Login</button>
            <button class="btn btn-outline-warning btn-lg" tyle="margin: 4px 2px;">Sign Up</button>
        </div>
    </div>
</div>



</body>
</html>
