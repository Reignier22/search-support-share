<?php 

session_start();
include 'dbController.php';

$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if (empty($email) || empty($password)){
    echo "empty";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "email_err";
} else{
    if (!empty($email) || !empty($password)){
        $select = "SELECT * FROM admin_table WHERE email='$email' AND access_level IN('1','2') ";
        $rs = mysqli_query($conn, $select);
        $data = mysqli_fetch_array($rs);
    
        if (mysqli_num_rows($rs) > 0){
            $access_level = $data['access_level'];
            $status = $data['status'];
            $username = $data['username'];
            $aid = $data['aid'];
           
            if ($status == 'for_approval'){
                echo "no";
            } else if ($status == 'disabled'){
                echo "disabled";
            } else if (password_verify($password, $data['password'])){
                echo "yes";
                $_SESSION['username'] =$username;
                $_SESSION['aid'] = $aid;
                $_SESSION['access_level'] = $access_level;

                $activity = $username. " logged in to the system";
                date_default_timezone_set('Asia/Manila'); 
                $date = date('Y-m-d H:i:s');
                $insert_query = mysqli_query($conn, "INSERT INTO `audit` (`aid`, `activity`, `date`) VALUES ('$aid', '$activity', '$date')");

            } else{
                echo "err";
            }
        }       
    } else{
        echo "None";
    }
}

?>