<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=utf-8");
    include('../server.php');
    try{
        $stmt = $dbh->prepare("SELECT * FROM info where user_id = ?");
        $stmt->execute([$_GET['id']]);
        foreach ($stmt as $row){
            $info = array(
                'id'=> $row['id'],
                'user_id'=> $row['user_id'],
                'fname'=> $row['fname'],
                'lname'=> $row['lname'], 
                'birthday'=> $row['birthday'],
                'phone'=> $row['phone'],
                'emerphone'=> $row['emerphone'],
                'gender'=> $row['gender'],
                'size'=> $row['size'],
                'address'=> $row['address'],
                'province'=> $row['province'],
                'dist'=> $row['dist'],
                'subdist'=> $row['subdist'],
                'zip'=> $row['zip'],
            );
            echo json_encode($info);
            break;   
        }
        $dbh = null;
    }catch(PDOException $e){
        print "Error: " . $e->getMessage() ."<br/>";
        die();
    }

