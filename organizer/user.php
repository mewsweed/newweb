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
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Organizer Profile</title>

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
  <!-- face_readone(); -->
  <body onload="user_readone(); info_readone(); ">
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
        <a href="/sos/newweb/organizer/user.php?id=<?php echo $_SESSION['id'] ?>" class="nav-link active">บัญชีผู้ใช้</a>
      </li>
      <li class="nav-item">
        <a href="/sos/newweb/organizer/create/event.php" class="nav-link">กิจกรรมงานวิ่ง</a>
      </li>
      <li class="nav-item">
        <a href="/sos/newweb/api/logout.php" class="nav-link" >ลงชื่อออก</a>
      </li>
    </ul>
  </header>
  <div class="contanier p-4">
    <div class="row text-center mb-3">
      <h1 class="pb-2">บัญชีของฉัน</h1>
    </div>
    <!-- <div class="row">

      <div class="col-md-4">
        <form action="/sos/newweb/api/faces/create.php" method="post" enctype="multipart/form-data" class="mt-3 mb-3 border border-2 p-4 text-center">
          <h3>อัปโหลดใบหน้า</h3>
          <input style="display: none;" type="text" name="id" id="faceId" readonly>

          <div class="border py-2" id="imageContainer">
            <img id="selectedImage" src="" alt=""  height="200px">
          </div>
          <div>
            <input type="file" name="face" id="face" onchange="previewImage(event)">
          </div>

          <button class="btn btn-primary" type="submit">upload face</button>
        </form>
      </div>
      <div class="col border">
        <div class="row mb-2" id="image_container">

        </div>  
        <div class="row">
          <div class="d-flex justify-content-end align-items-end">
            <button class="btn-sm btn-warning">Reset Face</button>
          </div>
        </div>
      </div>
    </div> -->
    
      <form onsubmit="return false" class="mt-3 mb-3 border border-2 p-4">
        <div class="row">
          <div class="col-sm-6">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="id" placeholder="0" readonly>
              <label for="floatingInput">ไอดี</label>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="role" placeholder="role" readonly>
              <label for="floatingPassword">บทบาท</label>
            </div>  
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-floating mb-3">
              <input type="email" class="form-control" id="email" placeholder="example@email.com">
              <label for="floatingPassword">อีเมล</label>
            </div>  
          </div>
          <div class="col-sm-6">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="username" placeholder="username">
              <label for="floatingPassword">ยูสเซอร์</label>
            </div>  
          </div>
        </div>
        <div class="row">
          <button type="button" onclick="user_update()" class="btn btn-primary">
            อัปเดทบัญชี
          </button>
        </div>
      </form>

      <form onsubmit="return false" class="mt-3 mb-3 border border-2 p-4">
        <div class="form-floating mb-3">
          <input type="hidden" class="form-control" id="user_id" placeholder="0" readonly>
          <!-- <label for="floatingInput">ยูสเซอร์ไอดี</label> -->
        </div>
        <div class="row">
          <div class="col-sm">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="fname" placeholder="fname" >
              <label for="floatingPassword">ชื่อจริง</label>
            </div>              
          </div>
          <div class="col-sm">
            <div class="form-floating mb-3">
              <input type="email" class="form-control" id="lname" placeholder="lname">
              <label for="floatingPassword">นามสกุล</label>
            </div>             
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-floating mb-3">
              <input type="date" class="form-control" id="birthday" placeholder="birthday">
              <label for="floatingPassword">วัน/เดือน/ปีเกิด</label>
            </div>              
          </div>
          <div class="col-sm-4">
          <div class="row py-1 px-3 mb-1 rounded">เพศ</div>
          <select class="form-select form-select-sm mb-3" aria-label="Large select example" id="gender">
            <option selected disabled>เพศ</option>
            <option value="ชาย">ชาย</option>
            <option value="หญิง">หญิง</option>
            <option value="ไม่ระบุ">ไม่ระบุ</option>
          </select>
          </div>
          <div class="col-sm-4 text-center">
            <div class="row py-1 px-3 mb-1 rounded">หมู่เลือด</div>
          <select class="form-select form-select-sm mb-3 text-center" aria-label="Large select example" id="blood">
            <option selected disabled>หมู่เลือด</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="AB">AB</option>
            <option value="O">O</option>
          </select>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="phone" placeholder="phone">
              <label for="floatingPassword">เบอร์ติดต่อ</label>
            </div>  
          </div>
          <div class="col">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="emerphone" placeholder="emerphone">
              <label for="floatingPassword">เบอร์ติดต่อกรณีฉุกเฉิน</label>
            </div>  
          </div>
        </div>

        <div class="row">
          <div class="col-2">
          <div class="row py-1 px-3 mb-1 rounded">ไซส์เสื้อ</div>
          <select class="form-select form-select-sm mb-3" id="size">
            <option selected disabled>ไซส์เสื้อ</option>
            <option value="XS">XS</option>
            <option value="S">S</option>
            <option value="M">M</option>
            <option value="L">L</option>
            <option value="XL">XL</option>
            <option value="2XL">2XL</option>
            <option value="3XL">3XL</option>
          </select>
          </div>
          <div class="col-5">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="address" placeholder="address">
              <label for="floatingPassword">ที่อยู่</label>
            </div>  
          </div>
          <div class="col-5">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="province" placeholder="province">
              <label for="floatingPassword">จังหวัด</label>
            </div>  
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="dist" placeholder="dist">
              <label for="floatingPassword">เขต/แขวง</label>
            </div>  
          </div>
        <div class="col-4">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="subdist" placeholder="subdist">
            <label for="floatingPassword">แขวง/ตำบล</label>
          </div>  
        </div>
  <div class="col-4">
  <div class="form-floating mb-3">
          <input type="text" class="form-control" id="zip" placeholder="zip">
          <label for="floatingPassword">ไปรษณีย์</label>
        </div>  
  </div>
 </div>
        <div class="row ">
          <button type="button" onclick="info_update()" class="btn btn-primary">
            อัปเดทข้อมูลส่วนตัว
          </button>
        </div>
      </form>

  </div>
    <script>
        var user_readone = function () {
          const params = new URLSearchParams(window.location.search);
          const id = params.get("id");
          const requestOptions = {
            method: "GET",
            redirect: "follow",
          };

          fetch(
            "http://localhost/sos/newweb/api/users/readone.php?id=" + id,
            requestOptions
          )
            .then((response) => response.text())
            .then((result) => {
              var jsonObj = JSON.parse(result);
              // document.getElementById('faceId').value = jsonObj.id;
              document.getElementById("id").value = jsonObj.id;
              document.getElementById("email").value = jsonObj.email;
              document.getElementById("username").value = jsonObj.username;
              document.getElementById("role").value = jsonObj.role;
            })
            .catch((error) => console.error(error));
        };

//         var face_readone = function() {
//     const params = new URLSearchParams(window.location.search);
//     const id = params.get("id");
//     const requestOptions = {
//         method: "GET",
//         redirect: "follow",
//     };
//     fetch("http://localhost/sos/newweb/api/faces/readbyid.php?id=" + id, requestOptions)
//         .then(response => response.json())
//         .then(result => {
//             let imageHTML = "";

//             result.forEach(face => {
//                 // alert(`${face.face}`)
//                 const imagePath = `/sos/newweb/uploads/runner/${face.face}`;
//                 imageHTML += `<div class="col">`
//                 imageHTML += `<img src="${imagePath}" alt="face image" width="100px">`;
//                 // imageHTML += 
//                 imageHTML += `</div>`
//             });

//             document.getElementById("image_container").innerHTML = imageHTML;
//         })
//         .catch(error => {
//             console.error("Error fetching data:", error);
//             document.getElementById("image_container").innerHTML = "An error occurred while fetching data.";
//         });
// }


var info_readone =function(){
          const params = new URLSearchParams(window.location.search);
          const id = params.get("id");
          const requestOptions = {
            method: "GET",
            redirect: "follow",
          };
          fetch("http://localhost/sos/newweb/api/info/readbyid.php?id="+id,requestOptions)
          .then((response) => response.text())
          .then((result) => {
            var jsonObj =JSON.parse(result);
            document.getElementById("user_id").value =jsonObj.user_id;
            document.getElementById("fname").value =jsonObj.fname;
            document.getElementById("lname").value =jsonObj.lname;
            document.getElementById("birthday").value =jsonObj.birthday;
            document.getElementById("phone").value =jsonObj.phone;
            document.getElementById("emerphone").value =jsonObj.emerphone;
            // document.getElementById("gender").value =jsonObj.gender;
            // document.getElementById("blood").value =jsonObj.blood;
            // document.getElementById("size").value =jsonObj.size;
            document.getElementById("address").value =jsonObj.address;
            document.getElementById("province").value =jsonObj.province;
            document.getElementById("dist").value =jsonObj.dist;
            document.getElementById("subdist").value =jsonObj.subdist;
            document.getElementById("zip").value =jsonObj.zip;

                // เช็คค่า jsonObj.gender แล้วตั้งค่า selected ให้กับ option ที่ตรงกัน
            var selectGender = document.getElementById("gender");
            for (var i = 0; i < selectGender.options.length; i++) {
                if (selectGender.options[i].value === jsonObj.gender) {
                    selectGender.options[i].setAttribute("selected", "selected");
                }
            }
                // เช็คค่า jsonObj.blood แล้วตั้งค่า selected ให้กับ option ที่ตรงกัน
            var selectBlood = document.getElementById("blood");
            for (var j = 0; j < selectBlood.options.length; j++) {
                if (selectBlood.options[j].value === jsonObj.blood) {
                    selectBlood.options[j].setAttribute("selected", "selected");
                }
            }

            var selectSize = document.getElementById("size");
            for (var k = 0; k < selectSize.options.length; k++) {
                if (selectSize.options[k].value === jsonObj.size) {
                    selectSize.options[k].setAttribute("selected", "selected");
                }
            }
            
          })
          .catch((error) => console.error(error));
        };

    </script>
    <script>
      var user_update = function () {
        const myHeaders = new Headers();
        myHeaders.append("Content-Type", "application/json");

        const raw = JSON.stringify({
          id: document.getElementById("id").value,
          email: document.getElementById("email").value,
          username: document.getElementById("username").value,
          role: document.getElementById("role").value,
        });

        const requestOptions = {
          method: "PATCH",
          headers: myHeaders,
          body: raw,
          redirect: "follow",
        };
        fetch(
          "http://localhost/sos/newweb/api/users/update.php",
          requestOptions
        )
          .then((response) => response.text())
          .then((result) => {
            var jsonObj = JSON.parse(result);
            if (jsonObj.status == "ok") {
              alert(jsonObj.message);
              window.location.href = "/sos/newweb/runner/index.php";
            } else {
              alert(jsonObj.message);
            }
          })
          .catch((error) => console.error(error));
      };

      var info_update =function(){
        const myHeaders = new Headers();
        myHeaders.append("Content-Type", "application/json");

        const raw = JSON.stringify({
          user_id: document.getElementById("user_id").value,
          fname: document.getElementById("fname").value,
          lname: document.getElementById("lname").value,
          birthday: document.getElementById("birthday").value,
          phone: document.getElementById("phone").value,
          emerphone: document.getElementById("emerphone").value,
          gender: document.getElementById("gender").value,
          blood: document.getElementById("blood").value,
          size: document.getElementById("size").value,
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
          "http://localhost/sos/newweb/api/info/update.php",
          requestOptions
        )
        .then((response) => response.text())
        .then((result) => {
            var jsonObj = JSON.parse(result);
            if (jsonObj.status == "ok") {
              alert(jsonObj.message);
              window.location.href = "/sos/newweb/runner/index.php";
            } else {
              alert(jsonObj.message);
            }
          })
        .catch((error) => console.error(error));
      }

      var face_update = function(){
        const params = new URLSearchParams(window.location.search);
        const id = params.get("id");
        const fileInput = document.querySelector('input[type="file"]');
        const file =fileInput.files[0]

        const formData = new FormData();
        formData.append('id', id);
        formData.append('face', file);

        const requestOptions = {
          method: "POST",
          body: formData,
          redirect: "follow",
        };
        fetch(
          "http://localhost/sos/newweb/api/faces/update.php",
          requestOptions
        )
        .then((response) => response.text())
        .then((result) => {
          var jsonObj =JSON.parse(result)
          if (jsonObj.status == "ok"){
            alert(jsonObj.message);
            window.location.reload()
          }else{
            alert(jsonObj.message);
          }
        })
        .catch((error) => console.error(error))
      }
    </script>

<script>
    function previewImage(event) {
        const input = event.target;
        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                const imageSrc = e.target.result;
                const image = document.getElementById('selectedImage');
                image.src = imageSrc;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>