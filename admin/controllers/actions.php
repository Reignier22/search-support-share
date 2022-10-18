<?php 
include 'dbController.php';

if(isset($_POST['log_btn'])){
    $uname = mysqli_real_escape_string($conn, $_POST['uname']);
    $aid_log = mysqli_real_escape_string($conn, $_POST['aid_log']);
    $activity = $uname. " logged out of the system";
    date_default_timezone_set('Asia/Manila'); 
    $date = date('Y-m-d H:i:s');
    
    $insert_query = mysqli_query($conn, "INSERT INTO `audit` (`aid`, `activity`, `date`) VALUES ('$aid_log', '$activity', '$date')");
}

if(isset($_POST['notif_btn'])){
    $update_notif = mysqli_query($conn, "UPDATE `audit` SET `status`='0' ");
}

if(isset($_POST['update_cat'])){
    $catid = mysqli_real_escape_string($conn, $_POST['catid']);
    $name = mysqli_real_escape_string($conn, $_POST['catnamed']);
    $caticons = mysqli_real_escape_string($conn, $_FILES['caticons']['name']);
    
    $query_icon = mysqli_query($conn, "SELECT * FROM categories WHERE catid = '$catid' ");
    $fetch_icon = mysqli_fetch_array($query_icon);
    $icon = $fetch_icon['image'];
    
    if(empty($caticons)){
        $update_query = "UPDATE categories SET name='$name', image='$icon' WHERE catid='$catid' ";
        $run_query = mysqli_query($conn, $update_query);
        if($run_query){
            echo "Yes";

            $activity = $uname_upadater . " updated " . $name;
            $uname_upadater = mysqli_real_escape_string($conn, $_POST['uname_upadater']);
            $aid_upadater = mysqli_real_escape_string($conn, $_POST['aid_upadater']);
            date_default_timezone_set('Asia/Manila'); 
            $date = date('Y-m-d H:i:s'); 

            $insert_query = mysqli_query($conn, "INSERT INTO `audit` (`aid`, `activity`, `date`) VALUES ('$aid_upadater', '$activity', '$date')");
        } else{
            echo "No";
        }
    } else{
        if(!empty($name) || !empty($caticons)){
            $filename = $_FILES['caticons']['name'];
            $fileSize = $_FILES['caticons']['size'];
            $tmpName = $_FILES['caticons']['tmp_name'];
    
            $validImageExtention = ['jpg','jpeg','png'];
            $imageExtention = explode('.',$filename);
            $imageExtention = strtolower(end($imageExtention));
    
            if(!in_array($imageExtention, $validImageExtention)){
                echo "invalid";
            }elseif($fileSize > 1000000){
                echo "large";
            }else{
                $newImageName = uniqid();
                $newImageName.= "." .$imageExtention;
    
                move_uploaded_file($tmpName, '../assets/img/caticons/'. $newImageName);
                $query = "UPDATE `categories` SET `name`='$name', `image`='$newImageName' WHERE catid='$catid' ";
                mysqli_query($conn, $query);

                $uname_upadater = mysqli_real_escape_string($conn, $_POST['uname_upadater']);
                $activity = $uname_upadater . " updated " . $name;
                $aid_upadater = mysqli_real_escape_string($conn, $_POST['aid_upadater']);
                date_default_timezone_set('Asia/Manila'); 
                $date = date('Y-m-d H:i:s'); 
    
                $insert_query = mysqli_query($conn, "INSERT INTO `audit` (`aid`, `activity`, `date`) VALUES ('$aid_upadater', '$activity', '$date')");
                echo "success";
            }
        }
    }

}

 if(isset($_POST['allow_btn'])){
    $aid_allow = $_POST['aid_allow'];

    $aid_allow_query = "UPDATE admin_table SET status='allowed' WHERE aid = $aid_allow";
    $aaqrs = mysqli_query($conn, $aid_allow_query);

    if($aaqrs){
        echo "User has been granted access to admin account";
    } else{
        echo "Some error occured";
    }
 }

 if(isset($_POST['disable_btn'])){
    $aid_disable = $_POST['aid_disable'];

    $aid_disable_query = "UPDATE admin_table SET status='disabled' WHERE aid = $aid_disable";
    $adqrs = mysqli_query($conn, $aid_disable_query);

    if($adqrs){
        echo "User access to admin account has been disabled";
    } else{
        echo "Some error occured";
    }
 }

 if(isset($_POST['del_btn'])){
    $catid = $_POST['catid'];

    $del_query = "DELETE FROM `categories` WHERE catid = $catid";
    $dqrs = mysqli_query($conn, $del_query);

    if($dqrs){
        echo "delete";
    } else{
        echo "Some error occured";
    }
 }

 if(isset($_GET['catid'])){
    $catid = mysqli_real_escape_string($conn, $_GET['catid']);
    $query = "SELECT * FROM categories WHERE catid = '$catid' ";
    $query_run = mysqli_query($conn, $query);

    if(mysqli_num_rows($query_run) == 1){
        $category = mysqli_fetch_array($query_run);
        $res = [
            'status' => 200,
            'message' => 'Student fetched successfully',
            'data' => $category
        ];
        echo json_encode($res);
        return false;
    } else{
        $res = [
            'status' => 422,
            'message' => 'Category ID not found'
        ];
        echo json_encode($res);
        return false;
    }

 }

 if(isset($_POST['view_btn'])){
    $conid =  mysqli_real_escape_string($conn, $_POST['conid']); 
    $result_array = [];
    
    $message = "SELECT * FROM contact WHERE con_id = $conid";  
    $rs = mysqli_query($conn, $message);
    
    if(mysqli_num_rows($rs) > 0) {
        foreach($rs as $msgrow) {
            array_push($result_array, $msgrow);
            header('Content-type: application/json');
            echo json_encode($result_array); 
        }
        $sql = mysqli_query($conn, "UPDATE contact SET status='0' WHERE con_id=$conid");
    }    
    else {
        echo $return = "<h5>No Records found </h5>";
    }
    
}

if(isset($_POST['resolve_btn'])){
    $repid = mysqli_real_escape_string($conn, $_POST['rep_id']);
    $update_rep = mysqli_query($conn, "UPDATE reports SET status='resolved' WHERE rid = '$repid' ");
    if($update_rep){
        echo "updatedrep";
    } else{
        echo "errupdate";
    }
}

if(isset($_POST['resolve1_btn'])){
    $repid = mysqli_real_escape_string($conn, $_POST['rptid']);
    $update_rep1 = mysqli_query($conn, "UPDATE reports SET status='resolved' WHERE rid = '$repid' ");
    if($update_rep1){
        echo "updatedrep1";
    } else{
        echo "errupdate1";
    }
}

if(isset($_POST['terminate_btn'])){
    $repid1 = mysqli_real_escape_string($conn, $_POST['repid']);
    $cidter = mysqli_real_escape_string($conn, $_POST['cidter']);
    $update_repid = mysqli_query($conn, "UPDATE reports SET status='terminated' WHERE rid = '$repid1' ");
    $update_cidter = mysqli_query($conn, "UPDATE campaigns set display='not_visible' WHERE cid='$cidter'");

    if($update_repid || $update_cidter){
        echo "updatedrep";
    } else{
        echo "errupdate";
    }
}

if(isset($_POST['terminate1_btn'])){
    $rptid1 = mysqli_real_escape_string($conn, $_POST['rptid1']);
    $jobidter = mysqli_real_escape_string($conn, $_POST['jobidter']);
    $update_rptid1 = mysqli_query($conn, "UPDATE reports SET status='terminated' WHERE rid = '$rptid1' ");
    $update_jobidter = mysqli_query($conn, "UPDATE jobs set display='not_visible' WHERE jobid='$jobidter'");

    if($update_rptid1 || $update_jobidter){
        echo "updatedrep";
    } else{
        echo "errupdate";
    }
}


?>