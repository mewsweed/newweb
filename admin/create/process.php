<?php
include('/xampp/htdocs/sos/newweb/api/server.php');

if (isset($_FILES['cover'])){
    $target_dir = "../../uploads/";
    $coverUrl = uniqid() . "_" . basename($_FILES['cover']['name']);
    $target_file = $target_dir . $coverUrl;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["cover"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadcoverOk = 1;
        } else {
            echo "File is not an image.";
            $uploadcoverOk = 0;
        }
    }
    if ($_FILES["cover"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadcoverOk = 0;
    }
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadcoverOk = 0;
    }
    if($uploadcoverOk == 0){
        echo "Sorry, your coverimg was not uploaded.";
    }else{
        
    }
}
if (isset($_FILES['map'])){}
if (isset($_FILES['reward'])){}