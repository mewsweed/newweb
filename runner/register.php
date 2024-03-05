<?php
session_start();
require_once('../api/server.php');

if (isset($_POST['submit'])) {
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $user_id = $_POST['user_id'];
        $event_id = $_POST['event_id'];
        $size = $_POST['size'];
        $ship = $_POST['ship'];

        // เช็คว่า user_id นี้เคยสมัคร event_id นี้แล้วหรือไม่
        $stmt_check = $dbh->prepare("SELECT COUNT(*) AS total FROM event_joined WHERE user_id = :user_id AND event_id = :event_id");
        $stmt_check->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt_check->bindParam(':event_id', $event_id, PDO::PARAM_INT);
        $stmt_check->execute();
        $row = $stmt_check->fetch(PDO::FETCH_ASSOC);
        $total = $row['total'];

        if ($total > 0) {
            echo "คุณได้สมัครงานนี้ไปแล้ว";
        } else {
            $file_tmp = $_FILES['paid']['tmp_name'];
            // อ่านขนาดของไฟล์
            $file_size = $_FILES['paid']['size'];

            // เปิดแฟ้มข้อมูลไฟล์และอ่านข้อมูลเป็น binary
            $fp = fopen($file_tmp, 'rb');
            $paid_binary = fread($fp, $file_size);
            fclose($fp);

            // แปลงข้อมูล binary เป็นรูปแบบ Base64
            $paid_base64 = base64_encode($paid_binary);

            // ระบุค่า runNo โดยนับจำนวนข้อมูลที่มี event_id เดียวกันในตาราง
            $stmt = $dbh->prepare("SELECT COUNT(*) AS total FROM event_joined WHERE event_id = :event_id");
            $stmt->bindParam(':event_id', $event_id, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $runNo = $row['total'] + 1; // นับแล้วเพิ่ม 1

            // เพิ่มข้อมูลลงในตาราง event_joined
            $stmt = $dbh->prepare("INSERT INTO event_joined (user_id, event_id, runNo, size, paid ,ship) VALUES (:user_id, :event_id, :runNo, :size, :paid :ship)");
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':event_id', $event_id, PDO::PARAM_INT);
            $stmt->bindParam(':runNo', $runNo, PDO::PARAM_INT);
            $stmt->bindParam(':size', $size, PDO::PARAM_STR);
            $stmt->bindParam(':paid', $paid_base64, PDO::PARAM_STR);
            $stmt->bindParam(':ship', $ship, PDO::PARAM_STR);

            if ($stmt->execute()) {
                // การส่งไปยังหน้าเว็บหลังจากสำเร็จ
                header("Location: /sos/newweb/runner/index.php");
                exit; // ใช้ exit เพื่อหยุดการทำงานของสคริปต์ทันทีหลังจาก redirect
            } else {
                echo "Error: ";
            }
        }
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


    <title>RUNNER JOIN</title>
  </head>
  <body onload="event_readone(); info_readone();">
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
          <h5 id="owner">ผู้จัดงาน:</h5>
        </div>
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
          <p>ระยะทาง(KM)</p>
          <h5 id="distance"></h5>
        </div>
        <div class="col-sm border pt-4">
          <p>ค่าสมัคร(บาท)</p>
          <h5 id="cost"></h5>
        </div>
      </div>
      <div class="row p-4 text-center">
        <div class="col-sm-4">
            <h3>การชำระเงิน</h3>
            <img src="/sos/newweb/uploads/asset/desktop-1920x1080.jpg" alt=""  class="img-thumbnail" id="paymentimg">
        </div>
        <div class="col-sm-4 d-flex justify-content-center align-items-center">
            <form action="" method="POST" enctype="multipart/form-data">
                <h3>ฟอร์มสมัครเข้าร่วม</h3>
                <input type="hidden" name="user_id" id="user_regis_id">
                <input type="hidden" name="event_id" id="event_regis_id">
                <div class="col">
                    <label for="size" class="m-2">ไซส์</label>
                    <select class="form-select form-select-lg mb-3" aria-label="Large select example" id="size" name="size">
                        <option selected disabled>ไซส์</option>
                        <option value="xs">xs</option>
                        <option value="s">s</option>
                        <option value="m">m</option>
                        <option value="l">l</option>
                        <option value="xl">xl</option>
                        <option value="2xl">2xl</option>
                    </select>
                </div>
                <div class="col border p-2">
                        <label for=""><h5>อัปโหลดสลิปที่นี้</h5></label>
                        <input type="file" name="paid" id="face" accept="jpg" onchange="previewImage(event)">
                </div>
                <div class="col p-2">
                    <input type="submit" name="submit" class="btn btn-primary" value="ยืนยันการสมัคร">
                </div>
            </form>
            
        </div>
        <div class="col-sm-4">
            <h3>ตัวอย่างเสื้อ</h3>
            <img src="/sos/newweb/uploads/asset/desktop-1920x1080.jpg" alt=""  class="img-thumbnail" id="rewardimg">
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
      <!-- <div class="row p-4">
      <div class="col-md">
        <img src="/sos/newweb/uploads/asset/desktop-1920x1080.jpg" alt="" class="img-thumbnail" id="rewardimg">
          
        </div>
        <div class="col"> -->
        <!-- <button class="btn btn-primary" onclick="window.location.href='register.php?user_id=<?php echo $_SESSION['id']; ?>&event_id=' + encodeURIComponent('<?php echo $event_id; ?>')">เข้าร่วม</button> -->
        <!-- </div>
      </div> -->
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>
      var event_readone = function () {
        const params = new URLSearchParams(window.location.search);
        const id = params.get("event_id");
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
            
            document.getElementById('event_regis_id').value =id;

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
            // document.getElementById('coverimg').src = "/sos/newweb/uploads/asset/"+jsonObj.coverimg;
            document.getElementById('mapimg').src = "/sos/newweb/uploads/asset/"+jsonObj.mapimg;
            document.getElementById('rewardimg').src = "/sos/newweb/uploads/asset/"+jsonObj.rewardimg;
            document.getElementById('paymentimg').src = "/sos/newweb/uploads/asset/"+jsonObj.paymentimg;
          })
          .catch((error) => console.error(error));
      };
    </script>
    <script>
        var info_readone =function(){
            const params = new URLSearchParams(window.location.search);
            const id = params.get("user_id");
            const requestOptions = {
                method: "GET",
                redirect: "follow",
            };
            fetch(
            "http://localhost/sos/newweb/api/info/readbyid.php?id=" + id,
            requestOptions
            )
            .then((response)=> response.text())
            .then((result)=>{
                var jsonObj = JSON.parse(result)

                document.getElementById('user_regis_id').value =id;

                var selectSize = document.getElementById("size");
                for (var k = 0; k < selectSize.options.length; k++) {
                    if (selectSize.options[k].value === jsonObj.size) {
                        selectSize.options[k].setAttribute("selected", "selected");
                    }
                }
            })
        }

    </script>
  </body>
</html>
