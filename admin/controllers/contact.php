<?php
include 'dbController.php';

$line1 = mysqli_real_escape_string($conn, $_POST['line1']);
$line2 = mysqli_real_escape_string($conn, $_POST['line2']);

if(!empty($line1) || !empty($line2)){
    $insert = mysqli_query($conn, "UPDATE `content_manage` SET `line_1`='$line1', `line_2`='$line2' ");
    echo $insert ? 'ok' : 'err';
}
