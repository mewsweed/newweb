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
        $dbh->beginTransaction();

        $stmt_check_email = $dbh->prepare("SELECT COUNT(*) as count FROM users WHERE email = ?");
        $stmt_check_email->bindParam(1, $data->email);
        $stmt_check_email->execute();
        $result = $stmt_check_email->fetch(PDO::FETCH_ASSOC);
        
        if ($result['count'] > 0) {
            echo json_encode(array("status"=>"error", "message"=>"Email already exists"));
            die();
        } 

        if ($data->password !== $data->confirm_password) {
            echo json_encode(array("status"=>"error", "message"=>"Passwords do not match"));
            die();
        }

        $hashed_password = password_hash($data->password, PASSWORD_DEFAULT);


        $stmt = $dbh->prepare("INSERT INTO users (username, email, password, role) VALUE (?,?,?,?)");
        $stmt->bindParam(1, $data->username);
        $stmt->bindParam(2, $data->email);
        $stmt->bindParam(3, $hashed_password);
        $stmt->bindParam(4, $data->role);

        if(!$stmt->execute()){
            $dbh->rollBack(); // ยกเลิกการทำงานแบบแปรผัน
            echo json_encode(array("status"=>"error", "message"=>"Can't create user."));
            die();
        }
        $user_id = $dbh->lastInsertId();

        $stmt_info = $dbh->prepare("INSERT INTO info (user_id) VALUE (?)");
        $stmt_info->bindParam(1, $user_id);

        if($stmt_info->execute()){
            $dbh->commit(); // ยืนยันการทำงานแบบแปรผัน
            echo json_encode(array("status"=>"ok", "message"=>"User created successfully."));
        } else {
            $dbh->rollBack(); // ยกเลิกการทำงานแบบแปรผัน
            echo json_encode(array("status"=>"error", "message"=>"Can't create user."));
        }
        $dbh = null;
    
        }catch(PDOException $e){
            echo json_encode(array("status"=>"error", "message"=>"Error: " . $e->getMessage()));
            die();
        }

