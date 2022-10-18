<?php

include 'dbController.php';

$catname = mysqli_real_escape_string($conn, $_POST['catname']);
$caticon = mysqli_real_escape_string($conn, $_FILES['caticon']['name']);

if(empty($catname) || empty($caticon)){
    echo "required";
} else{
    if(!empty($catname) || !empty($caticon)){
        $filename = $_FILES['caticon']['name'];
        $fileSize = $_FILES['caticon']['size'];
        $tmpName = $_FILES['caticon']['tmp_name'];

        $validImageExtention = ['jpg','jpeg','png'];
        $imageExtention = explode('.',$filename);
        $imageExtention = strtolower(end($imageExtention));

        if(!in_array($imageExtention, $validImageExtention)){
            echo "invalid";
        }elseif($fileSize > 1000000){
            echo "large";
        }else{
            $newImageName = uniqid();
            $newImageName.= "." .$imageExtention;

            move_uploaded_file($tmpName, '../assets/img/caticons/'. $newImageName);
            $query = "INSERT INTO `categories` (`name`, `image`)  VALUES ('$catname', '$newImageName')";
            mysqli_query($conn, $query);
            echo "success";
        }
    }
}
?>