<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Content-Type");
    
    header("Access-Control-Allow-Methods: DELETE, OPTIONS");
    header("Content-Type: application/json; charset=utf-8");
    include('../server.php');

    $data = json_decode(file_get_contents("php://input"));
    if($_SERVER['REQUEST_METHOD'] !== "DELETE"){
        echo json_encode(array("status"=>"error"));
        die();
    }
    
    try{
        $stmt = $dbh->prepare("DELETE FROM users where id=?");
        $stmt->bindParam(1, $data->id);

        if($stmt->execute()){
            echo json_encode(array("status"=>"ok"));
        }else{
            echo json_encode(array("status"=>"error"));
        }
        $dbh = null;
    }catch(PDOException $e){
        print "Error: " . $e->getMessage() ."<br/>";
        die();
    }

