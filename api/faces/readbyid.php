<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=utf-8");

    include('../server.php');
    try{
        $stmt = $dbh->prepare("SELECT * FROM face where user_id = ?");
        $stmt->execute([$_GET['id']]);
        foreach ($stmt as $row){
            $face = array(
                'id'=> $row['id'],
                'user_id'=> $row['user_id'],
                'face'=> $row['face']
            );
            $faces[] = $face;
            
        }
        echo json_encode($faces);
        $dbh = null;
    }catch(PDOException $e){
        print "Error: " . $e->getMessage() ."<br/>";
        die();
    }

