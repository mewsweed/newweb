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
        $stmt = $dbh->prepare("UPDATE info SET
         fname=?, lname=?, birthday=?, phone=?, emerphone=?,
         gender=?, size=?, address=?, province=?, dist=?,
         subdist=?, zip=?
         where user_id=?");
        $stmt->bindParam(1, $data->fname);
        $stmt->bindParam(2, $data->lname);
        $stmt->bindParam(3, $data->birthday);
        $stmt->bindParam(4, $data->phone);
        $stmt->bindParam(5, $data->emerphone);
        $stmt->bindParam(6, $data->gender);
        $stmt->bindParam(7, $data->size);
        $stmt->bindParam(8, $data->address);
        $stmt->bindParam(9, $data->province);
        $stmt->bindParam(10, $data->dist);
        $stmt->bindParam(11, $data->subdist);
        $stmt->bindParam(12, $data->zip);
        $stmt->bindParam(13, $data->user_id);

        if($stmt->execute()){
            echo json_encode(array("status"=>"ok", "message"=>"User info is updated."));
        }else{
            echo json_encode(array("status"=>"error", "message"=>"Can't update user info. "));
        }
        $dbh = null;
    }catch(PDOException $e){
        print "Error: " . $e->getMessage() ."<br/>";
        die();
    }

