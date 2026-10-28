<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../custom-css/stylesheet.css">
    <!-- Title of the website -->
    <title>Logging Out</title>
</head>

<body>

    <?php
        include "utility_functions.php";

        $sessionid = $_GET["sessionid"];

        //echo($sessionid);
        verify_session($sessionid);
        //delete the session from the myclientsession
        $sql = "delete from myclientsession where sessionid='$sessionid'";

        $result_array = execute_sql_in_oracle($sql);
        $result = $result_array["flag"];
        $cursor = $result_array["cursor"];

        if($result == false){
            display_oracle_error_message($cursor);
            die("Client Query Failed.");
        }
        //take back to the login-page
        Header("Location:../static_pages/login.html")
        
    ?>

</body>