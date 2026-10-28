<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../custom-css/stylesheet.css">
    <title>Update User</title>
</head>

<body>
    <?php
        include "utility_functions.php";

        $sessionid = $_POST["sessionid"];
        $previousClientId = $_POST["previousClientId"];
        $clientid = $_POST["clientid"];
        $password = $_POST["password"];
        $clientType = $_POST["clientType"];

        // echo($sessionid);
        // echo($previousClientId);
        // echo($clientid);
        // echo($password);
        //echo($clientType);

        $updateStudent = "";
        $updateAdmin = "";

        if($clientType == "studentType"){
            $updateStudent = "1";        
            $updateAdmin = "0";
        }else if($clientType == "administratorType"){
            $updateStudent = "0";        
            $updateAdmin = "1";
        }else{
            $updateStudent = "1";        
            $updateAdmin = "1";
        }               

        $sql = "update myclient set studentFlag='$updateStudent', administratorFlag='$updateAdmin', password='$password' ".
                "where clientid='$clientid'";

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
