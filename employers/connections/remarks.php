<?php 

include "config.php";

if(isset($_POST['approve'])){
    $empid = mysqli_real_escape_string($conn, $_POST['empidPHP']);
    $appid = mysqli_real_escape_string($conn, $_POST['appidPHP']);
    $remarks = mysqli_real_escape_string($conn, $_POST['remarkPHP']);
    $message = mysqli_real_escape_string($conn, $_POST['messagePHP']);
    $message_output = nl2br($message);
    $date = date('Y-m-d');

    $sql = "UPDATE `apply` SET `empid`='$empid', `status` = 'approved', `remarks`='$remarks',`message`='$message_output',`feedback_status`='1', `date_approved` = '$date' WHERE appid = '$appid' ";
    $rs = mysqli_query($conn, $sql);

    if($rs){
        echo "Yes";
    } else{
        echo "No";
    }

}

if(isset($_POST['shortlist'])){
    $empid = mysqli_real_escape_string($conn, $_POST['empidPHP']);
    $appid = mysqli_real_escape_string($conn, $_POST['appidPHP']);
    $remarks = mysqli_real_escape_string($conn, $_POST['remarkPHP']);
    $smessage = mysqli_real_escape_string($conn, $_POST['smessagePHP']);
    $smessage_output = nl2br($smessage);
    $date = date('Y-m-d');

    $sql = "UPDATE `apply` SET `empid`='$empid', `status` = 'short-listed', `remarks`='$remarks',`message`='$smessage_output',`feedback_status`='1', `date_approved` = '$date' WHERE appid = '$appid' ";
    $rs = mysqli_query($conn, $sql);

    if($rs){
        echo "Yes";
    } else{
        echo "No";
    }
}

if(isset($_POST['disapprove'])){
    $empid = mysqli_real_escape_string($conn, $_POST['empidPHP']);
    $appid = mysqli_real_escape_string($conn, $_POST['appidPHP']);
    $remarks = mysqli_real_escape_string($conn, $_POST['remarkPHP']); 
    $dmessage = mysqli_real_escape_string($conn, $_POST['dmessagePHP']);
    $dmessage_output = nl2br($dmessage);
    $date = date('Y-m-d');

    $sql = "UPDATE `apply` SET `empid`='$empid', `status` = 'disapproved', `remarks`='$remarks',`message`='$dmessage_output',`feedback_status`='1', `date_approved` = '$date' WHERE appid = '$appid' ";
    $rs = mysqli_query($conn, $sql);

    if($rs){
        echo "Yes";
    } else{
        echo "No";
    }
}



?>