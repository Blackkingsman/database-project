<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../custom-css/stylesheet.css">
    <!-- Title of the website -->
    <title>Update Password</title>
</head>
<body>
<?php
    include "utility_functions.php";
    $sessionid = $_GET["sessionid"];
    verify_session($sessionid);

    $sql = "select studentFlag, administratorFlag from myclient join myclientsession on myclient.clientid = myclientsession.clientid where sessionid='$sessionid'";
    $result_array = execute_sql_in_oracle($sql);
    $result = $result_array["flag"];
    $cursor = $result_array["cursor"];
    if($result == false){
        display_oracle_error_message($cursor);
        die("Client Query Failed.");
    }

    if($values = oci_fetch_array($cursor)){
        oci_free_cursor($cursor);

        $clientStoredStudetFlag = $values[0];
        $clientStoredAdminFlag = $values[1];

        $clientStoredType = "";
        if($clientStoredStudetFlag == "1" && $clientStoredAdminFlag == "0"){
            $clientStoredType = "studentType";
        }else{
            $clientStoredType = "bothType";
        }

    }else{
        // client username not found
        die ('Not found.  Click <A href="adminpage.php">here</A> to go back to the login page.');
    }

    ?>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a href="#" class="navbar-brand">Update Password Page</a>
        <button class="navbar-toggler" data-toggle = "collapse" data-target ="#navbarMenu">
            <span class = "navbar-toggler-icon"></span>
        </button>
       <div class="collapse navbar-collapse" id="navbarMenu">
       <ul class="navbar-nav ">
            <li class ="nav-item mx-2">
            <?php
                if($clientStoredType == "studentType"){
                    echo("<a href='studentpage.php?sessionid=$sessionid'>Home Page</a>");
                }else{
                    echo("<a href='bothpage.php?sessionid=$sessionid'>Home Page</a>");
                }
                ?>
            </li>
            <li class="navbar-item mx-2">
                <?php
                    echo("<a href='studentupdate_password.php?sessionid=$sessionid'>Update Password</a>");
                ?>
            </li>

        </ul>
       </div>
    </nav>
    <div class="container d-flex justify-content-center">
            <div class="row py-1">
                <h2 class="text-center text-dark">Change Password Form</h2>
            </div>
        </div>
        <!--Contains the form for signing in-->
        <div class="container my-2 font-weight-bold">
            <form class="justify-content-center" name="changePassword" method="POST" action="studentupdate_action.php">
                <div class="form-row justify-content-center">
                    <div class = "form-group col-md-10 ">
                        <label for="sessionid">Logged In Id:</label>
                        <?php
                            echo(
                                "<input type='text' class='form-control' id='sessionid' name='sessionid'
                                placeholder=$sessionid value=$sessionid readonly>"
                            );
                        ?>
                    </div>
                    <div class="form-group col-md-10">
                        <label for="currentPassword">Current Password</label>
                        <input type="text" class="form-control" id="currentPassword" name="currentPassword"
                            placeholder="Enter Current Password">
                    </div>
                    <div class="form-group col-md-10">
                        <label for="newPassword">Password:</label>
                        <input type="text" class="form-control" id="newPassword" name="newPassword"
                            placeholder="Enter your New Password">
                    </div>
                    <div class="form-group col-md-10">
                        <button type="submit" id="update_password_button" class="btn btn-primary btn-lg btn-block">Update Password</button>
                    </div>
                </div>
            </form>
        </div>
</body>