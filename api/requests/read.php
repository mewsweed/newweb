<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Content-Type");
    header("Content-Type: application/json; charset=utf-8");
    include('../server.php');
    try{

        $request = array();
        foreach($dbh->query('SELECT * FROM requests')as $row){
            array_push($request, array(
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
            ));
        }
        echo json_encode($request);
    
        $dbh = null;
    }catch(PDOException $e){
        print "Error: " . $e->getMessage() ."<br/>";
        die();
    }

