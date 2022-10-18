<?php
include 'config.php';

if(isset($_POST['delete_acc'])){
    $jsid = mysqli_real_escape_string($conn, $_POST['jsid']);
    $del_query = mysqli_query($conn, "DELETE from `job_seekers` WHERE jsid='$jsid'");
    if($del_query){
        echo "Thank you for being part of 3S Search Support and Share. Your account has been deleted.";
    } else{
        echo "Error while deleting your account. Please try again";
    }
}

if(isset($_POST['save_btn'])){
    $jsid = mysqli_real_escape_string($conn, $_POST['jsid']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
    $query_pass = mysqli_query($conn, "SELECT password FROM job_seekers WHERE jsid='$jsid' ");
    $fetch_pass = mysqli_fetch_array($query_pass);
    $get_pass = $fetch_pass['password'];

    if(empty($password)){
        $query = mysqli_query($conn, "UPDATE job_seekers SET `email`='$email', `password`='$get_pass', `username`='$username' WHERE jsid='$jsid' ");
        if($query){
            echo "Login details has been updated successfully";
        } else{
            echo "Error. Please try again";
        }
    } else{
        if($password != $cpassword){
            echo "Password mismatched. Please try again";
        } else{
            $insert_pass = md5($password);
            $query = mysqli_query($conn, "UPDATE job_seekers SET `email`='$email', `password`='$insert_pass', `username`='$username' WHERE jsid='$jsid' ");
            if($query){
                echo "Login details has been updated successfully";
            } else{
                echo "Error. Please try again";
            }
        }
    }
    
}

if(isset($_POST['allow_btn_1'])){
    $jsid_allow =  mysqli_real_escape_string($conn,$_POST['jsid_allow']);
    $jsid_allow_query = "UPDATE job_seekers SET status='available' WHERE jsid = $jsid_allow";
    $aaqrs = mysqli_query($conn, $jsid_allow_query);

    if($aaqrs){
        echo "You are now available for job offers. We will notify you once the employer send a job offer to you.";
    } else{
        echo "Some error occured";
    }
}

    if(isset($_POST['allow_btn'])){
        $jsid_allow =  mysqli_real_escape_string($conn,$_POST['jsid_allow']);
        $classification = mysqli_real_escape_string($conn, $_POST['classification']);
        $other =  mysqli_real_escape_string($conn, $_POST['other']);

        if($other == NULL){
                $jsid_allow_query = "UPDATE job_seekers SET status='available', disability='$classification' WHERE jsid = $jsid_allow";
                $aaqrs = mysqli_query($conn, $jsid_allow_query);
            
                if($aaqrs){
                    echo "You are now available for job offers. We will notify you once the employer send a job offer to you.";
                } else{
                    echo "Some error occured";
                }
            } else{
                $jsid_allow_query = "UPDATE job_seekers SET status='available', disability='$other' WHERE jsid = $jsid_allow";
                $aaqrs = mysqli_query($conn, $jsid_allow_query);
            
                if($aaqrs){
                    echo "You are now available for job offers. We will notify you once the employer send a job offer to you.";
                } else{
                    echo "Some error occured";
                }
            }
    }

 if(isset($_POST['disable_btn'])){
    $jsid_disable = $_POST['jsid_disable'];

    $jsid_disable_query = "UPDATE job_seekers SET status='unavailable' WHERE jsid = $jsid_disable";
    $adqrs = mysqli_query($conn, $jsid_disable_query);

    if($adqrs){
        echo "You are now unavailable for job offers.";
    } else{
        echo "Some error occured";
    }
 }

 if(isset($_POST['cancel_btn'])){
    $cancel_id = mysqli_real_escape_string($conn, $_POST['appid']);
    $update = mysqli_query($conn, "UPDATE apply SET status='cancelled' WHERE appid='$cancel_id' ");
    if($update){
        echo "Your application has been cancelled.";
    } else{
        echo "Some error occured.";
    }
 }

 if(isset($_POST['del_btn'])){
    $del_id = mysqli_real_escape_string($conn, $_POST['del_id']);
    $delete = mysqli_query($conn, "DELETE FROM `apply` WHERE appid='$del_id' ");
    if($delete){
        echo "Your application has been deleted.";
    } else{
        echo "Some error occured.";
    }
 }


