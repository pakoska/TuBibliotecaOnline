<?php
    //page to call the function insertUser and showing the results. Before its double check the user input
    require_once('../php_includers/db_connection.php');
    $users = DB::listUsers();
    $totalUsers = count($users);
    $nick = strtolower($_POST["nick"]);
    $email = strtolower($_POST["email"]);
    $name = $_POST["name"];
    $subname = $_POST["subname"];
    $pass = $_POST["pass"];
    $userType = $_POST["userType"];
    $results = array();
    $totalResults = 0;

    //Checking the correct length of the nick and check if is in use
    if(strlen($nick) >= 3 && strlen($nick) <= 20){
      $results[0] = true;
      for ($i = 0; $i < $totalUsers; $i++){
        if($users[$i]["NICK"] == $nick){
          $results[0] = false;
        }
      }
    } 

    //Checking the correct length of the mail, if is a correct email and if is in the DB
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $results[1] = true;
      for ($i = 0; $i < $totalUsers; $i++){
        if($users[$i]["EMAIL"] == $email){
          $results[1] = false;
        }
      }
    }

    //Checking the correct length of the name
    if(strlen($name) >= 3 && strlen($name) <= 30){
        $results[2] = true;
    }

    //Checking the correct length of the subname
    if(strlen($subname) >= 3 && strlen($subname) <= 30){
      $results[3] = true;
    }

    //Checking the correct length of the pass
    if(strlen($pass) >= 6 && strlen($pass) <= 20){
      $results[4] = true;
    }

    //Counting the results
    for ($i = 0; $i < 5; $i++){
        if($results[$i]){
            $totalResults++;
        }
    }
    
    //insert the publisher if the results are ok
    if ($totalResults == 5){
        $addUserResult = DB::insertUser($nick, $name, $subname, $userType, $pass, $email);
        echo ($addUserResult);    
    } else {
        echo ("Los datos introducidos no son correctos.");
    }
?>