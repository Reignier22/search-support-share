<?php
include 'config.php';

$ei = mysqli_real_escape_string($conn, $_POST['ei']);
$cp = mysqli_real_escape_string($conn, $_FILES['cp']['name']);
$cn = mysqli_real_escape_string($conn, $_POST['cn']);
$em = mysqli_real_escape_string($conn, $_POST['em']);
$ps = mysqli_real_escape_string($conn, $_POST['ps']);
$cnb = mysqli_real_escape_string($conn, $_POST['cnb']);
$cl = mysqli_real_escape_string($conn, $_POST['cl']);
$cps = mysqli_real_escape_string($conn, $_POST['cps']);

$query = mysqli_query($conn, "SELECT * FROM employers WHERE empid='$ei' ");
$fetch = mysqli_fetch_array($query);
$fetchPic = $fetch['com_profile'];
$fetchPass = $fetch['password'];
$fetchLoc = $fetch['company_loc'];


if(empty($cp)){
    $update = mysqli_query($conn, "UPDATE `employers` SET `com_profile`='$fetchPic' WHERE empid='$ei' ");
    echo $update? 'ok' : 'err';
} else{
    $filename = $cp;
    $fileSize = $_FILES['cp']['size'];
    $tmpName = $_FILES['cp']['tmp_name'];

    $validImageExtention = ['jpg','jpeg','png'];
    $imageExtention = explode('.',$filename);
    $imageExtention = strtolower(end($imageExtention));

    if(!in_array($imageExtention, $validImageExtention)){
        echo "invalid";
    }elseif($fileSize > 100000){
        echo "large";
    }else{
        $newImageName = uniqid();
        $newImageName.= "." .$imageExtention;

        move_uploaded_file($tmpName, '../assets/profile/'. $newImageName);
        $update = mysqli_query($conn, "UPDATE `employers` SET `com_profile`='$newImageName' WHERE empid = '$ei' ");
        echo $update? 'ok' : 'err';
    }
}

if(empty($ps)){
    $update = mysqli_query($conn, "UPDATE `employers` SET `password`='$fetchPass' WHERE empid='$ei' ");
    echo $update? 'ok' : 'err';
} else {
    if($ps != $cps){
        echo "mismatch";
    } else{
        $encpass = md5($ps);
        $update = mysqli_query($conn, "UPDATE `employers` SET `password`='$encpass' WHERE empid='$ei' ");
        echo $update? 'ok' : 'err';
    }
}

if(empty($cl)){
    $update = mysqli_query($conn, "UPDATE `employers` SET `company_loc`= NULL WHERE empid='$ei' ");
    echo $update? 'ok' : 'err';
} else {
    $update = mysqli_query($conn, "UPDATE `employers` SET `company_loc`='$cl' WHERE empid='$ei' ");
    echo $update? 'ok' : 'err';
}

if(!empty($cn) || !empty($em) || !empty($cnb)){
    $update = mysqli_query($conn, "UPDATE `employers` SET `company_name`='$cn', `contact_number`='$cn', `email`='$em' WHERE empid='$ei'  ");
    echo $update? 'ok' : 'err';
}

