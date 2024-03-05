<?php 
  session_start();
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Black+Ops+One&family=Pixelify+Sans&family=Poppins:ital,wght@0,400;1,300&family=Roboto:wght@100&family=Source+Code+Pro:wght@300;400;500;600;800&family=Young+Serif&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body onload=""><!-- checksession()  -->
<header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
<a
      href="/sos/newweb/index.php"
      class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none"
    >
      <!-- <svg class="bi me-2" width="40" height="32">
        <use xlink:href="#bootstrap"></use>
      </svg> -->
      <img src="/sos/newweb/uploads/asset/web/brandner.png" height="60px" alt="">
      <span class="fs-4 px-2">แอดมิน</span>
    </a>

    <ul class="nav nav-pills">
      <li class="nav-item">
        <a
          href="/sos/newweb/admin/index.php"
          class="nav-link active"
          aria-current="page"
          >หน้าแรก</a
        >
      </li>
      <li class="nav-item">
        <a href="/sos/newweb/admin/users.php" class="nav-link">บัญชีผู้ใช้</a>
      </li>
      <li class="nav-item">
        <a href="/sos/newweb/admin/event.php" class="nav-link">กิจกรรมงานวิ่ง</a>
      </li>
      <li class="nav-item">
        <a href="/sos/newweb/api/logout.php" class="nav-link">ลงชื่อออก</a>
      </li>
    </ul>
  </header>
    <div class="container">
      
    </div>

    <!-- <script>// ดึงข้อมูลผู้ใช้ที่เก็บไว้ใน session
var user = JSON.parse(sessionStorage.getItem('user'));
document.getElementById('showId').innerHTML = user['id'];

console.log(user['id']); // แสดงข้อมูลผู้ใช้ใน console</script> -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>