<?php /* Smarty version 2.6.31, created on 2021-07-05 02:39:48
         compiled from main_admin.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'main_admin.tpl', 80, false),)), $this); ?>
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
        <?php echo '
        body {
            background-image: url(\'../bg.jpeg\');
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

        '; ?>

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
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropleft">
                <a class="nav-link dropdown-toggle text-warning" id="navbarDropdown" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    User
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <div class="dropdown-item disable"><?php echo ((is_array($_tmp=$_SESSION['login']->name)) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</div>
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
            <h2 class="strokeme display-4 text-center text-warning font-weight-bold">All Your Survey</h2>
        </div>
        <button class="btn btn-success"
                onclick="window.open('Input_Survey_Controller.php','_self')">
            Create New Survey
        </button>

        <div class="panel-body mt-2">
            <table class="table table-bordered text-warning">
                <thead>
                <tr>
                    <th width="60rem">No.</th>
                    <th>Survey Name</th>
                    <th>Description</th>
                    <th width="100rem">Status</th>
                    <th width="100rem"></th>
                    <th width="100rem"></th>
                </tr>
                </thead>
                <tbody>
                <?php $_from = $this->_tpl_vars['surveyList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['result']):
?>
                    <tr>
                        <td width="60rem"><?php echo $this->_tpl_vars['index']++; ?>
</td>
                        <td><?php echo ((is_array($_tmp=$this->_tpl_vars['result']->name)) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</td>
                        <td><?php echo ((is_array($_tmp=$this->_tpl_vars['result']->description)) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</td>
                        <td width="100rem"><?php if ($this->_tpl_vars['result']->status == 0): ?>
                                Created
                            <?php elseif ($this->_tpl_vars['result']->status == 1): ?>
                                Open
                            <?php else: ?>
                                Close
                            <?php endif; ?>
                        </td>

                        <td width="100rem">
                            <button class="btn btn-warning"
                                    onclick="window.open('Input_Survey_Controller.php?id=<?php echo $this->_tpl_vars['result']->id; ?>
','_self')"
                                    <?php if ($this->_tpl_vars['result']->status != 0): ?>disabled<?php endif; ?>>
                                Edit
                            </button>
                        </td>
                        <?php if ($this->_tpl_vars['result']->status == 1): ?>
                            <td width="100rem">
                                <button class="btn btn-danger" onclick="surveyStatus(<?php echo $this->_tpl_vars['result']->id; ?>
, <?php echo $this->_tpl_vars['result']->status; ?>
)">
                                    Close
                                </button>
                            </td>
                        <?php endif; ?>
                        <?php if ($this->_tpl_vars['result']->status == 0): ?>
                            <td width="100rem">
                                <button class="btn btn-success "
                                        onclick="surveyStatus(<?php echo $this->_tpl_vars['result']->id; ?>
, <?php echo $this->_tpl_vars['result']->status; ?>
)">
                                    Open
                                </button>
                            </td>
                        <?php endif; ?>
                        <?php if ($this->_tpl_vars['result']->status == 2): ?>
                            <td width="100rem">
                                <button class="btn btn-success "
                                        onclick="window.open('Result_Survey_Controller.php','_self')">
                                    Result
                                </button>
                            </td>
                        <?php endif; ?>

                    </tr>
                <?php endforeach; endif; unset($_from); ?>

                </tbody>
            </table>

        </div>
        <nav aria-label="...">
            <ul class="pagination pagination-sm justify-content-end">

                <?php if ($this->_tpl_vars['prePage'] != 0): ?>
                    <li class="page-item <?php if ($this->_tpl_vars['prePage'] == 0): ?>disabled<?php endif; ?>">
                        <a class="page-link text-warning" href="Main_Page_Controller.php?page=<?php echo $this->_tpl_vars['prePage']; ?>
">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link text-warning"
                                             href="Main_Page_Controller.php?page=<?php echo $this->_tpl_vars['prePage']; ?>
"><?php echo $this->_tpl_vars['prePage']; ?>
</a>
                    </li>
                <?php endif; ?>
                <li class="page-item active"><a class="page-link text-warning"
                                                href="Main_Page_Controller.php?page=<?php echo $this->_tpl_vars['thisPage']; ?>
"><?php echo $this->_tpl_vars['thisPage']; ?>
 </a>
                </li>
                <?php if ($this->_tpl_vars['nextPage'] < $this->_tpl_vars['maxPage']): ?>
                    <li class="page-item"><a class="page-link text-warning"
                                             href="Main_Page_Controller.php?page=<?php echo $this->_tpl_vars['nextPage']; ?>
"><?php echo $this->_tpl_vars['nextPage']; ?>
</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link text-warning" href="Main_Page_Controller.php?page=<?php echo $this->_tpl_vars['nextPage']; ?>
">Next</a>
                    </li>
                <?php endif; ?>

            </ul>
        </nav>
    </div>


</div>
<?php echo '
    <script type="text/javascript">
        function surveyStatus(id, status) {
            if (confirm("Are you sure want to change this survey status?")) {
                $.post(\'Status_Survey_Controller.php\', {
                    \'id\': id,
                    \'status\': status
                }, function () {
                    alert(\'Change Survey Status Success!\')
                    location.reload()
                })
            }

        }
    </script>
'; ?>


</body>
</html>