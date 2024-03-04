<?php
  session_start();
  if(!isset($_SESSION['role'])){
    header("Location: /sos/newweb/login.php");
  }else{
    if($_SESSION['role'] !== 'organizer'){
      header("Location: /sos/newweb/login.php");
      exit;
    }
  }

  if (!isset($_SESSION['email'])) {
    // กระทำการจัดการเมื่อไม่มีอีเมลใน session
    exit; // หรืออื่นๆ ตามการจัดการที่คุณต้องการ
}

// $email = $_SESSION['email'];

// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Headers: Content-Type");
// header("Content-Type: application/json; charset=utf-8");
// include('../api/server.php');

// try {
//     $stmt = $dbh->prepare("SELECT * FROM events WHERE owner = ?");
//     $stmt->execute([$email]);

//     $events = array();

//     foreach ($stmt as $row) {
//         $event = array(
//             'id' => $row['id'],
//             'name' => $row['name'],
//             'about' => $row['about'],
//             'datetime' => $row['datetime'],
//             'type' => $row['type'],
//             'distance' => $row['distance'],
//             'cost' => $row['cost'],
//             'owner' => $row['owner'],
//             'address' => $row['address'],
//             'province' => $row['province'],
//             'dist' => $row['dist'],
//             'subdist' => $row['subdist'],
//             'zip' => $row['zip'],
//             'coverimg' => $row['coverimg'],
//             'mapimg' => $row['mapimg'],
//             'rewardimg' => $row['rewardimg'],
//             'paymentimg' => $row['paymentimg'],
//         );
//         $events[] = $event;
//     }

//     echo json_encode($events);

//     $dbh = null;
// } catch (PDOException $e) {
//     print "Error: " . $e->getMessage() . "<br/>";
//     die();
// }
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
  </head>
  <body onload="myevent_read();">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
    <a
      href="/sos/newweb/index.php"
      class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none"
    >
      <svg class="bi me-2" width="40" height="32">
        <use xlink:href="#bootstrap"></use>
      </svg>
      <span class="fs-4">ผู้จัดงาน</span>
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
        <a href="/sos/newweb/organizer/event.php" class="nav-link">กิจกรรมงานวิ่ง</a>
      </li>
      <li class="nav-item">
        <a href="/sos/newweb/api/logout.php" class="nav-link" >ลงชื่อออก</a>
      </li>
    </ul>
  </header>
  <div class="container text-center">
    <div class="row">
      <h3>อีเว้นต์ของฉัน</h3>
    </div>
    <div class="row mb-3">
        <table class="table">
            <h5><?php echo $_SESSION['email'] ?></h5>
            <thead>
                <tr>
                    <th scope="col">ไอดี</th>
                    <th scope="col">สถานะ</th>
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
        events.forEach((event) => {
          var row = `
            <tr>
              <td>${event.id}</td>
              <td>${event.status}</td>
              <td>${event.name}</td>
              <td>${event.datetime}</td>
              <td>${event.address} ${event.province}</td>
              <td>${event.distance}</td>
              <td>${event.cost}</td>
              <td><button class=btn-success onclick="window.location.href=''" >ผู้เข้าร่วม</button></td>
            </tr>
          `;
          myevent_table.insertAdjacentHTML("beforeend", row);
        });
      })
      .catch((error) => console.error(error));
  }
</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>