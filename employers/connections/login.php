<?php
include('config.php');

$logEmail = mysqli_real_escape_string($conn, $_POST['log_email']);
$logPass = mysqli_real_escape_string($conn, md5($_POST['log_password']));

$query = mysqli_query($conn, "SELECT * FROM `employers` WHERE `email`='$logEmail' ");
$fetch = mysqli_fetch_array($query);

if(mysqli_num_rows($query) > 0){

    $fetchPass = $fetch['password'];
    $fetchStatus = $fetch['status'];

    $id = $fetch["empid"];
    $company = $fetch["company_name"];

    if($fetchStatus == '0'){
        echo "Please verify your email first.";
    }
    else if($logPass != $fetchPass){
        echo "Password is incorrect. Please try again.";
    } 
    else{
        session_start();

        $_SESSION['empid'] = $id;
        echo "Yes";       
    }

} else{
    echo "No email found. Please register first.";
}

?>