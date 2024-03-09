<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Content-Type");
    header("Content-Type: application/json; charset=utf-8");

    include('../server.php');

    $data = json_decode(file_get_contents("php://input"));
    if($_SERVER['REQUEST_METHOD'] !== "POST"){
        echo json_encode(array("status"=>"error"));
        die();
    }


    try{
        if($data->coverimg ==="undefined"){
            echo json_encode(array("status"=>"error", "message"=>"คุณยังไม่ได้อัพโหลดไฟล์ภาพปก"));  
            die();
        }
        if(!$data->mapimg ==="undefined"){
            echo json_encode(array("status"=>"error", "message"=>"คุณยังไม่ได้อัพโหลดไฟล์ภาพปก"));  
            die();
        }
        if(!$data->rewardimg ==="undefined"){
            echo json_encode(array("status"=>"error", "message"=>"คุณยังไม่ได้อัพโหลดไฟล์ภาพปก"));  
            die();
        }
        if(!$data->paymentimg ==="undefined"){
            echo json_encode(array("status"=>"error", "message"=>"คุณยังไม่ได้อัพโหลดไฟล์ภาพปก"));  
            die();
        }
        $stmt = $dbh->prepare("INSERT INTO events (
             name, about, type, datetime, distance, cost, owner, 
             address, province, dist, subdist, zip, 
             coverimg, mapimg, rewardimg, paymentimg, status, photo
             ) VALUE (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bindParam(1, $data->name);
        $stmt->bindParam(2, $data->about);
        $stmt->bindParam(3, $data->type);
        $stmt->bindParam(4, $data->datetime);
        $stmt->bindParam(5, $data->distance);
        $stmt->bindParam(6, $data->cost);
        $stmt->bindParam(7, $data->owner);
        $stmt->bindParam(8, $data->address);
        $stmt->bindParam(9, $data->province);
        $stmt->bindParam(10, $data->dist);
        $stmt->bindParam(11, $data->subdist);
        $stmt->bindParam(12, $data->zip);
        $stmt->bindParam(13, $data->coverimg);
        $stmt->bindParam(14, $data->mapimg);
        $stmt->bindParam(15, $data->rewardimg);
        $stmt->bindParam(16, $data->paymentimg);
        $stmt->bindParam(17, $data->status);
        $stmt->bindParam(18, $data->photo);
        // $stmt->bindParam(1, ); 

        if($stmt->execute()){
            echo json_encode(array("status"=>"ok", "message"=>"Event is created."));
        }else{
            echo json_encode(array("status"=>"error", "message"=>"Can't create event."));
        }
        $dbh = null;
    }catch(PDOException $e){
        print "Error: " . $e->getMessage() ."<br/>";
        die();
    }

