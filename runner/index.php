<?php
  session_start();
  if(!isset($_SESSION['role'])){
    header("Location: /sos/newweb/login.php");
  }else{
    if($_SESSION['role'] !== 'runner'){
      header("Location: /sos/newweb/login.php");
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
  <body onload="loadmy_event();">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
    <a
      href="/sos/newweb/index.php"
      class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none"
    >
    <img src="/sos/newweb/uploads/asset/web/brandner.png" height="60px" alt="">

      <span class="fs-4 px-2">นักวิ่ง</span>
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
        <a href="/sos/newweb/runner/user.php?id=<?php echo $_SESSION['id'] ?>" class="nav-link">บัญชีผู้ใช้</a>
      </li>
      <li class="nav-item">
        <a href="/sos/newweb/runner/event.php" class="nav-link">กิจกรรมงานวิ่ง</a>
      </li>
      <li class="nav-item">
        <a href="/sos/newweb/api/logout.php" class="nav-link" >ลงชื่อออก</a>
      </li>
    </ul>
  </header>

  <div class="container text-center">
    <div class="row">
      <h1>ยินดีต้อนรับคุณนักวิ่ง</h1>
    </div>
    <div class="row">
      <h4>นี้คือกิจกรรมที่คุณลงทะเบียน</h4>
    </div>
    <div class="row" id="mycard">
]
    </div>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
<script>
  var loadmy_event =function(){
    const requestOptions ={
      method: "GET",
      redirect: "follow",
    };
    var event_card =document.getElementById("mycard")
    event_card.innerHTML = "Loading..."
    fetch("http://localhost/sos/newweb/api/join/readbyuser.php?id=<?php echo $_SESSION['id']; ?>",requestOptions)
    .then((response) => response.text())
    .then((result) =>{
      event_card.innerHTML = "";
      var jsonObj =JSON.parse(result);
      for(let event of jsonObj){
        var col=`
        <div class="card mb-3" style="max-width: 420px;">
          <div class="row g-0">
            <div class="col-md-12">
              <img src="/sos/newweb/uploads/asset/`+event.owner+`/`+event.coverimg+`" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-12">
              <div class="card-body">
                <h5 class="card-title"><span class="border border-2 border-primary p-1 rounded mx-2">ชื่องาน</span>`+event.event_name+`</h5>
                <p class="card-text"><span class="border border-2 border-primary p-1 rounded mx-2">สถานที่</span> `+event.address+` `+event.province+`</p>
                <p class="card-text d-flex justify-content-between align-items-center">
                  <span class="border border-2 border-primary p-1 rounded mx-1">ระยะทาง</span>`+event.distance+`KM
                  <span class="border border-2 border-primary p-1 rounded mx-1">เลขนักวิ่ง</span>`+event.runNo+`
                </p>
                <p class="card-text"><span class="border border-2 border-primary p-1 rounded mx-2">วันเวลางาน</span><small class="text-body-secondary">`+event.event_datetime+`</small></p>
                <p class="card-text"><a href="viewevent.php?id=`+event.event_id+`" class="btn-success text-decoration-none text-light py-1 px-2 rounded mx-1">ดูรายละเอียด</a></p>
              </div>
            </div>
          </div>
        </div>
        
        `
        event_card.insertAdjacentHTML("beforeend", col)

      }
    })
    .catch((error)=> console.error(error));
  }
</script>
<!--  -->
