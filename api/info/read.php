<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Content-Type");
    header("Content-Type: application/json; charset=utf-8");
    include('../server.php');
    try{

        $info = array();
        foreach($dbh->query('SELECT * FROM info')as $row){
            array_push($info,array(
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
            ));
        }
        echo json_encode($info);
    
        $dbh = null;
    }catch(PDOException $e){
        print "Error: " . $e->getMessage() ."<br/>";
        die();
    }

