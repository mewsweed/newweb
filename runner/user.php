<?php
  session_start();

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body onload="user_readone(); info_readone();">
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
        <a href="/sos/newweb/runner/user.php?id=<?php echo $_SESSION['id'] ?>" class="nav-link active">บัญชีผู้ใช้</a>
      </li>
      <li class="nav-item">
        <a href="/sos/newweb/runner/event.php" class="nav-link">กิจกรรมงานวิ่ง</a>
      </li>
      <li class="nav-item">
        <a href="/sos/newweb/api/logout.php" class="nav-link" >ลงชื่อออก</a>
      </li>
    </ul>
  </header>
  <div class="contanier p-4">
    <div class="row text-center mb-3">
      <h1 class=" border-bottom border-4 pb-2">บัญชีของฉัน</h1>
    </div>
    <form action="" class="mt-3 mb-3 border border-2 p-4 text-center">
      <h3>อัปโหลดใบหน้า</h3>
      <div class="border">
        <img src="" alt="">
      </div>
      <div>
        <input type="file" name="face" id="face">
      </div>
      <button type="button" onclick="face_update()">upload face</button>
    </form>

    <form onsubmit="return false" class="mt-3 mb-3 border border-2 p-4">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="id" placeholder="0" disabled>
          <label for="floatingInput">ID</label>
        </div>
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="role" placeholder="role" disabled>
          <label for="floatingPassword">Role</label>
        </div>  
        <div class="form-floating mb-3">
          <input type="email" class="form-control" id="email" placeholder="example@email.com">
          <label for="floatingPassword">Email</label>
        </div>  
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="username" placeholder="username">
          <label for="floatingPassword">Username</label>
        </div>  
        <div class="row">
          <button type="button" onclick="user_update()" class="btn btn-primary">
            update account
          </button>
        </div>
      </form>

      <form onsubmit="return false" class="mt-3 mb-3 border border-2 p-4">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="user_id" placeholder="0" disabled>
          <label for="floatingInput">user_id</label>
        </div>
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="fname" placeholder="fname" >
          <label for="floatingPassword">fname</label>
        </div>  
        <div class="form-floating mb-3">
          <input type="email" class="form-control" id="lname" placeholder="lname">
          <label for="floatingPassword">lname</label>
        </div>  
        <div class="form-floating mb-3">
          <input type="date" class="form-control" id="birthday" placeholder="birthday">
          <label for="floatingPassword">birthday</label>
        </div>  
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="phone" placeholder="phone">
          <label for="floatingPassword">phone</label>
        </div>  
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="emerphone" placeholder="emerphone">
          <label for="floatingPassword">emerphone</label>
        </div>  
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="gender" placeholder="gender">
          <label for="floatingPassword">gender</label>
        </div>  
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="blood" placeholder="blood">
          <label for="floatingPassword">blood</label>
        </div>  
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="size" placeholder="size">
          <label for="floatingPassword">size</label>
        </div>  
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="address" placeholder="address">
          <label for="floatingPassword">address</label>
        </div>  
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="province" placeholder="province">
          <label for="floatingPassword">province</label>
        </div>  
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="dist" placeholder="dist">
          <label for="floatingPassword">dist</label>
        </div>  
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="subdist" placeholder="subdist">
          <label for="floatingPassword">subdist</label>
        </div>  
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="zip" placeholder="zip">
          <label for="floatingPassword">zip</label>
        </div>  
        <div class="row ">
          <button type="button" onclick="info_update()" class="btn btn-primary">
            update infomation
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
              document.getElementById("id").value = jsonObj.id;
              document.getElementById("email").value = jsonObj.email;
              document.getElementById("username").value = jsonObj.username;
              document.getElementById("role").value = jsonObj.role;
            })
            .catch((error) => console.error(error));
        };

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
            document.getElementById("gender").value =jsonObj.gender;
            document.getElementById("blood").value =jsonObj.blood;
            document.getElementById("size").value =jsonObj.size;
            document.getElementById("address").value =jsonObj.address;
            document.getElementById("province").value =jsonObj.province;
            document.getElementById("dist").value =jsonObj.dist;
            document.getElementById("subdist").value =jsonObj.subdist;
            document.getElementById("zip").value =jsonObj.zip;

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>