
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register Member</title>
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
    <link rel="stylesheet" href="style.css" />
  </head>
  <body class="text-center">
    <div class="form-register">
      <form onsubmit="return false">
        <!-- <img src="/bird-eyes-run1.jpg" height="250" alt="login"> -->
        <h1 class="mt-3 mb-3">สมัครสมาชิกนักวิ่ง</h1>
        <div class="form-floating mb-3">
          <input
            type="text"
            class="form-control"
            id="username"
            placeholder="ชื่อบัญชี"
          />
          <label for="floatingInput">ชื่อบัญชี</label>
        </div>
        <div class="form-floating mb-3">
          <input
            type="email"
            class="form-control"
            id="email"
            placeholder="อีเมล"
          />
          <label for="floatingInput">อีเมล</label>
        </div>
        <div class="form-floating mb-3">
          <input
            type="password"
            class="form-control"
            id="password"
            placeholder="รหัสผ่าน"
          />
          <label for="floatingPassword">รหัสผ่าน</label>
        </div>
        <div class="form-floating">
          <input
            type="password"
            class="form-control"
            id="confirm_password"
            placeholder="ยืนยันรหัสผ่าน"
          />
          <label for="floatingPassword">ยืนยันรหัสผ่าน</label>
        </div>
        <div class="row mb-3">
          <div class="col">
            <button type="button" onclick="runner_create()" class="btn btn-primary w-100 mt-3">
              สมัคร
            </button>
          </div>
          <div class="col">
            <button
              type="button"
              class="btn btn-primary w-100 mt-3"
              onclick="goLogin()"
            >
              เข้าสู่ระบบ
            </button>
          </div>
        </div>
        <div class="row">
          <p>นโยบายความเป็นส่วนตัวของนักวิ่ง</p>
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
  var goLogin = function(){
    window.location.href = "login.php"
  }
  var runner_create =function(){
        const myHeaders = new Headers();
        myHeaders.append("Content-Type", "application/json");

        const raw = JSON.stringify({
          email: document.getElementById("email").value,
          username: document.getElementById("username").value,
          password: document.getElementById("password").value,
          confirm_password: document.getElementById("confirm_password").value,
          role: "runner",
        });

        const requestOptions = {
          method: "POST",
          headers: myHeaders,
          body: raw,
          redirect: "follow",
        };

        fetch(
          "http://localhost/sos/newweb/api/users/create.php",
          requestOptions
        )
          .then((response) => response.text())
          .then((result) => {
            var jsonObj = JSON.parse(result);
            if (jsonObj.status == "ok") {
              alert(jsonObj.message);
              window.location.href="login.php";
            } else {
              alert(jsonObj.message);
            }
          })
          .catch((error) => console.error(error));
      };
</script>