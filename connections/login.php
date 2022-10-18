<?php 
include 'config.php';

session_start();

if (isset($_SESSION['loggedIN'])){
    header('Location: account.php');
}

if (isset($_POST['login'])){
    $email = mysqli_real_escape_string($conn, $_POST['emailPHP']);
    $password = mysqli_real_escape_string($conn, md5($_POST['passwordPHP']));

    $sql = "SELECT jsid FROM job_seekers WHERE email='$email' AND password='$password' ";
    $rs = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($rs);

    if (mysqli_num_rows($rs) > 0){
        $userid = $data['jsid'];
        $_SESSION['userid'] = $userid;
        echo 'Yes';
    } else{
        echo 'No';
    }    
}


?>