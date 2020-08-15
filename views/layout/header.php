<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Test work</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <meta name="google-site-verification" content="EVLgiptGACqb8QcNYm49Nbz-5Trk5qzh83Wl0jAp7pY"/>
    <meta name="yandex-verification" content="b78980b3337c9769"/>

    <!-- Favicons -->
    <link href="/img/favicon.png" rel="icon">

    <!-- Bootstrap CSS File -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" crossorigin="anonymous">


    <!-- Libraries CSS Files -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
          integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
    .nav-item{
        background: #0a99c7;
        margin-right: 5px;
    }

    .nav-item .nav-link {
        color: white!important;
    }

    .err_mes{
        color: red!important;
        display: none;
    }

    .p-t-15{
        padding-top: 15px;
    }

    #tasks_table_wrapper {
        padding-top: 50px;
    }

    .m-t-15{
        margin-top: 15px;
    }

    .fr{
        float: right;
    }

    #status{
        zoom: 1.5;
    }

</style>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src=" https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/mvc_project/tasks/create">Create task</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/mvc_project/tasks">Task list</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <?php if (isset($_SESSION['user'])){
                    ?>
                    <li class="nav-item nav_right">
                        <a class="nav-link" href="/mvc_project/user/logout">Log out</a>
                    </li>
                    <?php
                }else{ ?>
                <li class="nav-item nav_right">
                    <a class="nav-link" href="/mvc_project/user/login">Log in</a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </nav>