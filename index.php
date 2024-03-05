<?php 
    include('api/server.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body{
            
  background-color: #F2FFFF;
        }
    </style>
</head>
<body>
    <div class="container p-4 text-center">
        <img src="/sos/newweb/uploads/asset/web/icon.png" height="250px" alt="">
        <div class="row text-center mb-3 mt-3">
            <h1>ยินดีตอนรับสู่</h1>
            <h2>ระบบจัดการกิจกรรมงานวิ่ง</h2>
            <h3>มหาวิทยาลัยเทคโนโลยีราชมงคลธัญบุรี</h3>
        </div>
        <div class="row text-center py-4">
            <div class="col">
                <a href="runnerregister.php" class="btn btn-outline-primary p-3">สมัครสมาชิก(นักวิ่ง)</a>
            </div>
            <div class="col">
                <a href="login.php" class="btn btn-outline-primary p-3">เข้าสู่ระบบ</a>
            </div>
            <div class="col">
                <a href="organizerregister.php" class="btn btn-outline-primary p-3">สมัครสมาชิก(ผู้จัดงาน)</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>