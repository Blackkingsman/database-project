 <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <link rel="stylesheet" href="../dist/css/bootstrap.min.css">
     <link rel="stylesheet" href="../custom-css/stylesheet.css">
     <!-- Title of the website -->
     <title>Adminstrator</title>
 </head>

 <body>

<?php
    include "utility_functions.php";
    $sessionId = $_GET["sessionid"];
    verify_session($sessionId);
?>

    <!-- Admin page -->

     <!--Homepage banner-->
    <div class="jumbotron jumbotron-fluid sticky-top justify-content-center" id="homepage-jumbotron">
        <h1 class="text-white text-center col-md-12">Welcome to Adminstrator Page</h1>
    </div>
    <div class="container justify-content-end">
        <?php
            echo("<a class='btn btn-outline-danger' href='logout_action.php?sessionid=$sessionId' role='button'>Logout</a> ");
        ?>
    </div>

    <div class="container my-5">
        <div class="row col-sm-12">
            <h1 class="col-md-8 justify-content-center">Current Users</h1>
            <button class="col-md-4 btn btn-success" data-toggle="modal"
                type="button" data-target="#createFormModal">Create Client</button>
        </div>
    </div>

    <!-- Table to display all the current user and information -->
    <div class="container my-10 justify-content-center col-md-10">
        <!-- The styling for the table -->
        <table class="table table-dark">
            <!-- Heading for the table which remains constant -->
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Client Id:</th>
                    <th scope="col">Student</th>
                    <th scope="col">Administrator</th>
                    <th scope="col">Password</th>
                    <th scope="col">Delete</th>
                    <th scope="col">Update</th>                    
                </tr>
            </thead>
            <!-- The body of the table will be automatically generated
                by the database calls (currently dummy data)-->
            <tbody>
                <?php
                    $sql = "select * from myclient";

                    $result_array = execute_sql_in_oracle($sql);
                    $result = $result_array["flag"];
                    $cursor = $result_array["cursor"];

                    if($result == false){
                        display_oracle_error_message($cursor);
                        die("Getting All Users Failed!");
                    }

                    $counter = 1;
                    while($values = oci_fetch_array($cursor)){

                        $clientid = $values[0];
                        $clientIsStudent = $values[1];
                        $clientIsAdmin = $values[2];
                        $clientPassword = $values[3];

                        $displayStudent = "";
                        $displayAdmin = "";
                        
                        if($clientIsStudent == '1'){
                            $displayStudent = "Yes";
                        }else{
                            $displayStudent = "No";
                        }

                        if($clientIsAdmin == "1"){
                            $displayAdmin = "Yes";
                        }else{
                            $displayAdmin = "No";
                        }
                        
                        echo(
                           "<tr class='justify-content-center'>" .
                                "<td class='justify-content-center'>" .$counter ."</td>".
                                "<td class='justify-content-center'>" .$clientid."</td>".
                                "<td class='justify-content-center'>" .$displayStudent. "</td>".
                                "<td class='justify-content-center'>" .$displayAdmin. "</td>".
                                "<td class='justify-content-center'>" .$clientPassword. "</td>".
                                "<td class='justify-content-center'>
                                    <a class='btn btn-danger' role='button' href='delete_clientaction.php?sessionid=$sessionId&clientid=$clientid'>Delete</a>
                                </td>".
                                "<td class='justify-content-center'>
                                    <a class='btn btn-info' role='button' href='update_client.php?sessionid=$sessionId&clientid=$clientid'>Update</a>
                                </td>".
                            "</tr>"
                        );
                        $counter++;
                    }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal to let the user add client to the table -->
    <div class="modal fade" id="createFormModal" tabindex="-1" role="dialog" aria-labelledby="createFormModalLabel" aria-hidden="true">           
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createFormModalLabel">Create User Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form class="justify-content-center" name="createClient" method="POST" action="create_newclientaction.php">
                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-10">
                                <label for="sessionid">Logged-In Session ID:</label>
                                <?php
                                    echo(
                                        "<input type='text' class='form-control' id='sessionid' 
                                        name='sessionid' placeholder=$sessionId value=$sessionId readonly>"
                                    );
                                ?>
                            </div>
                            <div class="form-group col-md-10">
                                <label for="clientid">Email:</label>
                                <input type="text" class="form-control" id="clientid" 
                                    name="clientid" placeholder="Enter your email here.">
                            </div>
                            <div class="form-group col-md-10">
                                <label for="password">Password:</label>
                                <input type="text" class="form-control" id="password"
                                    name="password" placeholder="Enter your password here.">
                            </div>
                            <div class="form-group col-md-10">
                                <label for="clientType">Student/Admin/Both</label>
                                <select name="clientType" id="clientType" class="form-control">
                                    <option selected value="studentType">Student</option>
                                    <option value="administratorType">Admin</option>
                                    <option value="bothType">Both</option>
                                </select>
                            </div>
                            <div class="form-group col-md-10">
                                <button type="submit" id="adminpage_create_button" class="btn btn-success">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts added for the modals -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"
        integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n"
        crossorigin="anonymous"></script>
    <script src="../dist/js/bootstrap.min.js"></script>

 </body>