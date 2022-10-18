<?php 
include "config.php";

$contact_name = mysqli_real_escape_string($conn, $_POST['contact_name']);
$contact_email = mysqli_real_escape_string($conn, $_POST['contact_email']);
$contact_message = mysqli_real_escape_string($conn, $_POST['contact_message']);

if(empty($contact_name) || empty($contact_email) || empty($contact_message)){
    echo "empty";
} else{
    if(!empty($contact_name) || !empty($contact_email) || !empty($contact_message)){
        $insert = mysqli_query($conn, "INSERT INTO contact (`full_name`, `con_email`, `con_mess`, `status`) VALUES ('$contact_name', '$contact_email', '$contact_message', '1')");
        echo $insert ? 'ok' : 'err';
    }
}

?>