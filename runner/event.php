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
  <body onload="loadevent_card(); loadendevent_card()">
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
          class="nav-link"
          aria-current="page"
          >หน้าแรก</a
        >
      </li>
      <li class="nav-item">
        <a href="/sos/newweb/runner/user.php?id=<?php echo $_SESSION['id'] ?>" class="nav-link">บัญชีผู้ใช้</a>
      </li>
      <li class="nav-item">
        <a href="/sos/newweb/runner/event.php" class="nav-link active">กิจกรรมงานวิ่ง</a>
      </li>
      <li class="nav-item">
        <a href="/sos/newweb/api/logout.php" class="nav-link" >ลงชื่อออก</a>
      </li>
    </ul>
  </header>
  <main>

<section class="py-5 text-center container">
  <div class="row py-lg-5">
    <div class="col-lg-6 col-md-8 mx-auto">
      <h1 class="fw-light">งานวิ่ง</h1>
      <p class="lead text-muted">กิจกรรมงานวิ่งที่จัดกับเว็บเรา</p>
      <p>
        <a href="#" class="btn btn-primary my-2">Main call to action</a>
        <a href="#" class="btn btn-secondary my-2">Secondary action</a>
      </p>
    </div>
  </div>
</section>

<div class="album py-5 bg-light">
  <h3 class="mx-4">งานที่ได้รับการอนุมัติ</h3>
  <div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-3" id="event_list">
    </div>
  </div>
</div>
<div class="album py-5 bg-light">
  <h3 class="mx-4">งานที่จบไปแล้ว</h3>
  <div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-3" id="eventend_list">
    </div>
  </div>
</div>

</main>
    <script>
      var loadevent_card =function(){
        const requestOptions = {
          method: "GET",
          redirect: "follow",
        };
      var eventcard = document.getElementById('event_list');
      eventcard.innerHTML = "loading...";
      fetch("http://localhost/sos/newweb/api/events/readbystatus.php", requestOptions)
      .then((response) => response.text())
      .then((result)=>{
        eventcard.innerHTML ="";
        var jsonObj =JSON.parse(result);
        for(let event of jsonObj){
          var col =`
            <div class="col">
              <div class="card">
                <img src="/sos/newweb/uploads/asset/`+event.owner+`/`+event.coverimg+`" width="100%" alt="">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-start">
                    <p class="card-text"><span class="border border-2 p-1 mx-1">ชื่องาน:</span>`+event.name+`</p>
                    <p class="card-text border p-1 border-2">ประเภท:`+event.type+`</p>
                  </div>
                  
                  <p class="card-text"><span class="border border-2 p-1 mx-1">วัตถุประสงค์:</span>`+event.about+`</p>
                  <p class="card-text"><span class="border border-2 p-1 mx-1">สถานที่:</span>`+event.address+` `+event.province+`</p>
                  <div class="d-flex justify-content-between align-items-start">
                    <p class="card-text"><span class="border border-2 p-1 mx-1">ระยะทาง:</span>`+event.distance+`</p>
                    <p class="card-text"><span class="border border-2 p-1 mx-1">ราคา:</span>`+event.cost+`</p>
                  </div>
                  <div class="d-flex justify-content-between align-items-start">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary" 
                      onclick="window.location.href='viewevent.php?id=`+event.id+`'">รายละเอียด</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary"
                      onclick="window.location.href='register.php?user_id=<?php echo $_SESSION['id']?>&event_id=`+event.id+`'">Join</button>
                    </div>
                    <small class="text-muted">`+event.datetime+`</small>
                  </div>
                  <div div class="d-flex justify-content-between align-items-center mt-1">
                    <small class="text-muted">ผู้เข้าร่วม :  </small>
                    <small class="text-muted btn-sm btn-outline-warning border border-warning">`+event.status+`</small>
                  </div>
                </div>
              </div>
            </div>
            `
          eventcard.insertAdjacentHTML("beforeend", col);
        }
      })
      .catch((error)=> console.error(error));
      }
    </script>

<script>
      var loadendevent_card =function(){
        const requestOptions = {
          method: "GET",
          redirect: "follow",
        };
      var eventcard = document.getElementById('eventend_list');
      eventcard.innerHTML = "loading...";
      fetch("http://localhost/sos/newweb/api/events/readbyend.php", requestOptions)
      .then((response) => response.text())
      .then((result)=>{
        eventcard.innerHTML ="";
        var jsonObj =JSON.parse(result);
        for(let event of jsonObj){
          var col =`
            <div class="col">
              <div class="card">
                <img src="/sos/newweb/uploads/asset/`+event.owner+`/`+event.coverimg+`" width="100%" alt="">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-start">
                    <p class="card-text"><span class="border border-2 p-1 mx-1">ชื่องาน:</span>`+event.name+`</p>
                    <p class="card-text border p-1 border-2">ประเภท:`+event.type+`</p>
                  </div>
                  
                  <p class="card-text"><span class="border border-2 p-1 mx-1">วัตถุประสงค์:</span>`+event.about+`</p>
                  <p class="card-text"><span class="border border-2 p-1 mx-1">สถานที่:</span>`+event.address+` `+event.province+`</p>
                  <div class="d-flex justify-content-between align-items-start">
                    <p class="card-text"><span class="border border-2 p-1 mx-1">ระยะทาง:</span>`+event.distance+`</p>
                    <p class="card-text"><span class="border border-2 p-1 mx-1">ราคา:</span>`+event.cost+`</p>
                  </div>
                  <div class="d-flex justify-content-between align-items-start">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary" 
                      onclick="window.location.href='viewevent.php?id=`+event.id+`'">รายละเอียด</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary"
                      onclick="window.location.href='register.php?user_id=<?php echo $_SESSION['id']?>&event_id=`+event.id+`'">Join</button>
                    </div>
                    <small class="text-muted">`+event.datetime+`</small>
                  </div>
                  <div div class="d-flex justify-content-between align-items-center mt-1">
                    <small class="text-muted">ผู้เข้าร่วม :  </small>
                    <small class="text-muted btn-sm btn-outline-warning border border-warning">`+event.status+`</small>
                  </div>
                </div>
              </div>
            </div>
            `
          eventcard.insertAdjacentHTML("beforeend", col);
        }
      })
      .catch((error)=> console.error(error));
      }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>