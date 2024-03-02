<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: PATCH, OPTIONS");
    header("Content-Type: application/json; charset=utf-8");
    include('../server.php');

    $data = json_decode(file_get_contents("php://input"));
    if($_SERVER['REQUEST_METHOD'] !== "PATCH" && $_SERVER['REQUEST_METHOD'] !== "OPTIONS"){
        echo json_encode(array("status"=>"error"));
        die();
    }
    
    try{
        $stmt = $dbh->prepare("UPDATE requests SET
         name=?, about=?, datetime=?, type=?, distance=?, cost=?,
          owner=?, address=?, province=?, dist=?, subdist=?, zip=? 
         where id=?");
        $stmt->bindParam(1, $data->name);
        $stmt->bindParam(2, $data->about);
        $stmt->bindParam(3, $data->datetime);
        $stmt->bindParam(4, $data->type);
        $stmt->bindParam(5, $data->distance);
        $stmt->bindParam(6, $data->cost);
        $stmt->bindParam(7, $data->owner);
        $stmt->bindParam(8, $data->address);
        $stmt->bindParam(9, $data->province);
        $stmt->bindParam(10, $data->dist);
        $stmt->bindParam(11, $data->subdist);
        $stmt->bindParam(12, $data->zip);
        $stmt->bindParam(13, $data->id);

        if($stmt->execute()){
            echo json_encode(array("status"=>"ok", "message"=>"Request updated."));
        }else{
            echo json_encode(array("status"=>"error", "message"=>"Can't update request."));
        }
        $dbh = null;
    }catch(PDOException $e){
        print "Error: " . $e->getMessage() ."<br/>";
        die();
    }

