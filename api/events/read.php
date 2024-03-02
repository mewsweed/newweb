<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Content-Type");
    header("Content-Type: application/json; charset=utf-8");
    include('../server.php');
    try{

        $event = array();
        foreach($dbh->query('SELECT * FROM events')as $row){
            array_push($event, array(
                'id'=> $row['id'],
                'name'=>$row['name'],
                'about'=>$row['about'],
                'type'=>$row['type'],
                'datetime'=>$row['datetime'],
                'distance'=>$row['distance'],
                'cost'=>$row['cost'],
                'owner'=>$row['owner'],
                'address'=>$row['address'],
                'province'=>$row['province'],
                'dist'=>$row['dist'],
                'subdist'=>$row['subdist'],
                'zip'=>$row['zip'],
                'coverimg'=>$row['coverimg'],
                'mapimg'=>$row['mapimg'],
                'rewardimg'=>$row['rewardimg'],
                
            ));
        }
        echo json_encode($event);
    
        $dbh = null;
    }catch(PDOException $e){
        print "Error: " . $e->getMessage() ."<br/>";
        die();
    }

