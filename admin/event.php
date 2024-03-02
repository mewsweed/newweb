<?php session_start();
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

    <link href="https://fonts.googleapis.com/css2?family=Black+Ops+One&family=Pixelify+Sans&family=Poppins:ital,wght@0,400;1,300&family=Roboto:wght@100&family=Source+Code+Pro:wght@300;400;500;600;800&family=Young+Serif&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <title><?php echo $_SESSION['role'] ?></title>
  </head>

  <body onload="event_read(); request_read();">
  <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
    <a
      href="/sos/newweb/index.php"
      class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none"
    >
      <svg class="bi me-2" width="40" height="32">
        <use xlink:href="#bootstrap"></use>
      </svg>
      <span class="fs-4">แอดมิน</span>
    </a>

    <ul class="nav nav-pills">
      <li class="nav-item">
        <a
          href="/sos/newweb/index.php"
          class="nav-link "
          aria-current="page"
          >หน้าแรก</a
        >
      </li>
      <li class="nav-item ">
        <a href="/sos/newweb/admin/users.php" class="nav-link">บัญชีผู้ใช้</a>
      </li>
      <li class="nav-item">
        <a href="/sos/newweb/admin/event.php" class="nav-link active">กิจกรรมงานวิ่ง</a>
      </li>
      <li class="nav-item">
        <a href="/sos/newweb/api/logout.php" class="nav-link">ลงชื่อออก</a>
      </li>
    </ul>
  </header>

    <div class="container p-4">
      <div class="row text-center mb-3">
        <h2>Manage Events</h2>
        
      </div>
      <div class="row mb-3 text-center">
        <div class="col">
        <button
          type="button"
          class="btn btn-primary"
          onclick="window.open('create_event.php')"
        >
          Create Event
        </button>
        </div>
        <div class="col">
        <button
          type="button"
          class="btn btn-primary"
          onclick="window.open('create_request.php')"
        >
          Create Request Event
        </button>
        </div>
        

      </div>

      <div class="row mb-3">
        <table class="table">
            <h5>Request events</h5>
            <thead>
                <tr>
                    <th scope="col">ไอดี</th>
                    <th scope="col">รูปภาพ</th>
                    <th scope="col">ชื่องาน</th>
                    <th scope="col">สถานที่</th>
                    <th scope="col">วัน/เดือน/ปี และเวลา</th>
                    <th scope="col">ผู้จัดงาน</th>
                    <th scope="col">จัดการ</th>
                </tr>
            </thead>
            <tbody id="request_table">
            </tbody>

        </table>
      </div>
      <div class="row">
        <table class="table">
            <h5>Events</h5>
          <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Name</th>
              <th scope="col">Location</th>
              <th scope="col">Date-Time</th>
              <th scope="col">Owner</th>
              <th scope="col">manage</th>
              
            </tr>
          </thead>
          <tbody id="events_table"></tbody>
        </table>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>
<script>
    var request_read =function(){
        const requestOptions = {
            method: "GET",
            redirect: "follow",
        };
        var request_table =document.getElementById("request_table");
        request_table.innerHTML = "Loading...";
        fetch("http://localhost/sos/newweb/api/requests/read.php", requestOptions)
        .then((response) => response.text())
        .then((result) => {
            request_table.innerHTML = "";
            var jsonObj = JSON.parse(result);
            for (let request of jsonObj){
                var row = `
                    <tr>
                        <td scope="col">`+request.id+`</td>
                        <td scope="col"><img src="`+request.coverimg+`" alt="" height="50px"><img src="`+request.mapimg+`" alt="" height="50px"><img src="`+request.rewardimg+`" alt="" height="50px">
                        <td scope="col">`+request.name+`</td>
                        <td scope="col">`+request.address+`</td>
                        <td scope="col">`+request.datetime+`</td>
                        <td scope="col">`+request.owner+`</td>
                        <td scope="col">
                            <a href="edit_request.php?id=` +request.id +`" class="m-1">Edit</a>
                            <a href="#" onclick="request_accept(`+request.id+`)">Accept</a>
                            <a href="#" onclick="request_delete(`+request.id+`)">Del</a>
                        </td>
                    </tr>
                `;
                request_table.insertAdjacentHTML("beforeend",row);
            }
        })
        .catch((error) => console.error(error));
    };

  var event_read = function () {
    const requestOptions = {
      method: "GET",
      redirect: "follow",
    };
    var events_table = document.getElementById("events_table");
    events_table.innerHTML = "loading...";
    fetch("http://localhost/sos/newweb/api/events/read.php", requestOptions)
      .then((response) => response.text())
      .then((result) => {
        events_table.innerHTML = "";
        var jsonObj = JSON.parse(result);
        for (let event of jsonObj) {
          var row =
            `
                <tr>
                  <td scope="col">` + event.id +`</td>
                  <td scope="col">` + event.name +`</td>
                  <td scope="col">` + event.address +`</td>
                  <td scope="col">` + event.datetime+`</td>
                  <td scope="col">` + event.owner+`</td>
                  <td scope="col">
                    <a href="edit_event.php?id=` +event.id +`" class="m-1">Edit</a>
                    <a href="#" onclick="event_delete(`+event.id+`)" class="m-1">Del</a>
                  </td>
                </tr>
            `;
          events_table.insertAdjacentHTML("beforeend", row);
        }
      })
      .catch((error) => console.error(error));
    };

  var events_delete =function(id){
    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");

    const raw = JSON.stringify({
      "id": id
    });

    const requestOptions = {
      method: "DELETE",
      headers: myHeaders,
      body: raw,
      redirect: "follow"
    };

    fetch("http://localhost/sos/newweb/api/events/delete.php", requestOptions)
      .then((response) => response.text())
      .then((result) => {
        var jsonObj =JSON.parse(result);
        if (jsonObj.status == "ok"){
          alert("ok");
          window.location.href = "/sos/newweb/admin/event.php"
        }
      })
      .catch((error) => console.error(error));
      }
</script>
