!<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container text-center">
        <div class="row mt-3 mb-2 p-4 border-bottom border-2 border-dark">
            <h1>Which Role do you want?</h1>
        </div>
        <div class="row p-4">
            <div class="col ">
                <h2 class="mb-3">RUNNER</h2>
                <button type="button" onclick="goRegisterRunner()" class="btn btn-primary">Click</button>
            </div>
            <div class="col">
                <h2 class="mb-3">ORGANIZER</h2>
                <button type="button" onclick="goRegisterOrganizer()" class="btn btn-primary">Click</button>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
<script>
    var goRegisterRunner = function(){
        window.location.href = "runnerregister.php"
    }
    var goRegisterOrganizer = function(){
        window.location.href = "organizerregister.php"
    }
</script>