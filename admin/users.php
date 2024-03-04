<?php session_start();
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

    <link href="https://fonts.googleapis.com/css2?family=Black+Ops+One&family=Pixelify+Sans&family=Poppins:ital,wght@0,400;1,300&family=Roboto:wght@100&family=Source+Code+Pro:wght@300;400;500;600;800&family=Young+Serif&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <title>ADMIN</title>
  </head>

  <body onload="users_read()">
  <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
    <a
      href="/sos/newweb/index.php"
      class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none"
    >
      <svg class="bi me-2" width="40" height="32">
        <use xlink:href="#bootstrap"></use>
      </svg>
      <span class="fs-4">แอดมิน</span>
    </a>

    <ul class="nav nav-pills">
      <li class="nav-item">
        <a
          href="/sos/newweb/index.php"
          class="nav-link "
          aria-current="page"
          >หน้าแรก</a
        >
      </li>
      <li class="nav-item ">
        <a href="/sos/newweb/admin/users.php" class="nav-link active">บัญชีผู้ใช้</a>
      </li>
      <li class="nav-item">
        <a href="/sos/newweb/admin/event.php" class="nav-link">กิจกรรมงานวิ่ง</a>
      </li>
      <li class="nav-item">
        <a href="/sos/newweb/api/logout.php" class="nav-link">ลงชื่อออก</a>
      </li>
    </ul>
  </header>

    <div class="container p-4">
      <div class="row text-center mt-3">
        <h2>All Users</h2>
        
    <h3>Email : <?php echo $_SESSION['email'] ?></h3>
      </div>
      <div class="row mb-3">
        <button
          type="button"
          class="btn btn-primary"
          onclick="window.open('create_user.php')"
        >
          Create User
        </button>
      </div>
      <div class="row">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">role</th>
              <th scope="col">Username</th>
              <th scope="col">@Email</th>
              <th scope="col">manage</th>
            </tr>
          </thead>
          <tbody id="users_table"></tbody>
        </table>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>
<script>
  var users_read = function () {
    const requestOptions = {
      method: "GET",
      redirect: "follow",
    };
    var users_table = document.getElementById("users_table");
    users_table.innerHTML = "loading...";
    fetch("http://localhost/sos/newweb/api/users/read.php", requestOptions)
      .then((response) => response.text() )
      .then((result) => {
        users_table.innerHTML = "";
        var jsonObj = JSON.parse(result);
        for (let user of jsonObj) {
          var row =
            `
                <tr>
                  <td scope="col">` + user.id +`</td>
                  <td scope="col">` + user.role +`</td>
                  <td scope="col">` + user.username +`</td>
                  <td scope="col">` + user.email +`</td>
                  <td scope="col">
                    <a href="edit_user.php?id=` +user.id +`" class="m-1">Edit</a>
                    <a href="#" onclick="users_delete(`+user.id+`)">Del</a>
                  </td>
                </tr>
            `;
          users_table.insertAdjacentHTML("beforeend", row);
        }
      })
      .catch((error) => console.error(error));
  };

  var users_delete =function(id){
    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");

    const raw = JSON.stringify({
      "id": id
    });

    const requestOptions = {
      method: "DELETE",
      headers: myHeaders,
      body: raw,
      redirect: "follow"
    };

    fetch("http://localhost/sos/newweb/api/users/delete.php", requestOptions)
      .then((response) => response.text())
      .then((result) => {
        var jsonObj =JSON.parse(result);
        if (jsonObj.status == "ok"){
          alert("ok");
          window.location.href = "users.php"
        }
      })
      .catch((error) => console.error(error));
      }
</script>
