<?php 
include "dbController.php";

$username = mysqli_real_escape_string($conn, $_POST['username']);
$apply_email = mysqli_real_escape_string($conn, $_POST['apply_email']);
$apply_password = mysqli_real_escape_string($conn, $_POST['apply_password']);
$confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

if(empty($username) || empty($apply_email) || empty($apply_password) || empty($confirm_password)){
    echo "empty_fields";
} else if (!filter_var($apply_email, FILTER_VALIDATE_EMAIL)){
    echo "inv_email";
} else if ($apply_password != $confirm_password){
    echo "mismatch";
} else{
    $password_hash = password_hash($apply_password, PASSWORD_DEFAULT);
    if(!empty($username) || !empty($apply_email) || !empty($apply_password) || !empty($confirm_password)){
        $insert = mysqli_query($conn, "INSERT INTO admin_table (`username`, `email`, `password`, `access_level`, status) VALUES ('$username', '$apply_email', '$password_hash', '2', 'for_approval')");
        echo $insert ? 'ok' : 'err';
    }
}


?>