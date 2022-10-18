<?php 
include 'dbController.php';

//FACEBOOK//

    if(isset($_POST['fb_btn'])){
        $fb_link = $_POST['fbLink'];

        $query = "UPDATE url_tbl SET `url`='$fb_link', `display`='show' WHERE uid = '1' ";
        $fbrs = mysqli_query($conn, $query);

        if($fbrs){
            echo "Facebook link is now visible.";
        } else{
            echo "Some error occured";
        }
    }

    if(isset($_POST['fb_disable_btn'])){
        $fb_link = $_POST['fb_disable'];

        $query = "UPDATE url_tbl SET `url`='$fb_link', `display`='hidden' WHERE uid = '1' ";
        $fbrs = mysqli_query($conn, $query);

        if($fbrs){
            echo "Facebook link has been hidden";
        } else{
            echo "Some error occured";
        }
    }

//FACEBOOK-END//

//TWITTER//
    if(isset($_POST['tw_btn'])){
        $tw_link = $_POST['twLink'];

        $queryA = "UPDATE url_tbl SET `url`='$tw_link', `display`='show' WHERE uid = '2' ";
        $twrs = mysqli_query($conn, $queryA);

        if($twrs){
            echo "Twitter link is now visible.";
        } else{
            echo "Some error occured";
        }
    }

    if(isset($_POST['tw_disable_btn'])){
        $tw_link = $_POST['tw_disable'];

        $queryA = "UPDATE url_tbl SET `url`='$tw_link', `display`='hidden' WHERE uid = '2' ";
        $twrs = mysqli_query($conn, $queryA);

        if($twrs){
            echo "Twitter link has been hidden";
        } else{
            echo "Some error occured";
        }
    }

//TWITTER-END// 

//INSTAGRAM//
 if(isset($_POST['in_btn'])){
    $in_link = $_POST['inLink'];

    $queryB = "UPDATE url_tbl SET `url`='$in_link', `display`='show' WHERE uid = '3' ";
    $inrs = mysqli_query($conn, $queryB);

    if($inrs){
        echo "Instagram link is now visible.";
    } else{
        echo "Some error occured";
    }
 }

 if(isset($_POST['in_disable_btn'])){
    $in_link = $_POST['in_disable'];

    $queryB = "UPDATE url_tbl SET `url`='$in_link', `display`='hidden' WHERE uid = '3' ";
    $inrs = mysqli_query($conn, $queryB);

    if($inrs){
        echo "Instagram link has been hidden";
    } else{
        echo "Some error occured";
    }
 }
//INSTAGRAM-END//

//TIKTOK//
    if(isset($_POST['tk_btn'])){
        $tk_link = $_POST['tkLink'];

        $queryD = "UPDATE url_tbl SET `url`='$tk_link', `display`='show' WHERE uid = '4' ";
        $tkrs = mysqli_query($conn, $queryD);

        if($tkrs){
            echo "Tiktok link is now visible.";
        } else{
            echo "Some error occured";
        }
    }

    if(isset($_POST['tk_disable_btn'])){
        $tk_link = $_POST['tk_disable'];

        $queryD = "UPDATE url_tbl SET `url`='$tk_link', `display`='hidden' WHERE uid = '4' ";
        $tkrs = mysqli_query($conn, $queryD);

        if($tkrs){
            echo "Tiktok link has been hidden";
        } else{
            echo "Some error occured";
        }
    }
//TIKTOK-END// 

//Youtube//
    if(isset($_POST['yt_btn'])){
        $yt_link = $_POST['ytLink'];

        $queryE = "UPDATE url_tbl SET `url`='$yt_link', `display`='show' WHERE uid = '5' ";
        $ytrs = mysqli_query($conn, $queryE);

        if($ytrs){
            echo "Youtube link is now visible.";
        } else{
            echo "Some error occured";
        }
    }

    if(isset($_POST['yt_disable_btn'])){
        $yt_link = $_POST['yt_disable'];

        $queryE = "UPDATE url_tbl SET `url`='$yt_link', `display`='hidden' WHERE uid = '5' ";
        $ytrs = mysqli_query($conn, $queryE);

        if($ytrs){
            echo "Youtube link has been hidden";
        } else{
            echo "Some error occured";
        }
    }
//Youtube-END// 
