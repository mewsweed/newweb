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
    <style>
.mew{
  border-radius: 1rem;
  background-color: #fafafa;
}

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
  <body onload="event_readone(); info_readone()">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-2 border-bottom">
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
            <a href="/sos/newweb/runner/user.php?id=<?php echo $_SESSION['id'] ?>" class="nav-link ">บัญชีผู้ใช้</a>
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
      <div class="row">
        <div class="col">
          <h2><span class="mx-4 py-1 border-dark border-4 border-bottom">ชื่องาน</span></h2>
        </div>
        <div class="col">
        <h1 id="name"></h1>
        </div>
      </div>
      <div class="row p-4">
        <img src="/sos/newweb/uploads/asset/desktop-1920x1080.jpg" alt=""  class="img-fluid" id="coverimg" style="height: 600px">
      </div>
      <div class="row ">
        <div class="col">
          <small id="owner">ผู้จัดงาน : </small>
          <h2><span class="px-2">ปี-เดือน-วัน เวลา</span></h2>
          <h3 id="datetime" class="px-2" ></h3>
        </div>
        <div class="col">
          <div class="row p-4">
            <h3><span class="border-bottom border-2 border-dark ">วัตถุประสงค์</span></h3>
            <p id="about"></p>
          </div>
        </div>
      </div>
      <div class="row ">
        <div class="col">
          <div class="row px-4 py-1">
            <div class="col">
              <h3><span class="border-dark border-3 border-bottom">สถานที่จัดงาน</span></h3>
            </div>
          </div>
          <div class="col px-2">
            <h5 id="address"></h5>
          </div>

          <div class="row ">
            <div class="col px-4 ">
              <small>จังหวัด</small>
              <h5 id="province"></h5>
            </div>
          </div>
          <div class="row">
            <div class="col px-4">
              <small>เขต</small>
              <h5 id="dist"></h5>
            </div>
            <div class="col px-4">
              <small>แขวง</small>
              <h5 id="subdist"></h5>
            </div>
            <div class="col px-4">
              <small>ไปรษณีย์</small>
              <h5 id="zip"></h5>
            </div>
            <div class="row my-2">
              <div class="col px-4">
                <small>ประเภท</small>
                <h5 id="type"></h5>
              </div>
              <div class="col px-4">
                <small>ระยะทาง(กิโลเมตร)</small>
                <h5 id="distance"></h5>
              </div>
            </div>
            <div class="row">
              <div class="col px-4">
                <small>ค่าสมัคร(บาท)</small>
                <h5 id="cost"></h5>
              </div>
              <div class="col">
                <button class="btn btn-primary" onclick="scrollToSection('register')">เข้าร่วม</button>
              </div>
            </div>
            <div class="row mt-2 px-2">
            <div class="col-md">
              <img src="" alt="" class="img-thumbnail" id="rewardimg">
            </div>
          </div>

        </div>
      </div>
      <div class="col">
        <div class="col-md">
          <img src="" alt="" class="img-thumbnail" id="mapimg">
        </div>
        <div class="row mt-2">
        <div class="col-md text-center">
            <div class="col mb-2">
            <small class="border-bottom border-dark">qr-code สำหรับชำระเงิน</small>
            </div>              
            <img src="" alt="" class="img-thumbnail" id="paymentimg" width="200px">
        </div>
        <section id="register">
          <div class="row mx-4">
              <form action="" method="POST" enctype="multipart/form-data">
                  <h3 class="mt-3"><span class="px-2">ฟอร์มสมัครเข้าร่วม</span></h3>
                  <input type="hidden" name="user_id" id="user_regis_id">
                  <input type="hidden" name="event_id" id="event_regis_id">
                  <div class="col">
                      <label for="size" class="m-2">ไซส์</label>
                      <select class="form-select form-select-lg mb-3" aria-label="Large select example" id="size" name="size">
                          <option selected disabled>ไซส์</option>
                          <option value="2XS">2XS</option>
                          <option value="XS">XS</option>
                          <option value="S">S</option>
                          <option value="M">M</option>
                          <option value="L">L</option>
                          <option value="XL">XL</option>
                          <option value="2XL">2XL</option>
                          <option value="3XL">3XL</option>
                          <option value="4XL">4XL</option>
                          <option value="5XL">5XL</option>
                      </select>
                  </div>
                  <div class="col">
                      <label for="ship" class="m-2">การรับของ</label>
                      <select class="form-select form-select-lg mb-3" aria-label="Large select example" id="ship" name="ship">
                          <option selected disabled>การรับของ</option>
                          <option value="รับหน้างาน">รับหน้างาน</option>
                          <option value="จัดส่งตามที่อยู่">จัดส่งตามที่อยู่</option>
                      </select>
                  </div>
                  <div class="col border p-2">
                          <label for=""><h5>อัปโหลดสลิปที่นี้</h5></label>
                          <input type="file" name="paid" id="face" accept="jpg,png" onchange="previewImage(event)">
                  </div>
                  <div class="col p-2">
                      <input type="submit" name="submit" class="btn btn-primary" value="ยืนยันการสมัคร">
                  </div>
              </form>
            </div>
          </section>
              

        </div>
      </div>
    </div>
    <footer>
        <p>&copy; 2024 My Website. All rights reserved.</p>
    </footer>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        function scrollToSection(sectionId) {
            const section = document.getElementById(sectionId);
            if (section) {
                section.scrollIntoView({ behavior: 'smooth' });
            }
        }
    </script>
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
            document.getElementById('coverimg').src = "/sos/newweb/uploads/asset/"+jsonObj.owner+"/"+jsonObj.coverimg;
            document.getElementById('mapimg').src = "/sos/newweb/uploads/asset/"+jsonObj.owner+"/"+jsonObj.mapimg;
            document.getElementById('rewardimg').src = "/sos/newweb/uploads/asset/"+jsonObj.owner+"/"+jsonObj.rewardimg;
            document.getElementById('paymentimg').src = "/sos/newweb/uploads/asset/"+jsonObj.owner+"/"+jsonObj.paymentimg;
            // document.getElementById("id").value = jsonObj.id;
            // document.getElementById("email").value = jsonObj.email;
            // document.getElementById("username").value = jsonObj.username;
            // document.getElementById("role").value = jsonObj.role;

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
