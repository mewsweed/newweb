<?php
    session_start();
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Content-Type");
    header("Content-Type: application/json; charset=utf-8");

    include('./server.php');

    $data = json_decode(file_get_contents("php://input"));
    if($_SERVER['REQUEST_METHOD'] !== "POST"){
        echo json_encode(array("status"=>"error"));
        die();
    }
    try{
        $stmt = $dbh->prepare("SELECT * FROM users WHERE email=?");
        $stmt->bindParam(1, $data->email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        // echo $user;
        if (!$user) {
            echo json_encode(array("status" => "error", "message" => "User not found"));
            die();
        }

        if (!password_verify($data->password, $user['password'])) {
            echo json_encode(array("status" => "error", "message" => "Incorrect password"));
            die();
        }

        $_SESSION['id'] = $user['id'];
        // ถ้าเรียบร้อยแล้วให้ส่งข้อมูลผู้ใช้กลับ
        unset($user['password']); // ไม่ส่งรหัสผ่านกลับ
        echo json_encode(array("status" => "ok", "user" => $user, "message" => "Login successful."));

        $dbh = null;
    }catch(PDOException $e){
        print "Error: " . $e->getMessage() ."<br/>";
        die();
    }
