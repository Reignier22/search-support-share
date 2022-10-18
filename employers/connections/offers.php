<?php

include 'config.php';

if(isset($_GET['jsid'])){
    $jsid = mysqli_real_escape_string($conn, $_GET['jsid']);
    $query = "SELECT * FROM job_seekers WHERE jsid='$jsid' ";
    $query_run = mysqli_query($conn, $query);

    if(mysqli_num_rows($query_run) == 1){
        $report = mysqli_fetch_array($query_run);
        $res = [
            'status' => 200,
            'message' => 'Report fetched successfully',
            'data' => $report
        ];
        echo json_encode($res);
        return false;

    } else{
        $res = [
            'status' => 422,
            'message' => 'Report ID not found'
        ];
        echo json_encode($res);
        return false;
    }

 }

 if(isset($_POST['offer_btn'])){
    $jbskid = mysqli_real_escape_string($conn, $_POST['jbskid']);
    $empid = mysqli_real_escape_string($conn, $_POST['empid']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $message_insert = nl2br($message);

    $name = mysqli_query($conn, "SELECT first_name, middle_name, last_name FROM job_seekers WHERE jsid = '$jbskid' ");
    $fetch = mysqli_fetch_array($name);

    $insert = mysqli_query($conn, "INSERT INTO `job_offers` (`jsid`, `empid`, `message`) VALUES ('$jbskid','$empid','$message_insert')");

    if($insert){
        echo "Your job offer has been successfully sent to " . $fetch['first_name']. " " . $fetch['middle_name']. " " . $fetch['last_name'];  
    } else{
        echo "Job offer not sent because some error occured";
    }

 }