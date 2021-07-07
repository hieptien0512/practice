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
            <li class="nav-item active">
                <a class="nav-link">Home</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropleft">
                <a class="nav-link dropdown-toggle text-warning" id="navbarDropdown" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    User
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <div class="dropdown-item disable">{$smarty.session.login->name|escape:"html"}</div>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="../controller/Logout_User_Controller.php">Log Out</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h2 class="strokeme display-4 text-center text-warning font-weight-bold">All Survey Available</h2>
        </div>

        <div class="panel-body mt-2">
            <table class="table table-bordered text-warning">
                <thead>
                <tr>
                    <th width="60rem">No.</th>
                    <th>Survey Name</th>
                    <th>Description</th>
                    <th width="100rem">Status</th>
                    <th width="100rem"></th>
                </tr>
                </thead>
                <tbody>
                {foreach from=$surveyList item=result}
                    <tr>
                        <td width="60rem">{$index++}</td>
                        <td>{$result->name|escape:"html"}</td>
                        <td>{$result->description|escape:"html"}</td>
                        <td width="100rem">{if $result->status eq 1}
                                Open
                            {else}
                                Close
                            {/if}
                        </td>
                        {if $result->status eq 1}
                            <td width="100rem">
                                <button class="btn btn-success"
                                        onclick="window.open('Start_Survey_Controller.php','_self')">
                                    Start
                                </button>
                            </td>
                        {/if}
                        {if $result->status eq 2}
                            <td width="100rem">
                                <button class="btn btn-success"
                                        onclick="window.open('Result_Survey_Controller.php','_self')">
                                    Result
                                </button>
                            </td>
                        {/if}
                    </tr>
                {/foreach}
                </tbody>
            </table>
        </div>
        <nav aria-label="...">
            <ul class="pagination pagination-sm justify-content-end">

                {if $prePage neq 0}
                    <li class="page-item {if $prePage eq 0}disabled{/if}">
                        <a class="page-link text-warning" href="Main_Page_Controller.php?page={$prePage}">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link text-warning"
                                             href="Main_Page_Controller.php?page={$prePage}">{$prePage}</a>
                    </li>
                {/if}
                <li class="page-item active"><a class="page-link text-warning"
                                                href="Main_Page_Controller.php?page={$thisPage}">{$thisPage} </a>
                </li>
                {if $nextPage lt $maxPage}
                    <li class="page-item"><a class="page-link text-warning"
                                             href="Main_Page_Controller.php?page={$nextPage}">{$nextPage}</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link text-warning" href="Main_Page_Controller.php?page={$nextPage}">Next</a>
                    </li>
                {/if}

            </ul>
        </nav>
    </div>
</div>
</body>
</html>
