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
  <body onload="user_readone()">
    <div class="container p-4">
      <div class="row text-center mt-3 mb-3">
        <h1>Admin Edit Users</h1>
      </div>
      <form onsubmit="return false">
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

        <button type="button" onclick="user_update()" class="btn btn-primary">
          update
        </button>
      </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>
      // var user =JSON.parse(sessionStorage.getItem('user'));
      // console.log(user)
      // if (user['role'] !== 'admin'){
      //   window.location.href = "index.php"
      // }
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
              window.open("users.php");
            } else {
              alert(jsonObj.message);
            }
          })
          .catch((error) => console.error(error));
      };

      
    </script>
  </body>
</html>
