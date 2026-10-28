<?php

    include "utility_functions.php";

    //Get client inforation
    $clientid = $_POST["clientid"];
    $password = $_POST["password"];
    $clientType = $_POST["clientType"];

    $sql = "";

    if($clientType == "studentType"){
      $sql = "select clientid ".
      "from myclient ".
      "where clientid='$clientid'
          and password ='$password'
          and administratorFlag!='1'";
    }
    if($clientType=="administratorType"){
      $sql = "select clientid ".
      "from myclient ".
      "where clientid='$clientid'
          and password ='$password'
          and administratorFlag='1'";
    }
    if($clientType == "bothType"){
      $sql = "select clientid ".
      "from myclient ".
      "where clientid='$clientid'
          and password ='$password'
          and administratorFlag='1'
          and studentFlag='1'";
    }
    
    
    $result_array = execute_sql_in_oracle($sql);
    $result = $result_array["flag"];
    $cursor = $result_array["cursor"];
    
    if($result == false){
        display_oracle_error_message($cursor);
        die("Client Query Failed.");
    }

    if($values = oci_fetch_array ($cursor)){
        oci_free_statement($cursor);
      
        // found the client
        $clientid = $values[0];
      
        // create a new session for this client
        $sessionid = md5(uniqid(rand()));
      
        // store the link between the sessionid and the clientid
        // and when the session started in the session table
      
        $sql = "insert into myclientsession " .
          "(sessionid, clientid, sessiondate) " .
          "values ('$sessionid', '$clientid', sysdate)";
      
        $result_array = execute_sql_in_oracle ($sql);
        $result = $result_array["flag"];
        $cursor = $result_array["cursor"];
      
        if ($result == false){
          display_oracle_error_message($cursor);
          die("Failed to create a new session");
        }
        else {
          // insert OK - we have created a new session
          //header("Location:welcomepage.php?sessionid=$sessionid");
          if($clientType == 'studentType'){
           // echo( "<p>Welcome to the student page</p>" );
            header('Location:studentpage.php?sessionid='.$sessionid);
          }
          else if($clientType == 'administratorType'){
            // echo( "<p>Welcome to the admin page</p>" );
            header("Location:adminpage.php?sessionid=".$sessionid);
          }else if($clientType == 'bothType'){
            header("Location:bothpage.php?sessionid=".$sessionid);
          }
        }
      }
      else { 
        // client username not found
        die ('Login failed.  Click <A href="../static_pages/login.html">here</A> to go back to the login page.');
      } 
?>