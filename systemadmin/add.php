<?php 
include "config.php";

$username = mysqli_real_escape_string($conn, $_POST['username']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$access_level = mysqli_real_escape_string($conn, $_POST['access_level']);
$confirm_password =mysqli_real_escape_string($conn, $_POST['confirm_password']);
$password_hash = password_hash($password, PASSWORD_DEFAULT);

if(empty($username) || empty($email) || empty($password) || empty($access_level) || empty($confirm_password)){
    echo "empty";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "invalid email";
} else if($password != $confirm_password){
    echo "mismatch";
} else{
    if(!empty($username) || !empty($email) || !empty($password) || !empty($access_level) || !empty($confirm_password)){
       
        if ($access_level == 2){
            $insert = mysqli_query($conn, "INSERT INTO admin_table (`username`, `email`, `password`, `access_level`, status) VALUES ('$username', '$email', '$password_hash', '2', 'for_approval')");
            echo $insert ? 'ok' : 'err';
        } else{
            $insert = mysqli_query($conn, "INSERT INTO admin_table (`username`, `email`, `password`, `access_level`, status) VALUES ('$username', '$email', '$password_hash', '1', 'allowed')");
            echo $insert ? 'ok' : 'err';
        }
       
    }
}

?>