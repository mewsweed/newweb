<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=utf-8");
    include('../server.php');
    try{
        $stmt = $dbh->prepare("SELECT * FROM event_joined where event_id= ?");
        $stmt->execute([$_GET['id']]);
        foreach ($stmt as $row){
            $join = array(
                'id'=> $row['id'],
                'user_id'=> $row['user_id'],
                'event_id'=> $row['event_id'],
                'joinAt'=> $row['joinAt'],
                'runNo'=> $row['runNo'],
                'paid'=> $row['paid'],
            );
            echo json_encode($join);
            break;   
        }
        $dbh = null;
    }catch(PDOException $e){
        print "Error: " . $e->getMessage() ."<br/>";
        die();
    }

