<!doctype html>
<html lang="vi">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Survey</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <style>
        {literal}
        body {
            background-image: url('../bg.jpeg');
            height: 100%;
            width: 100%;
            position: absolute;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;

        }

        .strokeme {
            color: white;
            text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
        }

        .panel-body {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        tbody {
            display: block;
            height: 500px;
            overflow: auto;
        }

        thead, tbody tr {
            display: table;
            width: 100%;
            table-layout: fixed; /* even columns width , fix width of table too*/
        }

        thead {
            width: calc(100% - 1em) /* scrollbar is average 1em/16px width, remove it from thead width */
        }

        table {
            width: 400px;
        }

        {/literal}
    </style>
</head>
<body>
<nav class="navbar navbar-dark bg-dark navbar-expand-lg ">
    <a class="navbar-brand text-warning font-weight-bold" href="Main_Page_Controller.php">Survey Tool</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item ">
                <a class="nav-link" href="Main_Page_Controller.php">Home</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link">Create Survey <span class="sr-only">(current)</span></a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropleft">
                <a class="nav-link dropdown-toggle text-warning" id="navbarDropdown" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    User
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <div class="dropdown-item disable">{$userName|escape:"html"}</div>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="../controller/Logout_User_Controller.php">Log Out</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<div class="container cardHolder">
    <h2 class="strokeme display-4 text-center text-warning font-weight-bold">Create New Survey</h2>
    <form class="formSurvey" method="post">

        <div class="form-group mt-2">
            <input type="text" class="form-control form-control-lg" id="name"
                   name="name" placeholder="Survey Name" required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control form-control-sm" id="description"
                   name="description" placeholder="Survey Description" required>
        </div>
        <div class="text-danger font-weight-bold">{if isset($error) }{$error|escape:"html"}{/if}</div>

        <button class="btn btn-success" style="float: right;">Save</button>


    </form>

</div>


</body>
</html>
