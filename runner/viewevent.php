<?php 
  session_start();
  if(!isset($_SESSION['role'])){
    header("Location: /sos/newweb/login.php");
  }else{
    if($_SESSION['role'] !== 'runner'){
      header("Location: /sos/newweb/login.php");
    }
  }

  if(isset($_GET['id'])){
    $event_id = $_GET['id'];
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <title>ADMIN Edit</title>
  </head>
  <body onload="event_readone()">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-2 border-bottom">
        <a
        href="/sos/newweb/index.php"
        class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none"
        >
        <svg class="bi me-2" width="40" height="32">
            <use xlink:href="#bootstrap"></use>
        </svg>
        <span class="fs-4">นักวิ่ง</span>
        </a>

        <ul class="nav nav-pills">
        <li class="nav-item">
            <a
            href="/sos/newweb/runner/index.php"
            class="nav-link"
            aria-current="page"
            >หน้าแรก</a
            >
        </li>
        <li class="nav-item">
            <a href="/sos/newweb/runner/user.php?id=<?php echo $_SESSION['id'] ?>" class="nav-link active">บัญชีผู้ใช้</a>
        </li>
        <li class="nav-item">
            <a href="/sos/newweb/runner/event.php" class="nav-link">กิจกรรมงานวิ่ง</a>
        </li>
        <li class="nav-item">
            <a href="/sos/newweb/api/logout.php" class="nav-link" >ลงชื่อออก</a>
        </li>
        </ul>
    </header>
    <div class="container p-4">
      <div class="row text-center p-4">
        <div class="col border p-4 ">
          ชื่องาน
          <div class="row">
          <h3 id="name"></h3>
          </div>
        </div>
        <div class="col border p-4">
          วันเวลาที่จัดงาน
          <h4 id="datetime"></h4>
          <h5 id="owner">ผู้จัดงาน : </h5>
        </div>
      </div>
      <div class="row p-4">
        <img src="/sos/newweb/uploads/asset/desktop-1920x1080.jpg" alt=""  class="img-fluid" id="coverimg">
      </div>
      <div class="row text-center p-4">
        <div class="col-lg-6  pt-4 px-4 border">
          <p>วัตถุประสงค์</p>
          <h5 id="about"></h5>
        </div>
        <div class="col-sm border pt-4">
          <p>ประเภท</p>
          <h5 id="type"></h5>
        </div>
        <div class="col-sm border pt-4">
          <p>ระยะทาง(กิโลเมตร)</p>
          <h5 id="distance"></h5>
        </div>
        <div class="col-sm border pt-4">
          <p>ค่าสมัคร(บาท)</p>
          <h5 id="cost"></h5>
        </div>
      </div>
      <div class="row p-4">
        <div class="col-md">
        <img src="/sos/newweb/uploads/asset/desktop-1920x1080.jpg" alt="" class="img-thumbnail" id="mapimg">
          
        </div>
        <div class="col text-center border">
          <div class="row p-4">
            <div class="col">
              <h4>สถานที่จัดงาน</h4>
            </div>
          </div>
          <div class="row px-2 py-2">
            <div class="col border">
            <p>สถานที่</p>
            <h5 id="address"></h5>
            </div>
            <div class="col border">
              <p>จังหวัด</p>
              <h5 id="province"></h5>
            </div>
          </div>
          <div class="row px-2 py-2">
            <div class="col border">
              <p>เขต</p>
              <h5 id="dist"></h5>
            </div>
            <div class="col border">
              <p>แขวง</p>
              <h5 id="subdist"></h5>
            </div>
            <div class="col border ">
              <p>ไปรษณีย์</p>
              <h5 id="zip"></h5>
            </div>
          </div>
        </div>
      </div>
      <div class="row p-4">
      <div class="col-md">
        <img src="/sos/newweb/uploads/asset/desktop-1920x1080.jpg" alt="" class="img-thumbnail" id="rewardimg">
          
        </div>
        <div class="col">
        <!-- <button class="btn btn-primary" onclick="window.location.href='register.php?user_id=<?php echo $_SESSION['id']; ?>&event_id=' + encodeURIComponent('<?php echo $event_id; ?>')">เข้าร่วม</button> -->

        <button class="btn btn-primary" onclick="window.location.href='register.php?user_id=<?php echo $_SESSION['id']?>&event_id=<?php echo $event_id; ?>'">เข้าร่วม</button>
        </div>
      </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>
      // var user =JSON.parse(sessionStorage.getItem('user'));
      // console.log(user)
      // if (user['role'] !== 'admin'){
      //   window.location.href = "index.php"
      // }
      var event_readone = function () {
        const params = new URLSearchParams(window.location.search);
        const id = params.get("id");
        const requestOptions = {
          method: "GET",
          redirect: "follow",
        };

        fetch(
          "http://localhost/sos/newweb/api/events/readone.php?id=" + id,
          requestOptions
        )
          .then((response) => response.text())
          .then((result) => {
            var jsonObj = JSON.parse(result);
            
            document.getElementById('name').innerHTML =jsonObj.name;
            document.getElementById('datetime').innerHTML =jsonObj.datetime;
            document.getElementById('about').innerHTML =jsonObj.about;
            document.getElementById('owner').innerHTML +=jsonObj.owner;
            document.getElementById('address').innerHTML =jsonObj.address;
            document.getElementById('province').innerHTML =jsonObj.province;
            document.getElementById('dist').innerHTML =jsonObj.dist;
            document.getElementById('subdist').innerHTML =jsonObj.subdist;
            document.getElementById('zip').innerHTML =jsonObj.zip;
            document.getElementById('distance').innerHTML =jsonObj.distance;
            document.getElementById('cost').innerHTML =jsonObj.cost;
            document.getElementById('type').innerHTML =jsonObj.type;
            document.getElementById('coverimg').src = "/sos/newweb/uploads/asset/"+jsonObj.coverimg;
            document.getElementById('mapimg').src = "/sos/newweb/uploads/asset/"+jsonObj.mapimg;
            document.getElementById('rewardimg').src = "/sos/newweb/uploads/asset/"+jsonObj.rewardimg;
            // document.getElementById("id").value = jsonObj.id;
            // document.getElementById("email").value = jsonObj.email;
            // document.getElementById("username").value = jsonObj.username;
            // document.getElementById("role").value = jsonObj.role;

          })
          .catch((error) => console.error(error));
      };

      var user_update = function () {
        const myHeaders = new Headers();
        myHeaders.append("Content-Type", "application/json");

        const raw = JSON.stringify({
          id: document.getElementById("id").value,
          email: document.getElementById("email").value,
          username: document.getElementById("username").value,
          role: document.getElementById("role").value,
        });

        const requestOptions = {
          method: "PATCH",
          headers: myHeaders,
          body: raw,
          redirect: "follow",
        };

        fetch(
          "http://localhost/sos/newweb/api/users/update.php",
          requestOptions
        )
          .then((response) => response.text())
          .then((result) => {
            var jsonObj = JSON.parse(result);
            if (jsonObj.status == "ok") {
              alert(jsonObj.message);
              window.open("users.php");
            } else {
              alert(jsonObj.message);
            }
          })
          .catch((error) => console.error(error));
      };
    </script>
    <script>


    </script>
  </body>
</html>
