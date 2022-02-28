<!doctype html>
<html lang="vi">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Survey Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../stylesheets/main.css">

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
                <a class="nav-link">View Survey </a>
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
    <h2 class="strokeme display-5 text-center text-warning font-weight-bold">View Survey</h2>
    <form class="formSurvey" method="post">

        <div class="form-group mt-2">
            <input type="text" class="form-control form-control-lg" id="surveyName" name="surveyName"
                   placeholder="Survey Name" value="{$survey->name|escape:"html"}" disabled>
        </div>
        <div class="form-group">
            <input type="text" class="form-control form-control-sm" id="surveyDescription" name="surveyDescription"
                   placeholder="Survey Description" value="{$survey->description|escape:"html"}" disabled>
        </div>
        <div class="cardList container">
            {foreach from=$questionList item=question}
                <div class="card mt-2" id="questionCard{$question->order|escape:"html"}">
                    <div class="card-header">
                        Question
                    </div>
                    <div class="card-body">
                        <!-- list holder -->
                        <div class="listHolder{$question->order|escape:"html"}">
                            <div class="form-group">
                                <label for="question"><b>{$question->question_content|escape:"html"}</b></label>
                            </div>
                            <ul class="list{$question->order|escape:"html"}">
                                {if $question->question_type eq 0}
                                    <input type="hidden" value="{$question->id|escape:"html"}"
                                           name="answer{$question->order|escape:"html"}[]">
                                    {foreach from=$choiceList item=choice }
                                        {if $choice->question_id eq $question->id}
                                            <div class="form-check{$index} required mt-2">
                                                <input class="form-check-input" type="checkbox"
                                                       value="{$choice->id|escape:"html"}"
                                                       name="answer{$question->order|escape:"html"}[]" disabled>
                                                <label class="form-check-label" for="defaultCheck1">
                                                    {$choice->choice|escape:"html"}
                                                </label>
                                            </div>
                                        {/if}
                                    {/foreach}
                                    <label hidden>{$index++}</label>
                                {else}
                                    <input type="hidden" value="{$question->id|escape:"html"}"
                                           name="answer{$question->order|escape:"html"}[]">
                                    {foreach from=$choiceList item=choice }
                                        {if $choice->question_id eq $question->id}
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="radio"
                                                       name="answer{$question->order|escape:"html"}[]"
                                                       value="{$choice->id|escape:"html"}" disabled>
                                                <label class="form-check-label" for="defaultCheck1">
                                                    {$choice->choice|escape:"html"}
                                                </label>
                                            </div>
                                        {/if}
                                    {/foreach}
                                {/if}


                            </ul>
                        </div>
                    </div>
                </div>
            {/foreach}

        </div>
    </form>
    <a class="btn btn-success btn-sm mt-2"
       id="addQuestionButton" href="Main_Page_Controller.php" style="float: right;">
        Return Home
    </a>

</div>
</body>
</html>
