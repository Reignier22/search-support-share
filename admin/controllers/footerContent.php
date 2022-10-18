<?php
include "dbController.php";

$cnum = mysqli_real_escape_string($conn, $_POST['cnum']);
$tnum  = mysqli_real_escape_string($conn, $_POST['tnum']);
$email_add = mysqli_real_escape_string($conn, $_POST['eadd']);
$add = mysqli_real_escape_string($conn, $_POST['addr']);

if(!empty($cnum) || !empty($tnum) || !empty($email_add) || !empty($add) ){
    $insert = mysqli_query($conn, "UPDATE `content_manage` SET 
    `cnumber`='$cnum', `tnumber`='$tnum', `email_add`='$email_add', `address`='$add' ");
    echo $insert ? 'ok' : 'err';
}