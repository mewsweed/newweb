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
        $stmt = $dbh->prepare("UPDATE users SET username=?, email=?, role=? where id=?");
        $stmt->bindParam(1, $data->username);
        $stmt->bindParam(2, $data->email);
        $stmt->bindParam(3, $data->role);
        $stmt->bindParam(4, $data->id);

        if($stmt->execute()){
            echo json_encode(array("status"=>"ok", "message"=>"User updated."));
        }else{
            echo json_encode(array("status"=>"error", "message"=>"Can't update user."));
        }
        $dbh = null;
    }catch(PDOException $e){
        print "Error: " . $e->getMessage() ."<br/>";
        die();
    }

