<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=utf-8");

include('../server.php');

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
        exit(); // หยุดการทำงานทันทีหากเกิดข้อผิดพลาด
    }
    
    // ตรวจสอบว่าโฟลเดอร์สำหรับผู้ใช้นี้มีอยู่หรือไม่
    $user_folder = "../../uploads/runner/" . $_SESSION['email'];
    if (!file_exists($user_folder)) {
        // ถ้าโฟลเดอร์ยังไม่มีอยู่ให้สร้างขึ้นใหม่
        mkdir($user_folder, 0777, true);
    }
    
    // สร้างที่อยู่ของไฟล์
    $uniqfile_name = uniqid()."_".basename($file_name);
    $file_path = $user_folder . "/" . $uniqfile_name;

    // เคลื่อนย้ายไฟล์ไปยังโฟลเดอร์ที่กำหนด
    if(move_uploaded_file($file_tmp, $file_path)){
        // เพิ่มข้อมูลลงในฐานข้อมูล
        $stmt = $dbh->prepare("INSERT INTO face (user_id, face) VALUES (?, ?)");
        $stmt->bindParam(1, $id);
        $stmt->bindParam(2, $uniqfile_name);

        if($stmt->execute()){
            echo "<script>alert('Face Insert to $id successfully.')</script>";
            header("Location: /sos/newweb/runner/user.php?id=".$id);
            exit(); // หยุดการทำงานทันทีหลังจากเปลี่ยนเส้นทาง
        }else{
            echo json_encode(array("status"=>"error","message"=>"Can't upload Face."));
            exit(); // หยุดการทำงานทันทีหากเกิดข้อผิดพลาด
        }
    } else {
        echo json_encode(array("status" => "error", "message" => "เกิดข้อผิดพลาดในการอัปโหลดไฟล์"));
        exit(); // หยุดการทำงานทันทีหากเกิดข้อผิดพลาด
    }
} else {
    echo json_encode(array("status" => "error", "message" => "ไม่พบไฟล์ที่อัปโหลด"));
    header("Location: /sos/newweb/runner/user.php?id=$id");
    exit(); // หยุดการทำงานทันทีหลังจากส่งข้อความ
}
