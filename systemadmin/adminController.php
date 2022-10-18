<?php
session_start();
include 'config.php';

if (isset($_POST['login'])){
    $email = mysqli_real_escape_string($conn, $_POST['emailPHP']);
    $password = mysqli_real_escape_string($conn, md5($_POST['passwordPHP']));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "email_err";
    } else {
        $sql = "SELECT * FROM admin_table WHERE email='$email' AND password='$password' ";
        $rs = mysqli_query($conn, $sql);
        $data = mysqli_fetch_array($rs);
            
        if (mysqli_num_rows($rs) > 0){
            $userid = $data['aid'];
            $username = $data['username'];
            $_SESSION['aid'] = $userid;
            $_SESSION['username'] = $username;
            echo 'Yes';
        } else{
            echo 'No';
        }    
    }
}




