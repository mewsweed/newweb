<?php
// session_start();
// header("Access-Control-Allow-Origin: * ");
// header("Access-Control-Allow-Headers: Content-Type");
// header("Access-Control-Allow-Methods: DELETE");
// header("Content-Type: application/json; charset=utf-8");
// include('../server.php');

// $data = json_decode(file_get_contents("php://input"));

// if ($_SERVER['REQUEST_METHOD'] !== "DELETE") {
//     http_response_code(405); // Method Not Allowed
//     echo json_encode(array("status" => "error", "message" => "Method not allowed."));
//     exit();
// }

// // Ensure the request includes the ID of the face to be deleted
// if (!isset($data->id)) {
//     http_response_code(400); // Bad Request
//     echo json_encode(array("status" => "error", "message" => "Missing face ID."));
//     exit();
// }

// try {
//     // ดึงข้อมูลรูปภาพทั้งหมดของผู้ใช้
//     $stmt = $dbh->prepare("SELECT face FROM face WHERE user_id = ?");
//     $stmt->bindParam(1, $user_id);
//     $stmt->execute();
//     $faces = $stmt->fetchAll(PDO::FETCH_ASSOC);

//     // ลบทุกรูปภาพ
//     foreach ($faces as $face) {
//         $facePath = "../../uploads/runner/" . $_SESSION['email'] . "/" . $face['face'];
//         if (file_exists($facePath)) {
//             unlink($facePath); // Delete the face image file
//         }
//     }

//     // ลบข้อมูลรูปภาพในฐานข้อมูลทั้งหมดที่มี user_id ที่ตรงกับเงื่อนไข
//     $stmt_del = $dbh->prepare("DELETE FROM face WHERE user_id = ?");
//     $stmt_del->bindParam(1, $user_id);

//     if ($stmt_del->execute()) {
//         echo json_encode(array("status" => "ok"));
//     } else {
//         echo json_encode(array("status" => "error"));
//     }
// } catch (PDOException $e) {
//     http_response_code(500); // Internal Server Error
//     echo json_encode(array("status" => "error", "message" => "Database error: " . $e->getMessage()));
// }


session_start();
header("Access-Control-Allow-Origin: * ");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: DELETE, OPTION");
header("Content-Type: application/json; charset=utf-8");
include('../server.php');

if ($_SERVER['REQUEST_METHOD'] !== "DELETE") {
    http_response_code(405); // Method Not Allowed
    echo json_encode(array("status" => "error", "message" => "Method not allowed."));
    exit();
}

// Ensure the request includes the ID of the face to be deleted
if (!isset($_GET['id'])) {
    http_response_code(400); // Bad Request
    echo json_encode(array("status" => "error", "message" => "Missing user ID."));
    exit();
}

$user_id = $_GET['id']; // Get the ID from the URL parameter
$email = $_GET['email']; // Get the ID from the URL parameter

try {
    // ดึงข้อมูลรูปภาพทั้งหมดของผู้ใช้
    $stmt = $dbh->prepare("SELECT * FROM face WHERE user_id = ?");
    $stmt->bindParam(1, $user_id);
    $stmt->execute();
    $faces = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // ลบทุกรูปภาพ
    foreach ($faces as $face) {
        $facePath = "../../uploads/runner/" . $email . "/" . $face['face'];
        if (file_exists($facePath)) {
            unlink($facePath); // Delete the face image file
        }
    }

    // ลบข้อมูลรูปภาพในฐานข้อมูลทั้งหมด
    $stmt_del = $dbh->prepare("DELETE FROM face WHERE user_id = ?");
    $stmt_del->bindParam(1, $user_id);

    if ($stmt_del->execute()) {
        echo json_encode(array("status" => "ok"));
    } else {
        echo json_encode(array("status" => "error"));
    }
} catch (PDOException $e) {
    http_response_code(500); // Internal Server Error
    echo json_encode(array("status" => "error", "message" => "Database error: " . $e->getMessage()));
}
