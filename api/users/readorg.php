<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Content-Type");
    header("Content-Type: application/json; charset=utf-8");
    include('../server.php');
    try{

        $users = array();
        foreach($dbh->query('SELECT * FROM users where role="organizer"')as $row){
            // print_r($row);
            array_push($users,array(
                'id'=> $row['id'],
                'email'=> $row['email'],
                'username'=> $row['username'],
                'password'=> $row['password'],
                'role'=> $row['role'],
            ));
        }
        echo json_encode($users);
    
        $dbh = null;
    }catch(PDOException $e){
        print "Error: " . $e->getMessage() ."<br/>";
        die();
    }