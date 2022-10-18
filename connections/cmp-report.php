<?php
include 'config.php';

$rp_cid = mysqli_real_escape_string($conn, $_POST['rp_cid']);
$reason = mysqli_real_escape_string($conn, $_POST['reason']);
$other_reason = mysqli_real_escape_string($conn, $_POST['other_reason']);

$query = mysqli_query($conn, "SELECT * FROM reports WHERE cid='$rp_cid'");

if(mysqli_num_rows($query) > 0){

    if($reason == 'Other reasons'){
        $update = mysqli_query($conn, "UPDATE `reports` SET `reason`= CONCAT(`reason`, ', $other_reason'), `no_rp`= `no_rp` + 1,  `status`='reported' WHERE cid='$rp_cid' ");
        echo $update ? 'ok' : 'err';
    } else{
        $update = mysqli_query($conn, "UPDATE `reports` SET `reason`= CONCAT(`reason`, ', $reason'), `no_rp`= `no_rp` + 1, `status`='reported' WHERE cid='$rp_cid' ");
        echo $update ? 'ok' : 'err';
    }
}

else {

    if($reason == 'Other reasons'){ 
        $insert = mysqli_query($conn, "INSERT INTO `reports`(`cid`, `reason`, `no_rp`, `status`) VALUES ('$rp_cid', '$other_reason', 1, 'reported')");
        echo $insert ? 'ok' : 'err';
    } else{
        $insert = mysqli_query($conn, "INSERT INTO `reports`(`cid`, `reason`, `no_rp`, `status`) VALUES ('$rp_cid', '$reason', 1, 'reported')");
        echo $insert ? 'ok' : 'err';
    }

}


