<?php session_start();
  if(!isset($_SESSION['role'])){
    echo "<script>alert('ไม่พบเซสชั่น กรุณาเข้าสู่ระบบใหม่')</script>";
    header("Location: /sos/newweb/login.php");
  }else{
    if($_SESSION['role'] !== "organizer"){
      echo "<script>alert('คุณไม่ใช่ผู้จัดงาน กรุณาเข้าสู่ระบบใหม่ด้วยยูสเซอร์ของผู้จัดงาน')</script>";
      header("Location: /sos/newweb/api/logout.php");
    }
  }
 ?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title><?php echo $_SESSION['role'] ?></title>

    <style>

body { 
  font-family: 'Arial', sans-serif;
  line-height: 1.6;
  background-color: #F2FFFF;
}
header {
  background-color: #fff;
  color: rgb(88, 117, 188);
  text-align: center;
}
    </style>
  </head>
  <body onload="myevent_read();">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
    <a
      href="/sos/newweb/index.php"
      class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none"
    >
    <img src="/sos/newweb/uploads/asset/web/brandner.png" height="60px" alt="">
      <span class="fs-4 px-2">ผู้จัดงาน</span>
    </a>

    <ul class="nav nav-pills">
      <li class="nav-item">
        <a
          href="/sos/newweb/runner/index.php"
          class="nav-link active"
          aria-current="page"
          >หน้าแรก</a
        >
      </li>
      <li class="nav-item">
        <a href="/sos/newweb/organizer/user.php?id=<?php echo $_SESSION['id'] ?>" class="nav-link">บัญชีผู้ใช้</a>
      </li>
      <li class="nav-item">
        <a href="/sos/newweb/organizer/create/event.php" class="nav-link">กิจกรรมงานวิ่ง</a>
      </li>
      <li class="nav-item">
        <a href="/sos/newweb/api/logout.php" class="nav-link" >ลงชื่อออก</a>
      </li>
    </ul>
  </header>
  <div class="container text-center">
    <div class="row">
      <h2>กิจกรรมงานวิ่งของฉัน</h2>
    </div>
    <div class="row mb-3 d-flex justify-content-center align-items-center">
      <div class="col-md-4">
        <div class="btn-group">
          <div class="btn btn-info"><h3>ผู้จัดงาน</h3></div>
          <button class="btn btn-outline-dark" onclick="window.location.href='user.php'">
        <h5><?php echo $_SESSION['email'] ?></h5>
          </button>
        </div>
      </div>
        <table class="table mt-3">
            <thead  class="border border-2 border-dark">
                <tr>
                    <th scope="col">สถานะ</th>
                    <th scope="col">ประเภท</th>
                    <th scope="col">ชื่องาน</th>
                    <th scope="col">วันเวลา</th>
                    <th scope="col">สถานที่</th>
                    <th scope="col">ระยะทาง</th>
                    <th scope="col">ค่าสมัคร</th>
                    <th scope="col">จัดการ</th>
                </tr>
            </thead>
            <tbody id="my_event">
            </tbody>

        </table>
      </div>
  </div>
  <script>
  var myevent_read = function() {
    const requestOption = {
      method: "GET",
    };
    var myevent_table = document.getElementById("my_event");
    myevent_table.innerHTML = "Loading...";
    
    // เรียก API เพื่อรับข้อมูลเหตุการณ์
    fetch("http://localhost/sos/newweb/api/events/readbyowner.php?owner=<?php echo $_SESSION['email']; ?>", requestOption)
      .then((response) => response.json())
      .then((events) => {
        myevent_table.innerHTML = "";
        if(!events){
          myevent_table.innerHTML = "คุณยังไม่มีกิจกรรมที่จัด"
        }else{
        events.forEach((event) => {
          var row = `
            <tr>
              <td>${event.status}</td>
              <td>${event.type}</td>
              <td>${event.name}</td>
              <td>${event.datetime}</td>
              <td>${event.address} ${event.province}</td>
              <td>${event.distance}</td>
              <td>${event.cost}</td>
              <td>
                <div class="btn-group">
                <button class='btn-info btn-sm' onclick="window.location.href='eventinfo.php?id=${event.id}'" >ผู้เข้าร่วม</button>
                <button class='btn-warning btn-sm'onclick="window.location.href='eventinfo.php?id=${event.id}'" >แก้ไข</button>
                </div>
                </td>
            </tr>
          `;
          myevent_table.insertAdjacentHTML("beforeend", row);
        });}
      })
      .catch((error) => console.error(error));
  }
</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>