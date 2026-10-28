<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../custom-css/stylesheet.css">
    <!-- Title of the website -->
    <title>Student-Admin</title>
</head>

<body>
    <?php
    include "utility_functions.php";
    $sessionid = $_GET["sessionid"];
    verify_session($sessionid);
    ?>
    <!--Homepage banner-->
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a href="#" class="navbar-brand">Welcome to Student-Admin Page</a>
        <button class="navbar-toggler" data-toggle = "collapse" data-target ="#navbarMenu">
            <span class = "navbar-toggler-icon"></span>
        </button>
       <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav">
                <li class="navbar-item mx-2">
                    <?php
                        echo("<a href='studentupdate_password.php?sessionid=$sessionid'>Update Password</a>");
                    ?>
                </li>
                <li class="navbar-item mx-2">
                    <?php
                        echo("<a href='adminpage.php?sessionid=$sessionid'>Admin Page</a>");
                    ?>
                </li>
            </ul>
        </div>
        <div class="justify-content-end">
            <?php
                echo("<a class='btn btn-outline-danger justify-content-center' href='logout_action.php?sessionid=$sessionid' role='button'>Logout</a> ");
            ?>
        </div>
    </nav>


    <body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
