<?php
include 'dbController.php';

$aid = mysqli_real_escape_string($conn, $_POST['aid']);
$username = mysqli_real_escape_string($conn, $_POST['username']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$cpassword = mysqli_real_escape_string($conn, $_POST['confirm_password']);
$profile_pic = mysqli_real_escape_string($conn, $_FILES['upload']['name']);

$query = mysqli_query($conn, "SELECT * FROM admin_table WHERE aid = '$aid' ");
$fetch = mysqli_fetch_array($query);

$default_pass = $fetch['password'];
$default_pic = $fetch['pic'];

if(empty($profile_pic) ){
    $insert = mysqli_query($conn, "UPDATE `admin_table` SET 
    `pic`='$default_pic' WHERE aid = '$aid' ");
    echo $insert ? 'ok' : 'err';
} else{
    
    $uploadedProfile = '';
    if (!empty($_FILES["upload"]["type"])) {
        $profile = time() . '_' . $_FILES['upload']['name'];
        $valid_extensions = array("jpeg", "jpg", "png");
        $temporary = explode(".", $_FILES["upload"]["name"]);
        $file_extension = end($temporary);
        if ((($_FILES["upload"]["type"] == "image/png") || ($_FILES["upload"]["type"] == "image/jpg") || ($_FILES["upload"]["type"] == "image/jpeg")) && in_array($file_extension, $valid_extensions)) {
            $sourcePath = $_FILES['upload']['tmp_name'];
            $targetPath = "../assets/img/profiles/" . $profile;
            if (move_uploaded_file($sourcePath, $targetPath)) {
                $uploadedProfile = $profile;
            }
        }
    }
    
    $insert = mysqli_query($conn, "UPDATE `admin_table` SET 
    `pic`='$uploadedProfile' WHERE aid='$aid' ");
    echo $insert ? 'ok' : 'err';
}

if(empty($password)){
    $insert = mysqli_query($conn, "UPDATE `admin_table` SET 
    `password`='$default_pass' WHERE aid = '$aid' ");
    echo $insert ? 'ok' : 'err';
} else{
    if($password != $cpassword){
        echo "pass_err";
    } else{
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $insert = mysqli_query($conn, "UPDATE `admin_table` SET 
        `password`='$password_hash' WHERE aid = '$aid' ");
        echo $insert ? 'ok' : 'err';
    }
}

if(!empty($username) || !empty($email)){
    $insert = mysqli_query($conn, "UPDATE `admin_table` SET 
    `username`='$username', `email`='$email' WHERE aid = '$aid' ");
    echo $insert ? 'ok' : 'err';
}