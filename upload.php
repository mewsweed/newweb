<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=utf-8");


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // ตรวจสอบว่ามีไฟล์ถูกส่งมาหรือไม่
    if (isset($_FILES['coverimg']) && isset($_FILES['mapimg']) && isset($_FILES['rewardimg'])) {
        // กำหนดโฟลเดอร์ที่จะบันทึกไฟล์รูป
        $targetDir = "uploads/";
        
        // สร้างชื่อไฟล์ใหม่โดยใช้เวลาปัจจุบันเป็นส่วนหลังของชื่อไฟล์เพื่อป้องกันชื่อไฟล์ซ้ำ
        $coverimgName = uniqid() . "_" . basename($_FILES["coverimg"]["name"]);
        $mapimgName = uniqid() . "_" . basename($_FILES["mapimg"]["name"]);
        $rewardimgName = uniqid() . "_" . basename($_FILES["rewardimg"]["name"]);
        
        // กำหนด path ของไฟล์ที่จะบันทึกลงในโฟลเดอร์
        $coverimgPath = $targetDir . $coverimgName;
        $mapimgPath = $targetDir . $mapimgName;
        $rewardimgPath = $targetDir . $rewardimgName;
        
        // อัพโหลดไฟล์รูปลงในโฟลเดอร์
        if (move_uploaded_file($_FILES["coverimg"]["tmp_name"], $coverimgPath) &&
            move_uploaded_file($_FILES["mapimg"]["tmp_name"], $mapimgPath) &&
            move_uploaded_file($_FILES["rewardimg"]["tmp_name"], $rewardimgPath)) {
            // สร้าง array เพื่อเก็บ path ของไฟล์รูป
            $imagePaths = array(
                "coverimg" => $coverimgPath,
                "mapimg" => $mapimgPath,
                "rewardimg" => $rewardimgPath
            );
            
            // ส่ง path ของไฟล์รูปกลับมาให้ JavaScript ในรูปแบบ JSON
            $_SESSION['coverimg'] = $coverimgPath;
            $_SESSION['mapimg'] = $mapimgPath;
            $_SESSION['rewardimg'] = $rewardimgPath;
            echo json_encode($imagePaths);
        } else {
            // กรณีอัพโหลดไม่สำเร็จ
            echo json_encode(array("error" => "Failed to upload files."));
        }
    } else {
        // กรณีไม่มีไฟล์รูปถูกส่งมา
        echo json_encode(array("error" => "No files uploaded."));
    }
} else {
    // กรณีไม่ใช่เมธอด POST
    echo json_encode(array("error" => "Only POST requests are allowed."));
}

