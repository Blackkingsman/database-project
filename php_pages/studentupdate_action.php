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

    $sessionid = $_POST["sessionid"];
    $currentpassword = $_POST["currentPassword"];
    $newPassword = $_POST["newPassword"];


    verify_session($sessionid);

    $sql ="";
    $retrievepasswordsql = "select password from myclient where clientid = (select clientid from myclientsession where sessionid = '$sessionid')";
    $changepassword = "UPDATE myclient SET password = '$newPassword' where clientid = (select clientid from myclientsession where sessionid = '$sessionid')";
    
    $result_array = execute_sql_in_oracle($retrievepasswordsql);
    $result = $result_array["flag"];
    $cursor = $result_array["cursor"];
    
    if($result == false){
        display_oracle_error_message($cursor);
        die("Client Query Failed.");
    }

    if($values = oci_fetch_array($cursor)){
        oci_free_statement($cursor);
        $clientstoredpassword = $values[0];
        
    }   
    if ($currentpassword == $clientstoredpassword){
        $result_array = execute_sql_in_oracle($changepassword);
    
        $result = $result_array["flag"];
        $cursor = $result_array["cursor"];
        
    if($result == false){
        display_oracle_error_message($cursor);
        die("Client Query Failed.");
    }
        Header("Location: ../static_pages/login.html");
    }
    
    ?>
</body>