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

    $id = $_POST['id'];

// เช็คว่ามีไฟล์ถูกอัปโหลดหรือไม่
if(isset($_FILES['face']) && !empty($_FILES['face']['name'])){
    $file_name = $_FILES['face']['name'];
    $file_tmp = $_FILES['face']['tmp_name'];
    $file_type = $_FILES['face']['type'];

    // ตรวจสอบประเภทของไฟล์
    $allowed_extensions = array("image/jpeg", "image/jpg", "image/png");
    if(!in_array($file_type, $allowed_extensions)){
        echo json_encode(array("status" => "error", "message" => "ไฟล์ที่อัปโหลดไม่ใช่รูปภาพ"));
        exit;
    }

    // สร้างที่อยู่ของไฟล์
    $file_path = "../../uploads/" . $file_name;

    // เคลื่อนย้ายไฟล์ไปยังโฟลเดอร์ที่กำหนด
    if(move_uploaded_file($file_tmp, $file_path)){
        // เพิ่มข้อมูลลงในฐานข้อมูลหรือทำอื่นๆ ตามต้องการ

        // เมื่อเสร็จสิ้นให้ส่งข้อความกลับไปยังแอปพลิเคชันเว็บ
        echo json_encode(array("status" => "ok", "message" => "อัปโหลดรูปภาพสำเร็จ"));
    } else {
        echo json_encode(array("status" => "error", "message" => "เกิดข้อผิดพลาดในการอัปโหลดไฟล์"));
    }
} else {
    echo json_encode(array("status" => "error", "message" => "ไม่พบไฟล์ที่อัปโหลด"));
}

