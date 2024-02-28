<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=utf-8");
    include('../server.php');
    try{
        $stmt = $dbh->prepare("SELECT * FROM requests where id = ?");
        $stmt->execute([$_GET['id']]);
        foreach ($stmt as $row){
            $request = array(
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
            );
            echo json_encode($request);
            break;   
        }
        $dbh = null;
    }catch(PDOException $e){
        print "Error: " . $e->getMessage() ."<br/>";
        die();
    }

