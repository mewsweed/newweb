<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=utf-8");
    include('../server.php');
    try{
        $stmt = $dbh->prepare("SELECT * FROM events where id = ?");
        $stmt->execute([$_GET['id']]);
        foreach ($stmt as $row){
            $event = array(
                'id'=> $row['id'],
                'name'=> $row['name'],
                'about'=> $row['about'],
                'datetime'=> $row['datetime'],
                'type'=> $row['type'],
                'distance'=> $row['distance'],
                'cost'=> $row['cost'],
                'owner'=> $row['owner'],
                'address'=> $row['address'],
                'province'=> $row['province'],
                'dist'=> $row['dist'],
                'subdist'=> $row['subdist'],
                'zip'=> $row['zip'],
                'coverimg'=> $row['coverimg'],
                'mapimg'=> $row['mapimg'],
                'rewardimg'=> $row['rewardimg'],
                'paymentimg'=> $row['paymentimg'],
                'status'=> $row['status'],
                'photo'=> $row['photo'],
            );
            echo json_encode($event);
            break;   
        }
        $dbh = null;
    }catch(PDOException $e){
        print "Error: " . $e->getMessage() ."<br/>";
        die();
    }

