<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=utf-8");
    include('../server.php');
    try{
        $stmt = $dbh->prepare("SELECT * FROM users where id = ?");
        $stmt->execute([$_GET['id']]);
        foreach ($stmt as $row){
            $user = array(
                'id'=> $row['id'],
                'email'=> $row['email'],
                'username'=> $row['username'],
                'password'=> $row['password'],
                'role'=> $row['role'],
            );
            echo json_encode($user);
            break;   
        }
        $dbh = null;
    }catch(PDOException $e){
        print "Error: " . $e->getMessage() ."<br/>";
        die();
    }

