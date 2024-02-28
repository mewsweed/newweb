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
        <h1>Admin Create Users</h1>
      </div>
      <form onsubmit="return false">
        <div class="form-floating mb-3">
          <input type="email" class="form-control" id="email" placeholder="name@example.com">
          <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="username" placeholder="username">
          <label for="floatingInput">Username</label>
        </div>
        <div class="form-floating mb-3">
          <input type="password" class="form-control" id="password" placeholder="password">
          <label for="floatingInput">Password</label>
        </div>
        <div class="form-floating mb-3">
          <input type="password" class="form-control" id="confirm_password" placeholder="confirm_password">
          <label for="floatingInput">Confirm_password</label>
        </div>
        <!-- <div class="form-group form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1" />
          <label class="form-check-label" for="exampleCheck1">Accept </label>
        </div> -->
        <button type="button" onclick="user_create()" class="btn btn-primary">
          Create
        </button>
      </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
      var user_create = function () {
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
              window.open("users.html");
            } else {
              alert(jsonObj.message);
            }
          })
          .catch((error) => console.error(error));
      };
    </script>
  </body>
</html>
