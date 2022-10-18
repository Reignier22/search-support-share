<?php
include "connections/config.php";
error_reporting(0);

session_start();
if(!ISSET($_SESSION['empid'])){
    header('location:index.php');    
}

$query = mysqli_query($conn, "SELECT * FROM `employers` WHERE `empid`='$_SESSION[empid]'");
$fetch = mysqli_fetch_array($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, minimun-scale=1">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico"/>
    <title>
         <?php
            if(isset($page_title)){echo "$page_title"; }
        ?>
    </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/lineawesome/css/line-awesome.min.css" >
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="assets/css/emp_profile.css">
</head>
<body>

<input type="checkbox" name="" id="sidebar-toggle">

<div class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-flex">
        <?php 
            $fetch_query1 = mysqli_query($conn, "SELECT logo FROM content_manage");
            $fetch_logo = mysqli_fetch_array($fetch_query1);  
        ?>
            <span><img src="../assets/home-plugins/img/<?= $fetch_logo['logo'] ?>"  width="50px" alt="system logo" >
               Search Support & Share
            </span>
        </div>
    </div>

    <div class="sidebar-main">

        <div class="sidebar-user">
            <?php 
                if($fetch['com_profile'] == 'company_default.png'){
                    ?>
                        <img src="assets/Images/company_default.png" alt="company logo">
                    <?php
                } else{
                    ?>
                        <img src="assets/profile/<?= $fetch['com_profile'] ?>" alt="company logo">
                    <?php
                }
            ?>
            
            <div>
                <h3> <?php echo $fetch['company_name']; ?></h3>
                <span><?php echo $fetch['email']; ?></span>
            </div>
        </div>

        <div class="sidebar-menu">
            <div class="menu-head">
                <span>Dashboard</span>
            </div>
            <ul>
                <li >
                    <a href="employer_profile.php" class="<?php if ($page_title == 'Employer | Profile Page'){echo 'active';} ?>">
                        <span class="las la-suitcase"></span>
                        Jobs
                    </a>
                </li>
                <li>
                    <a href="applicants.php" class="<?php if ($page_title == 'Employer | Applicants Page'){echo 'active';} ?>">
                        <span class="las la-users"></span>
                        Applicants
                    </a>
                </li>
                <li>
                    <a href="feedback.php" class="<?php if ($page_title == 'Employer | Feedback Page'){echo 'active';} ?>" >
                    <span class="las la-comment"></span>
                        Feedback
                    </a>
                </li>
            </ul>

            <div class="menu-head">
                <span>Actions</span>
            </div>
            <ul>
                <li>
                    <a href="add_job.php" class="<?php if ($page_title == 'Employer | Post Job Page'){echo 'active';} ?>">
                        <span class="las la-briefcase"></span>
                        Post Job Vacancy
                    </a>
                </li>

                <?php 
                    $notif = mysqli_query($conn, "SELECT apply.active_status, apply.status, jobs.empid AS empid
                    FROM apply
                    INNER JOIN jobs ON jobs.jobid = apply.jobid
                    WHERE active_status = '0' AND jobs.empid = '$_SESSION[empid]' ");
                    $count = mysqli_num_rows($notif);
                ?>

                <li>
                    <a href="view_applicant.php" id="view_notif" class="<?php if ($page_title == 'Employer | View Applicant Page'){echo 'active';} ?>">
                        <span class="las la-users"></span>
                        View Applicants 
                        <div id="badge" style="background:#00887A; margin-left:30px; display:flex; justify-content:center; color:#fff; width:28px; height:27px; border-radius:5px; font-size:18px; ">
                            <span style="margin: 0;"> <?php echo $count; ?> </span>     
                        </div>
                    </a>
                </li>

                <li>
                    <a href="offer_jobs.php" id="view_notif" class="<?php if ($page_title == 'Employer | Offer Jobs'){echo 'active';} ?>">
                        <span class="las la-users"></span>
                        Offer Jobs
                        </span>
                    </a>
                </li>
            </ul>

        </div>
    </div>
</div> <!--SIDEBAR END-->

<div class="main-content">
    <header>
        <div class="menu-toggle">
            <label for="sidebar-toggle">
                <span class="las la-bars"></span>
            </label>
        </div>

        <div class="header-icons">
            <?php 
                if($fetch['com_profile'] == 'company_default.png'){
                    ?>
                        <img src="assets/Images/company_default.png" class="user-pic" alt="company logo">
                    <?php
                } else{
                    ?>
                        <img src="assets/profile/<?= $fetch['com_profile'] ?>" class="user-pic" alt="company logo">
                    <?php
                }
            ?>

            <div class="sub-menu-wrap" id="subMenu">
                <div class="sub-menu">
                    <div class="user-info">

                        <?php 
                            if($fetch['com_profile'] == 'company_default.png'){
                                ?>
                                    <img src="assets/Images/company_default.png"  alt="company logo">
                                <?php
                            } else{
                                ?>
                                    <img src="assets/profile/<?= $fetch['com_profile'] ?>"  alt="company logo">
                                <?php
                            }
                        ?>
                        <span > <?= $fetch['company_name']; ?> </span>
                    </div>
                    <hr>
                    <a href="edit_profile.php" class="sub-menu-link">
                        <img src="assets/Images/profile.png" alt="">
                        <p>Edit Profile</p>
                        <span>></span>
                    </a>
                    <a href="logout.php" class="sub-menu-link">
                        <img src="assets/Images/logout.png" alt="">
                        <p>Logout</p>
                        <span>></span>
                    </a>
                </div>
            </div>
        </div>

    </header>



  <script>
    $(document).ready(function()
    {

        $(".user-pic").on('click' ,function (){
            $("#subMenu").slideToggle();
        });

    });
  
  </script>  
 