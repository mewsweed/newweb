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
  </head>
  <body onload="loadevent_card()">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
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
      <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
      <p>
        <a href="#" class="btn btn-primary my-2">Main call to action</a>
        <a href="#" class="btn btn-secondary my-2">Secondary action</a>
      </p>
    </div>
  </div>
</section>

<div class="album py-5 bg-light">
  <div class="container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-3" id="event_list">

            <!-- <div class="col">
        <div class="card">
          <img src="/sos/newweb/uploads/runner/65e33412229f7_pre-avatar.png" width="100%" alt="">
          <div class="card-body">
          <div class="d-flex justify-content-between align-items-start">
            <p class="card-text">Event-name:</p>
            <p class="card-text">Type:</p>
            </div>
            <p class="card-text">About:</p>
            <p class="card-text">Location:</p>
            <div class="d-flex justify-content-between align-items-start">
              <p class="card-text">Distance:</p>
              <p class="card-text">Cost:</p>
            </div>
            <div class="d-flex justify-content-between align-items-start">
              <div class="btn-group">
                <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
              </div>
               <small class="text-muted">Date:Time</small>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-1">
               <small class="text-muted">ผู้เข้าร่วม : </small>
               <small class="text-muted btn-sm btn-outline-warning border border-warning">สถานะ</small>
            </div>
          </div>
        </div>
      </div> -->
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
      fetch("http://localhost/sos/newweb/api/events/read.php", requestOptions)
      .then((response) => response.text())
      .then((result)=>{
        eventcard.innerHTML ="";
        var jsonObj =JSON.parse(result);
        for(let event of jsonObj){
          var col =`
            <div class="col">
              <div class="card">
                <img src="/sos/newweb/uploads/asset/`+event.coverimg+`" width="100%" alt="">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-start">
                    <p class="card-text">Event-name:`+event.name+`</p>
                    <p class="card-text">Type:`+event.type+`</p>
                  </div>
                  
                  <p class="card-text">About:`+event.about+`</p>
                  <p class="card-text">Location:`+event.address+` `+event.province+`</p>
                  <div class="d-flex justify-content-between align-items-start">
                    <p class="card-text">Distance:`+event.distance+`</p>
                    <p class="card-text">Cost:`+event.cost+`</p>
                  </div>
                  <div class="d-flex justify-content-between align-items-start">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary" 
                      onclick="window.location.href='viewevent.php?id=`+event.id+`'">View</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Join</button>
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