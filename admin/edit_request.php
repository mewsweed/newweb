<?php 
  session_start();

  // if(isset($_SESSION['role'])){
  //   if($_SESSION['role'] !== 'admin'){
  //     header("Location: /sos/newweb/login.php");
  //   }
  // }

  if(isset($_FILES['coverimg'])){
    $file = $_FILES['coverimg'];

    if($file['error'] === UPLOAD_ERR_OK){

      $uploadDir = 'uploads/';
      $uploadFile = $uploadDir . basename($file['name']);

      if(move_uploaded_file($file['tmp_name'], $uploadFile)) {
        $imageUrl = 'http://localhost/sos/newweb/'. $uploadFile;
        echo json_encode(["status"=>"success"]);
      }else{
        echo json_encode(["status"=>"error"]);
      }

    }else{
      echo json_encode(["status"=>"error"]);
    }
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


    <title></title>
  </head>
  <body onload="request_readone()">
    <div class="container p-4">
      <div class="row text-center mt-3 mb-3">
        <h1>แก้ไขคำร้องขอจัดงาน</h1>
      </div>
      <form onsubmit="return false">
        <div class="row">
          <div class="col">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="id" placeholder="0" disabled>
              <label for="floatingInput">ไอดีคำร้องขอจัดงาน</label>
            </div>
          </div>
          <div class="col">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="owner" placeholder="owner" disabled >
              <label for="floatingPassword">ผู้จัดงาน</label>
            </div>  
          </div>
        </div>

        <div class="row">
          <div class="col">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="name" placeholder="event name">
              <label for="floatingPassword">ชื่องาน</label>
            </div>  
          </div>
          <div class="col-4">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="type" placeholder="event name">
              <label for="floatingPassword">ประเภท</label>
            </div>  
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="about" placeholder="about this running event.">
              <label for="floatingPassword">รายละเอียด</label>
            </div>  
          </div>
          <div class="col-md">
            <div div class="form-floating mb-3">
              <input type="number" class="form-control" id="distance" placeholder="KM">
              <label for="floatingPassword">ระยะทาง(กิโลเมตร)</label>
            </div>  
          </div>
          <div class="col-md">
            <div div class="form-floating mb-3">
              <input type="number" class="form-control" id="cost" placeholder="บาท">
              <label for="floatingPassword">ค่าสมัคร(บาท)</label>
            </div>  
          </div>
          <div class="col">
            <div class="form-floating mb-3">
              <input type="datetime-local" class="form-control" id="datetime" placeholder="about this running event.">
              <label for="floatingPassword">เดือน/วัน/ปี และเวลางาน</label>
            </div>  
          </div>
        </div>
        <div class="row">
          <div class="col-sm">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="address" placeholder="about this running event.">
              <label for="floatingPassword">สถานที่จัดงาน</label>
            </div>  
          </div>
          <div class="col">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="province" placeholder="about this running event.">
              <label for="floatingPassword">จังหวัด</label>
            </div>  
          </div>
        </div>
        <div class="row">
          <div class="col-sm">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="dist" placeholder="about this running event.">
              <label for="floatingPassword">เขต / อำเภอ</label>
            </div>  
          </div>
          <div class="col">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="subdist" placeholder="about this running event.">
              <label for="floatingPassword">แขวง / ตำบล</label>
            </div>
          </div>
          <div class="col">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="zip" placeholder="about this running event.">
              <label for="floatingPassword">รหัสไปรษณีย์</label>
            </div>  
          </div>
        </div>
        <div class="row">
          <div class="col-sm">
            <div class="mb-3">
              <label for="formFile" class="form-label">ภาพปกงาน</label>
              <input class="form-control" type="file" id="coverimg" name="coverimg">
            </div>
          </div>
          <div class="col-sm">
            <div class="mb-3">
              <label for="formFile" class="form-label">แผนที่ / เส้นทางวิ่ง</label>
              <input class="form-control" type="file" id="mapimg" name="mapimg">
            </div>
          </div>
          <div class="col-sm">
            <div class="mb-3">
              <label for="formFile" class="form-label">ของรางวัล</label>
              <input class="form-control" type="file" id="rewardimg" name="rewardimg">
            </div>
          </div>
        </div>
        <div class="row text-center">
          <div class="col ">
          <button type="button" onclick="request_update()"
           class="btn btn-primary w-100">
            แก้ไขคำร้อง
          </button>
          </div>
          <div class="col" id="delBtn">

          </div>

        </div>
      </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>

      var request_readone = function () {
        const params = new URLSearchParams(window.location.search);
        const id = params.get("id");
        const requestOptions = {
          method: "GET",
          redirect: "follow",
        };

        fetch(
          "http://localhost/sos/newweb/api/requests/readone.php?id=" + id,
          requestOptions
        )
          .then((response) => response.text())
          .then((result) => {
            var jsonObj = JSON.parse(result);
            document.getElementById("id").value = jsonObj.id;
            document.getElementById("name").value = jsonObj.name;
            document.getElementById("about").value = jsonObj.about;
            document.getElementById("datetime").value = jsonObj.datetime;
            document.getElementById("type").value = jsonObj.type;
            document.getElementById("distance").value = jsonObj.distance;
            document.getElementById("cost").value = jsonObj.cost;
            document.getElementById("owner").value = jsonObj.owner;
            document.getElementById("address").value = jsonObj.address;
            document.getElementById("province").value = jsonObj.province;
            document.getElementById("dist").value = jsonObj.dist;
            document.getElementById("subdist").value = jsonObj.subdist;
            document.getElementById("zip").value = jsonObj.zip;

            var deleteBtn =document.createElement("button");
            deleteBtn.setAttribute("type", "button");
            deleteBtn.setAttribute("class", "btn btn-danger w-100");
            deleteBtn.innerHTML = "ลบคำร้อง";

            deleteBtn.onclick =function(){
              request_delete(jsonObj.id);
            }

            var col =document.getElementById("delBtn");
            col.innerHTML ="";
            col.appendChild(deleteBtn);
          })
          .catch((error) => console.error(error));
      };

      var request_update = function () {
        const myHeaders = new Headers();
        myHeaders.append("Content-Type", "application/json");

        const raw = JSON.stringify({
          id: document.getElementById("id").value,
          name: document.getElementById("name").value,
          about: document.getElementById("about").value,
          datetime: document.getElementById("datetime").value,
          type: document.getElementById("type").value,
          distance: document.getElementById("distance").value,
          cost: document.getElementById("cost").value,
          owner: document.getElementById("owner").value,
          address: document.getElementById("address").value,
          province: document.getElementById("province").value,
          dist: document.getElementById("dist").value,
          subdist: document.getElementById("subdist").value,
          zip: document.getElementById("zip").value,
        });

        const requestOptions = {
          method: "PATCH",
          headers: myHeaders,
          body: raw,
          redirect: "follow",
        };

        fetch(
          "http://localhost/sos/newweb/api/requests/update.php",
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

      var request_delete = function(id){
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

        fetch("http://localhost/sos/newweb/api/requests/delete.php", requestOptions)
          .then((response) => response.text())
          .then((result) => {
            var jsonObj =JSON.parse(result);
            if (jsonObj.status == "ok"){
              alert("Request deleted.");
              window.location.href = "/sos/newweb/admin/event.php"
            }
          })
          .catch((error) => console.error(error));
          }
    </script>
  </body>
</html>
