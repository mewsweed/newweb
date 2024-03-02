<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="/sos/newweb/upload.php" method="post" enctype="multipart/form-data" >
        <input type="file" name="coverimg" id="">
        <input type="file" name="mapimg" id="">
        <input type="file" name="rewardimg" id="">
        <button type="submit">Upload</button>
    </form>
    <form action="">
        <label for="">coverimg path:</label>
        <input type="text" value="<?php echo $_SESSION['coverimg']; ?>">
        <label for="">mapimg path:</label>
        <input type="text" value="<?php echo $_SESSION['mapimg']; ?>">
        <label for="">rewardimg path:</label>
        <input type="text" value="<?php echo $_SESSION['rewardimg']; ?>">
    </form>
</body>
</html>