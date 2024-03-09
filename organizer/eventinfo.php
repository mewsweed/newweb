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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Event Info</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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

td img {
  transition: transform 0.3s ease; /* ให้มี animation เมื่อขยายรูป */
}

td img:hover {
  transform: scale(5); /* ขยายขนาดรูปภาพเมื่อชี้ */
}
    </style>

  </head>
  <body onload="joinevent_read(); event_read();">
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
          class="nav-link"
          aria-current="page"
          >หน้าแรก</a
        >
      </li>
      <li class="nav-item">
        <a href="/sos/newweb/organizer/user.php?id=<?php echo $_SESSION['id'] ?>" class="nav-link">บัญชีผู้ใช้</a>
      </li>
      <li class="nav-item">
        <a href="/sos/newweb/organizer/create/event.php" class="nav-link active">กิจกรรมงานวิ่ง</a>
      </li>
      <li class="nav-item">
        <a href="/sos/newweb/api/logout.php" class="nav-link" >ลงชื่อออก</a>
      </li>
    </ul>
  </header>
    <div class="row text-center">
        <h2>ผู้เข้าร่วมกิจกรรม</h2>
    </div>
    <div class="container p-4">
        <div class="row">
          <div class="text-center">
            <img src="/sos/newweb/uploads/asset/<?php echo $_SESSION['email'];?>/" alt="" class="img-thumbnail" width="500px" id="coverimg">
            </div>
        </div>
        <div class="border p-2 m-2 row text-center">
          <div class="row">
            <div class="col-sm-4 ">
                ชื่องาน
                <h4 id="name"></h4>
            </div>

          </div>
          <div class="row">
            <div class="col-sm-4">
                วันเวลา
                <h4 id="datetime"></h4>
            </div>
            <div class="col-sm-4">
                ประเภท
                <h4 id="type"></h4>
            </div>
          </div>
        </div>
        
        <div class="row">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">หมายเลข<br>นักวิ่ง</th>
              <th scope="col">ชื่อจริง<br>นามสกุล</th>
              <th scope="col">เพศ</th>
              <th scope="col">เบอร์ติดต่อ</th>
              <th scope="col">เบอร์ติดต่อฉุกเฉิน</th>
              <th scope="col">การชำระเงิน</th>
              <th scope="col">ราคา</th>
              <th scope="col">การจัดส่ง</th>
            </tr>
          </thead>
          <tbody id="joiner_table">
            
          </tbody>
        </table>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>

<script>
  var joinevent_read =function(){
    const params = new URLSearchParams(window.location.search);
    const id = params.get("id");
    const requestOptions = {
      method: "GET",
      redirect: "follow",
    };

    var joiner_table =document.getElementById("joiner_table");
    joiner_table.innerHTML = "Loading...";
    fetch("http://localhost/sos/newweb/api/join/readbyevent.php?id="+id, requestOptions)
    .then((response) => response.text())
    .then((result) => {
      joiner_table.innerHTML ="";
      var jsonObj =JSON.parse(result);
      for( let joiner of jsonObj) {
        var row=`
          <tr>
            <td scope="col">`+joiner.runNo+`</td>
            <td scope="col">`+joiner.fname+`<br>`+joiner.lname+`</td>
            <td scope="col">`+joiner.gender+`</td>
            <td scope="col">`+joiner.phone+`</td>
            <td scope="col">`+joiner.emerphone+`</td>
            <td scope="col">
            <img src="data:image;base64,`+joiner.paid+`" alt="paid" height="50px">
            </td>
            <td scope="col">`+joiner.cost+`</td>
            <td scope="col">`+joiner.ship+`</td>
          </tr>
        `;
        joiner_table.insertAdjacentHTML("beforeend",row);
      }
    })
    .catch((error) => {console.error(error); users_table.innerHTML = "ไม่พบข้อมูลยูสเซอร์"});
  }
</script>
<script>
  var event_read =function(){
    const params = new URLSearchParams(window.location.search);
    const id = params.get("id");
    const requestOptions = {
      method: "GET",
      redirect: "follow",
    };
    fetch("http://localhost/sos/newweb/api/events/readone.php?id="+id,requestOptions)
    .then((response)=>response.text())
    .then((result) =>{
      const eventData =JSON.parse(result);
      document.getElementById("coverimg").src += eventData.coverimg; 
      document.getElementById("name").innerText = eventData.name; 
      document.getElementById("datetime").innerText = eventData.datetime; 
      document.getElementById("type").innerText = eventData.type; 
    })
  }
</script>