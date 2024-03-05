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
    
    try {
        $dbh->beginTransaction();
    
        // ทำการลบข้อมูลในตารางที่มี foreign key ชี้ไปยังตารางหลัก
        $stmt_face = $dbh->prepare("DELETE FROM face WHERE user_id = ?");
        $stmt_face->bindParam(1, $data->id);
        $stmt_face->execute();
        // ทำการลบข้อมูลในตารางที่มี foreign key ชี้ไปยังตารางหลัก
        $stmt_info = $dbh->prepare("DELETE FROM info WHERE user_id = ?");
        $stmt_info->bindParam(1, $data->id);
        $stmt_info->execute();

        $stmt_join = $dbh->prepare("DELETE FROM event_joined WHERE user_id = ?");
        $stmt_join->bindParam(1, $data->id);
        $stmt_join->execute();
        
        // ทำการลบข้อมูลในตารางหลัก
        $stmt = $dbh->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bindParam(1, $data->id);
        $stmt->execute();
    
        // ยืนยันการทำรายการ
        $dbh->commit();
    
        echo json_encode(array("status"=>"ok", "message"=>"Deleted"));
    } catch (PDOException $e) {
        // ถ้ามีข้อผิดพลาดเกิดขึ้น ทำการยกเลิกรายการ
        $dbh->rollBack();
        echo json_encode(array("status"=>"error", "message"=>$e->getMessage()));
    }
    