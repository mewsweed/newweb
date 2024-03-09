<?php 
  session_start();
  require("./api/server.php");

  if(isset($_SESSION['role'])){
    if($_SESSION['role'] === 'runner'){
      header("Location: /sos/newweb/runner/index.php");
    }elseif($_SESSION['role'] === 'organizer'){
      header("Location: /sos/newweb/organizer/index.php");
    }elseif($_SESSION['role'] === 'admin'){
      header("Location: /sos/newweb/admin/index.php");
    }
  }

  if($_SERVER['REQUEST_METHOD'] == "POST"){
    if (isset($_POST['email']) && isset($_POST['password'])){
      $email = $_POST['email'];
      $password = $_POST['password'];

      $stmt = $dbh->prepare("SELECT * FROM users WHERE email=?");
      $stmt->bindParam(1, $email);
      $stmt->execute();
      $user = $stmt->fetch(PDO::FETCH_ASSOC);
      if(!$user){
        // echo json_encode(array("status" => "error", "message" => "User not found"));
        $_SESSION['error'] = "ไม่พบอีเมลนี้ในระบบ";
        header("Location: login.php");
        die();
      }
      if (!password_verify($password, $user['password'])) {
        // echo json_encode(array("status" => "error", "message" => "Incorrect password"));
        $_SESSION['error'] = "รหัสผ่านไม่ถูกต้อง";
        header("Location: login.php");
        die();
      }
      $_SESSION['id'] = $user['id'];
      $_SESSION['email'] = $user['email'];
      $_SESSION['role'] = $user['role'];

      $dbh=null;
      if($user['role'] === 'admin'){
        header("Location: admin/index.php");
      }elseif($user['role'] === 'runner'){
        header("Location: runner/index.php");
      }elseif($user['role'] === 'organizer'){
        header("Location: organizer/index.php");
      }

    }

  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>เข้าสู่ระบบ</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <style>
      body{
        padding-top: 2rem;
        background-color: #f2ffff;
      }
      .form-register,
      .form-login {
        max-width: 25rem;
        margin: auto;
      }
    </style>
  </head>

  <body class="text-center">
    <div class="form-login">
      
    <img src="/sos/newweb/uploads/asset/web/icon.png" height="250" alt="login">
      <form method="POST">
        <h1 class="mt-3 mb-3 text-primary">เข้าสู่ระบบ</h1>
        <div class="text text-danger">
        <?php
          if(isset($_SESSION['error'])){
            echo $_SESSION['error'];
          }
        ?>
        </div>
        <div class="form-floating mb-3">
          <input
            type="email"
            class="form-control"
            id="email"
            name="email"
            placeholder="name@example.com"
          />
          <label for="floatingInput">อีเมล</label>
        </div>
        <div class="form-floating">
          <input
            type="password"
            class="form-control"
            id="password"
            name="password"
            placeholder="รหัสผ่าน"
          />
          <label for="floatingPassword">รหัสผ่าน</label>
        </div>
        <div class="row mb-3">
          <div class="col">
            <button type="submit" class="btn btn-primary w-100 mt-3">
              เข้าสู่ระบบ
            </button>
          </div>
          <div class="col">
            <button
              type="button"
              class="btn btn-primary w-100 mt-3"
              onclick="goRegister()"
            >
              สมัครสมาชิก
            </button>
          </div>
        </div>
        <div class="row">
          <p>ลืมรหัสผ่าน <a href="">กด</a></p>
        </div>
      </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
  </body>
</html>


<script>
  var goRegister = function(){
    window.location.href = "register.php";
  }
  var login = function(){
        const myHeaders = new Headers();
        myHeaders.append("Content-Type", "application/json");

        const raw = JSON.stringify({
          email: document.getElementById("email").value,
          // username: document.getElementById("username").value,
          password: document.getElementById("password").value,
          // confirm_password: document.getElementById("confirm_password").value,
          // role: "organizer",
        });

        const requestOptions = {
          method: "POST",
          headers: myHeaders,
          body: raw,
          redirect: "follow",
        };

        fetch(
          "http://localhost/sos/newweb/api/login.php",
          requestOptions
        )
          .then((response) => response.text())
          .then((result) => {
            var jsonObj = JSON.parse(result);
            if (jsonObj.status == "ok") {
              alert(jsonObj.message);
              if (jsonObj.user){
                sessionStorage.setItem('user', JSON.stringify(jsonObj.user));
                var role = jsonObj.user.role;

                switch(role){
                  case "runner":
                    window.location.href = "runner/index.php";
                    break;
                  case "admin":
                    window.location.href = "admin/index.php";
                    break;
                  case "organizer":
                    window.location.href = "organizer/index.php";
                    break;
                  default:
                    alert("Invalid user role");
                    break;
                }
              }
            } else {
              alert(jsonObj.message);
            }
          })
          .catch((error) => console.error(error));
      };

</script>