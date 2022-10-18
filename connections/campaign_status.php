<?php 
include 'config.php';
            
if(isset($_POST['view_btn'])){
    $donate_id =  $_POST['donate_id'];
    $result_array = [];
    
    $donation = "SELECT campaigns.project_title AS pt,
    donations.amount, donations.message, donations.name, donations.ref 
    FROM donations 
    INNER JOIN campaigns ON campaigns.cid = donations.cid WHERE did = $donate_id";  
    $rs = mysqli_query($conn, $donation);
    
    if(mysqli_num_rows($rs) > 0) {
        foreach($rs as $donaterow) {
            array_push($result_array, $donaterow);
            header('Content-type: application/json');
            echo json_encode($result_array); 
        }
    }    
    else {
        echo $return = "<h5>No Records found </h5>";
    }
    
}
    
?>