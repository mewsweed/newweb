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

    <title>ADMIN Edit</title>
  </head>
  <body>
    <div class="container">
      <div class="row text-center mt-3 mb-3">
        <h1>Edit Events</h1>
      </div>

      <!-- <form action="" method="post" enctype="multipart/form-data" class="mb-3" >
        <div class="row text-center" >
          <div class="col-md">
            <h4>ปกงาน</h4>
            <img src="" alt="" class="img-thumbnail" id="coverImage">
            <input type="text" id="coverimgpath" value="">
          </div>
            <div class="col-md">
            <h4>แผนที่</h4>
              <img src="" alt="" class="img-thumbnail" id="mapImage">
              <input type="text" id="mapimgpath" value="">
            </div>
            <div class="col-md">
            <h4>รางวัล</h4>
            <img src="" alt="" class="img-thumbnail" id="rewardImage">
              <input type="text" id="rewardimgpath" value="">
            </div>
            <div class="col-md">
            <h4>การชำระเงิน</h4>
            <img src="" alt="" class="img-thumbnail" id="paymentImage">
              <input type="text" id="paymentimgpath" value="">
            </div>
        </div>
      <div class="row text-center mt-2">
          <div class="col-lg">
            <div class="mb-3">
              <label for="formFile" class="form-label">ภาพปกงาน</label>
              <input class="form-control" type="file" name="coverimg" onchange="showCoverImg()">
            </div>
          </div>
          <div class="col-lg">
            <div class="row">
            <div class="mb-3">
              <label for="formFile" class="form-label"><h4>แผนที่ / เส้นทางวิ่ง</h4></label>
              <input class="form-control" type="file" name="mapimg" onchange="showMapImg()">
            </div>
            </div>
          </div>
          <div class="col-lg">
            <div class="mb-3">
              <label for="formFile" class="form-label"><h4>ของรางวัล</h4></label>
              <input class="form-control" type="file" name="rewardimg" onchange="showRewardImg()">
            </div>
          </div>
          <div class="col-lg">
            <div class="mb-3">
              <label for="formFile" class="form-label"><h4>การชำระเงิน</h4></label>
              <input class="form-control" type="file" name="paymentimg" onchange="showPaymentImg()">
            </div>
          </div>
        </div>
        <div class="row px-4">
          <button type="submit" name="submitimg" class="btn btn-primary">Upload</button>
        </div>
      </form> -->


      <form onsubmit="return false">
        <div class="row">
          <div class="col-sm-5">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="id" placeholder="0" readonly>
              <label for="floatingInput">ไอดีคำร้องขอจัดงาน</label>
            </div>
          </div>
          <div class="col-sm-5">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="owner" placeholder="owner" readonly>
              <label for="floatingPassword">ผู้จัดงาน</label>
            </div>  
          </div>
          <div class="col">
            <select class="form-select form-select-lg mb-3" id="photo" placeholder="ช่างภาพ">
                <option selected disabled>ช่างภาพ</option>
                <option value="ไม่รับสมัคร">ไม่รับช่างภาพ</option>
                <option value="รับสมัคร">รับช่างภาพ</option>
              </select>
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
          <button type="button" onclick="event_update()"
           class="btn btn-primary w-100">
            แก้ไขคำร้อง
          </button>
          </div>
          <div class="col" id="">
            <label for="">สถานะ</label>
            <select id="status">
              <option value="รออนุมัติ">รออนุมัติ</option>
              <option value="อนุมัติ">อนุมัติ</option>
              <option value="ไม่อนุมัติ">ไม่อนุมัติ</option>
            </select>
          </div>

        </div>
      </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
      document.addEventListener("DOMContentLoaded", function() {
        event_readone();
            // นำ URL ของรูปภาพที่ได้รับมาแสดงใน tag img ต่างๆ
      });

    </script>
    <script>
        var event_readone =function(){
            const params = new URLSearchParams(window.location.search);
            const id = params.get("id");
            const requestOptions = {
            method: "GET",
            redirect: "follow",
            };
            fetch("http://localhost/sos/newweb/api/events/readone.php?id="+id,requestOptions)
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
                // document.getElementById("coverimg").src = jsonObj.coverimg;
                // document.getElementById("mapimg").src = jsonObj.mapimg;
                // document.getElementById("rewardimg").src = jsonObj.rewardimg;
                // document.getElementById("paymentimg").src = jsonObj.paymentimg;
                // document.getElementById("status").value = jsonObj.status;
                // document.getElementById("photo").value = jsonObj.photo;

                var statusSelect = document.getElementById("status");
                var statusOptions = statusSelect.options;

                for (var i = 0; i < statusOptions.length; i++) {
                    if (statusOptions[i].value === jsonObj.status) {
                        statusOptions[i].selected = true;
                        break;
                    }
                }
                var photoSelect = document.getElementById("photo");
                var photoOptions = photoSelect.options;

                for (var i = 0; i < statusOptions.length; i++) {
                    if (parseInt(photoOptions[i].value) === jsonObj.photo) {
                        photoOptions[i].selected = true;
                        break;
                    }
                }
            })
            .catch((error) => {
            console.error('There was a problem with the fetch operation:', error);
            // เพิ่มโค้ดที่ต้องการให้ทำงานเมื่อเกิดข้อผิดพลาด  เช่น แสดงข้อความแจ้งเตือนหรือจัดการในลักษณะอื่น
        });
        }
    </script>
    <script>
      var event_update = function () {
        const myHeaders = new Headers();
        myHeaders.append("Content-Type", "application/json");

        const raw = JSON.stringify({
          id: document.getElementById("id").value,
          owner: document.getElementById("owner").value,
          photo: document.getElementById("photo").value,
          name: document.getElementById("name").value,
          type: document.getElementById("type").value,
          about: document.getElementById("about").value,
          distance: document.getElementById("distance").value,
          cost: document.getElementById("cost").value,
          datetime: document.getElementById("datetime").value,
          address: document.getElementById("address").value,
          province: document.getElementById("province").value,
          dist: document.getElementById("dist").value,
          subdist: document.getElementById("subdist").value,
          zip: document.getElementById("zip").value,
          status: document.getElementById("status").value,
        });


        const requestOptions = {
          method: "PATCH",
          headers: myHeaders,
          body: raw,
          redirect: "follow",
        };

        fetch(
          "http://localhost/sos/newweb/api/events/update.php",
          requestOptions
        )
          .then((response) => response.text())
          .then((result) => {
            var jsonObj = JSON.parse(result);
            if (jsonObj.status == "ok") {
              alert(jsonObj.message);
              window.location.href = "/sos/newweb/admin/index.php"
            } else {
              alert(jsonObj.message);
            }
          })
          .catch((error) => console.error(error));
      };

    </script>

<!-- <script>
function showCoverImg() {
  var input = document.querySelector('input[name="coverimg"]');
  var img = document.getElementById('coverImage');
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      img.src = e.target.result;
    };
    reader.readAsDataURL(input.files[0]);
  }
}

function showMapImg() {
  var input = document.querySelector('input[name="mapimg"]');
  var img = document.getElementById('mapImage');
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      img.src = e.target.result;
    };
    reader.readAsDataURL(input.files[0]);
  }
}

function showRewardImg() {
  var input = document.querySelector('input[name="rewardimg"]');
  var img = document.getElementById('rewardImage');
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      img.src = e.target.result;
    };
    reader.readAsDataURL(input.files[0]);
  }
}

function showPaymentImg() {
  var input = document.querySelector('input[name="paymentimg"]');
  var img = document.getElementById('paymentImage');
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      img.src = e.target.result;
    };
    reader.readAsDataURL(input.files[0]);
  }
}
</script> -->
  </body>
</html>
<?php
$imagePaths = array();

if(isset($_POST['submitimg'])){
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // ตรวจสอบว่ามีไฟล์ถูกส่งมาหรือไม่
    if (isset($_FILES['coverimg']) && isset($_FILES['mapimg']) && isset($_FILES['rewardimg']) && isset($_FILES['paymentimg'])){
        // กำหนดโฟลเดอร์ที่จะบันทึกไฟล์รูป
        $targetDir = "../../uploads/asset/";
        
        // ตรวจสอบว่ามีค่า $_SESSION['email'] อยู่หรือไม่
        if(isset($_SESSION['email'])) {
          // ถ้ามี $_SESSION['email'] ให้ใช้ค่าใน $_SESSION['email'] เป็นชื่อโฟลเดอร์
          $targetDir .= $_SESSION['email'] . "/";
          
          // ตรวจสอบว่าโฟลเดอร์ยังไม่มีอยู่ให้สร้างใหม่
          if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
          }
        } else {
          // กรณีที่ไม่มี $_SESSION['email']
          echo json_encode(array("error" => "User email session not found."));
          exit(); // จบการทำงานทันที
        }
        
        // สร้างชื่อไฟล์ใหม่โดยใช้เวลาปัจจุบันเป็นส่วนหลังของชื่อไฟล์เพื่อป้องกันชื่อไฟล์ซ้ำ
        $coverimgName = uniqid() . "_" . basename($_FILES["coverimg"]["name"]);
        $mapimgName = uniqid() . "_" . basename($_FILES["mapimg"]["name"]);
        $rewardimgName = uniqid() . "_" . basename($_FILES["rewardimg"]["name"]);
        $paymentimgName = uniqid() . "_" . basename($_FILES["paymentimg"]["name"]);
        
        // กำหนด path ของไฟล์ที่จะบันทึกลงในโฟลเดอร์
        $coverimgPath =  $targetDir . $coverimgName;
        $mapimgPath =  $targetDir . $mapimgName;
        $rewardimgPath =  $targetDir . $rewardimgName;
        $paymentimgPath =  $targetDir . $paymentimgName;
        
        // อัพโหลดไฟล์รูปลงในโฟลเดอร์
        if (move_uploaded_file($_FILES["coverimg"]["tmp_name"], $coverimgPath) &&
            move_uploaded_file($_FILES["mapimg"]["tmp_name"], $mapimgPath) &&
            move_uploaded_file($_FILES["rewardimg"]["tmp_name"], $rewardimgPath) &&
            move_uploaded_file($_FILES["paymentimg"]["tmp_name"], $paymentimgPath)) {
            // สร้าง array เพื่อเก็บ path ของไฟล์รูป
            $imagePaths = array(
                "coverimg" => $coverimgName,
                "mapimg" => $mapimgName,
                "rewardimg" => $rewardimgName,
                "paymentimg" => $paymentimgName
            );
            
        } else {
            // กรณีอัพโหลดไม่สำเร็จ
            echo json_encode(array("error" => "Failed to upload files."));
        }
    } else {
        // กรณีไม่มีไฟล์รูปถูกส่งมา
        echo json_encode(array("error" => "No files uploaded."));
    }
  } else {
    // กรณีไม่ใช่เมธอด POST
    echo json_encode(array("error" => "Only POST requests are allowed."));
  }
}
?>
<!-- <script>
// เรียกใช้ JSON ที่ส่งกลับมา
var imagePathsJSON = <?php echo json_encode($imagePaths); ?>;

// เข้าถึง path ของไฟล์รูปแต่ละประเภท
var coverimgPath = imagePathsJSON.coverimg;
var mapimgPath = imagePathsJSON.mapimg;
var rewardimgPath = imagePathsJSON.rewardimg;
var paymentimgPath = imagePathsJSON.paymentimg;

// นำ path ไปใช้งานตามต้องการ เช่น ใช้ในการแสดงรูปภาพใน HTML
document.getElementById("coverImage").src = "../../uploads/asset/<?php echo $_SESSION['email']?>/"+ coverimgPath;
document.getElementById("mapImage").src = "../../uploads/asset/<?php echo $_SESSION['email']?>/"+ mapimgPath;
document.getElementById("rewardImage").src =  "../../uploads/asset/<?php echo $_SESSION['email']?>/"+ rewardimgPath;
document.getElementById("paymentImage").src =  "../../uploads/asset/<?php echo $_SESSION['email']?>/"+ paymentimgPath;
// นำ path ไปใช้งานตามต้องการ เช่น ใช้ในการแสดงรูปภาพใน HTML
document.getElementById("coverimgpath").value = coverimgPath;
document.getElementById("mapimgpath").value = mapimgPath;
document.getElementById("rewardimgpath").value = rewardimgPath;
document.getElementById("paymentimgpath").value = paymentimgPath;
</script> -->