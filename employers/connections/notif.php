<?php 

include 'config.php';

$sql = "UPDATE apply SET active_status = '1' ";
$rs = mysqli_query($conn, $sql);

if ($rs){
    echo "success";
} else {
    echo "failed";
}


?>