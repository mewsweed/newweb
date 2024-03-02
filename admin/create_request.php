<?php session_start();

if(isset($_SESSION['role'])){

}else{
  
  header("Location: /sos/newweb/login.php");
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

    <title>ADMIN Create</title>
  </head>
  <body>
    <div class="container p-4">
      <div class="row text-center mt-3 mb-3">
        <h1>Create Request Events</h1>
      </div>
      <form action="./upload-img.php" method="post" enctype="multipart/form-data" class="mb-3" >
        <div class="row text-center" >
          <?php if(isset($_SESSION['coverimg'])){ ?>
          <div class="col-md">
            <h4>ภาพปกงาน</h4>
            <img src="<?php echo $_SESSION['coverimg']; ?>" alt="" class="img-thumbnail" id="coverimg">
            <input type="text" id="coverimgpath" value="<?php echo $_SESSION['coverimg']; ?>">
          </div>
            <?php } ?>
            <?php if(isset($_SESSION['mapimg'])){ ?>
            <div class="col-md">
            <img src="<?php echo $_SESSION['mapimg']; ?>" alt="" class="img-thumbnail" id="mapimg">
              <input type="text" id="mapimgpath" value="<?php echo $_SESSION['mapimg']; ?>">
            </div>
            <?php } ?>
            <?php if(isset($_SESSION['rewardimg'])){ ?>
            <div class="col-md">
            <img src="<?php echo $_SESSION['rewardimg']; ?>" alt="" class="img-thumbnail" id="rewardimg">
              <input type="text" id="rewardimgpath" value="<?php echo $_SESSION['rewardimg']; ?>">
            </div>
            <?php } ?>
        </div>
      <div class="row text-center mt-2">
          <div class="col-lg">
            <div class="mb-3">
              <label for="formFile" class="form-label">ภาพปกงาน</label>
              <input class="form-control" type="file" name="coverimg">
            </div>
          </div>
          <div class="col-lg">
            <div class="row">
            <div class="mb-3">
              <label for="formFile" class="form-label"><h4>แผนที่ / เส้นทางวิ่ง</h4></label>
              <input class="form-control" type="file" name="mapimg">
            </div>
            </div>
          </div>
          <div class="col-lg">
            <div class="mb-3">
              <label for="formFile" class="form-label"><h4>ของรางวัล</h4></label>
              <input class="form-control" type="file" name="rewardimg">
            </div>
          </div>
        </div>
        <div class="row px-4">
          <button type="submit" class="btn btn-primary">Upload</button>
        </div>
      </form>
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
              <input type="text" class="form-control" id="owner" placeholder="owner" disabled value="<?php echo $_SESSION['email'] ?>" >
              <label for="floatingPassword">ผู้จัดงาน</label>
            </div>  
          </div>
        </div>

        <div class="row">
          <div class="col-sm">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="name" placeholder="event name">
              <label for="floatingPassword">ชื่องาน</label>
            </div>  
          </div>
          <div class="col-md-4">
            <!-- <div class="form-floating mb-3">
              <input type="text" class="form-control" id="type" placeholder="event name">
              <label for="floatingPassword">ประเภท</label>
            </div>   -->
            <select class="form-select form-select-lg mb-3" id="type">
              <option selected>ประเภทงาน</option>
              <option value="เดิน">เดิน</option>
              <option value="วิ่ง">วิ่ง</option>
              <option value="มาราทอน">มาราทอน</option>
            </select>
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
        
        <div class="row text-center">
          <div class="col ">
          <button type="button" onclick="request_create()"
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
      var request_create = function () {
        const myHeaders = new Headers();
        myHeaders.append("Content-Type", "application/json");

        const raw = JSON.stringify({
          name: document.getElementById("name").value,
          about: document.getElementById("about").value,
          type: document.getElementById("type").value,
          datetime: document.getElementById("datetime").value,
          distance: document.getElementById("distance").value,
          cost: document.getElementById("cost").value,
          owner: document.getElementById("owner").value,
          address: document.getElementById("address").value,
          province: document.getElementById("province").value,
          dist: document.getElementById("dist").value,
          subdist: document.getElementById("subdist").value,
          zip: document.getElementById("zip").value,
          coverimg: document.getElementById("coverimgpath").value,
          mapimg: document.getElementById("mapimgpath").value,
          rewardimg: document.getElementById("rewardimgpath").value,
        });

        const requestOptions = {
          method: "POST",
          headers: myHeaders,
          body: raw,
          redirect: "follow",
        };

        fetch(
          "http://localhost/sos/newweb/api/requests/create.php",
          requestOptions
        )
          .then((response) => response.text())
          .then((result) => {
            var jsonObj = JSON.parse(result);
            if (jsonObj.status == "ok") {
              alert(jsonObj.message);
              window.location.href = "/sos/newweb/admin/event.php"
            } else {
              alert(jsonObj.message);
            }
          })
          .catch((error) => console.error(error));
      };
    </script>
  </body>
</html>