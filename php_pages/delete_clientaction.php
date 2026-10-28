<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../custom-css/stylesheet.css">
    <title>Processing...</title>
</head>

<body>
     
    <?php

        include "utility_functions.php";

        //get client information

        $sessionid = $_GET["sessionid"];
        $clientid = $_GET["clientid"];

        verify_session($sessionid);

        $sql = "delete from myclient where clientid='$clientid'";

        $result_array = execute_sql_in_oracle($sql);
        $result = $result_array["flag"];
        $cursor = $result_array["cursor"];

        if($result == false){
            display_oracle_error_message($cursor);
            die("Client Query Failed.");
        }

        Header("Location:adminpage.php?sessionid=$sessionid");
    ?>

</body>