<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../custom-css/stylesheet.css">
    <!-- Title of the website -->
    <title>Processing...</title>
</head>

<body>
    <?php
        include "utility_functions.php";

        //Get client information

        $sessionid = $_POST['sessionid'];
        $clientid = $_POST["clientid"];
        $password = $_POST["password"];
        $clientType = $_POST["clientType"];

        echo($sessionid);
        echo($clientid);
        echo($password);
        echo($clientType);

        verify_session($sessionid);


        $sql = "";
        $isStudent = "";
        $isAdmin = "";

        //create the client inside the client table
        if ($clientType == "studentType") {
            $isStudent = "1";
            $isAdmin = "0";
            $sql = "insert into myclient values('$clientid', '$isStudent', '$isAdmin', '$password')";
        }
        if ($clientType == "administratorType") {
            $isStudent = "0";
            $isAdmin = "1";
            $sql = "insert into myclient values('$clientid', '$isStudent', '$isAdmin', '$password')";
        }
        if ($clientType == "bothType") {
            $isStudent = "1";
            $isAdmin = "1";
            $sql = "insert into myclient values('$clientid', '$isStudent', '$isAdmin', '$password')";
        }

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

