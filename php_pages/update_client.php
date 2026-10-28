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

        //get client information

        $sessionid = $_GET["sessionid"];
        $clientid = $_GET["clientid"];

        // echo($sessionid);
        // echo($clientid);

        verify_session($sessionid);

        //we are going to grab client information

        $sql = "select * from myclient where clientid='$clientid'";

        $result_array = execute_sql_in_oracle($sql);
        $result = $result_array["flag"];
        $cursor = $result_array["cursor"];

        if($result == false){
            display_oracle_error_message($cursor);
            die("Client Query Failed.");
        }
        //getting the values back from the ops fetch
        if($values = oci_fetch_array($cursor)){
            oci_free_cursor($cursor);

            $clientStoredId = $values[0];
            $clientStoredStudetFlag = $values[1];
            $clientStoredAdminFlag = $values[2];
            $clientStoredPassword = $values[3];

            //correct information was being grabbed from the database
            // echo($clientStoredId);
            // echo($clientStoredStudetFlag);
            // echo($clientStoredAdminFlag);
            // echo($clientStoredPassword);

            $clientStoredType = "";
            if($clientStoredStudetFlag == "1" && $clientStoredAdminFlag == "0"){
                $clientStoredType = "studentType";
            }else if($clientStoredStudetFlag == "0" && $clientStoredAdminFlag == "1"){
                $clientStoredType = "administratorType";
            }else{
                $clientStoredType = "bothType";
            }

            //echo($clientStoredType);

        }else{
            // client username not found
            die ('Login failed.  Click <A href="adminpage.php">here</A> to go back to the login page.');
        }


    ?>
    <div class="jumbotron jumbotron-fluid sticky-top justify-content-center" id="homepage-jumbotron">
        <h1 class="text-white text-center col-md-12">Welcome to Update Page</h1>
    </div>

    <div class="container justify-content-center my-20">
        <div class="container justify-content-center">
            <?php
                echo("<a class='btn btn-outline-danger text-center' href='logout_action.php?sessionid=$sessionid' role='button'>Logout</a> ");
            ?>               
        </div>
    </div>

    <div class="container my-15 justify-content-center">
        <form class="justify-content-center" name="udpateClient" method="POST" action="update_clientaction.php">
            <div class="form-row justify-content-center">
                <div class="form-group col-md-10 invisible">
                    <label for="sessionid">Logged-In Session ID:</label>
                        <?php
                            echo(
                                "<input type='text' class='form-control' id='sessionid' 
                                name='sessionid' value=$sessionid readonly>"
                            );
                        ?>
                </div>
                <div class="form-group col-md-10 invisible">
                    <label for="previousClientId">Previous Client ID:</label>
                        <?php
                            echo(
                                "<input type='text' class='form-control' id='previousClientId' 
                                name='previousClientId' value=$clientid readonly>"
                            );
                        ?>
                </div>
                <div class="form-group col-md-10">
                    <label for="clientid">Email:</label>
                    <?php
                        echo(
                            "<input type='text' class='form-control' id='clientid' 
                            name='clientid' value=$clientStoredId readonly>"
                        );
                    ?>
                </div>
                <div class="form-group col-md-10">
                    <label for="password">Password:</label>
                    <?php
                        echo(
                            "<input type='text' class='form-control' id='password'
                            name='password' value=$clientStoredPassword>"
                        );
                    ?>                
                </div>
                <div class="form-group col-md-10">
                    <label for="clientType">Student/Admin/Both</label>
                    <select name="clientType" id="clientType" class="form-control">
                        <?php
                            if($clientStoredType == "studentType"){
                                echo("<option selected value='studentType'>Student</option>
                                <option value='administratorType'>Admin</option>
                                <option value='bothType'>Both</option>");
                            }else if($clientStoredType == "administratorType"){
                                echo("<option value='studentType'>Student</option>
                                <option selected value='administratorType'>Admin</option>
                                <option value='bothType'>Both</option>");
                            }else{
                                echo("<option value='studentType'>Student</option>
                                <option value='administratorType'>Admin</option>
                                <option selected value='bothType'>Both</option>");
                            }
                        ?>                    
                    </select>
                </div>
                <div class="form-group col-md-10">
                        <button type="submit" id="adminpage_update_button" class="btn btn-success">Update</button>
                </div>
            </div>
        </form>
    </div>


</body>