<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon/favicon.ico"/>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title> 
        <?php
            require 'connections/config.php';
            if(isset($page_title)){echo "$page_title"; }
        ?>
    </title>

    <?php include 'includes/links.php'; ?>

    <style>
        #blink{
            background-color: #ff3333; 
            color:#fff; 
            border:#ff3333; 
            border-radius:3px; 
            animation: blink 1s linear infinite;
            display: none;
        } 
        @keyframes blink{
            0%{opacity: .3;}
            50%{opacity: .5;}
            100%{opacity: 8;}
        }

        #myImage{
            border-radius: 50%;
            box-shadow: rgba(255, 255, 255, 0.5) 0px 0px 0px 1px;
            padding: 1px ;
            transition: ease-in-out 0.2s;
        }

        #myImage:hover{
            box-shadow: rgba(255, 255, 255, 1) 0px 0px 0px 2px;
        }

        .menu{
            display: grid;
            grid-template-columns: auto auto;
            justify-content: center;
            align-items: center;
            margin-right: 10px;
        }

        .sub-menu-wrap {
            position: absolute;
            top: 100%;
            right: -1%;
            width: 210px;
            max-height: 300px;
            overflow: hidden;
            transition: max-height 0.5s;
            display: none;
        }

        .sub-menu {
            background-color: #FFFFFF;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            padding: 20px;
            margin: 10px;
            border-radius: 5px;
        }

        .user-info {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-info span {
            display: table-cell;
            vertical-align: middle;
            font-size: 14px;
            font-weight: 700;
        }

        .sub-menu hr {
            border: 0;
            height: 1px;
            width: 100%;
            background: #ccc;
            margin: 15px 0 10px;
        }

        .sub-menu-link {
            display: grid;
            justify-content: left;
            text-decoration: none;
            color: #000;
            margin: 12px 0;
        }

        .sub-menu-link:hover {
            text-decoration: none;
        }

        .sub-menu-link p {
            text-align: left;
            width: 100%;
            color: #000;
            font-size: 13px;
        }

        .sub-menu-link:hover p {
            font-weight: 600;
        }

        .sub-menu-link:hover span{
            color: #77A6F7;
            font-weight: 700;
        }
        .logo-desc br{
            display: block;
            margin: 0px !important;
        }

        @media (max-width: 768px){

        }
    </style>

</head>

<body>

<header>

<div class="topbar navbar-fixed-top">
          <div class="container">
            <div class="row">
                <div class="col-md-12">      
                    <p   class="pull-right login">

                    <?php 
                    error_reporting(0);
                    session_start();
                    
                    if (isset($_SESSION['userid'])){
                        $query = mysqli_query($conn, "SELECT * FROM `job_seekers` WHERE `jsid`='$_SESSION[userid]'");
                        $fetch = mysqli_fetch_array($query);

                        ?>
                            <span style="font-size: 15px; cursor:pointer; text-transform:lowercase"><?=$fetch['username'] . "&nbsp"; ?>  
                            
                            <?php 
                                $profileImg = $fetch['profile'];
                                $gender = $fetch['gender'];

                                if($profileImg == 'default.png'){
                                    if($gender == 'Male'){
                                        ?>
                                            <img id="myImage" src="profile_includes/assets/defaults/male_default.png"  width="25" height="25" alt="Profile picture" />
                                        <?php
                                    } else if($gender == 'Female'){
                                        ?>  
                                            <img id="myImage" src="profile_includes/assets/defaults/female_default.png"  width="25" height="25" alt="Profile picture" />
                                        <?php
                                    } else{
                                        ?>  
                                            <img id="myImage" src="profile_includes/assets/defaults/default.jpg"  width="25" height="25" alt="Profile picture" />
                                        <?php
                                    }
                                } else{
                                    ?>  
                                        <img id="myImage" src="profile_includes/profile_pic/<?= $fetch['profile'];?>"  width="25" height="25" alt="Profile picture" />
                                    <?php
                                }
                            ?>
                            </span> 
                        </p>

                        <div class="menu">
                            <div class="sub-menu-wrap" id="subMenu">
                                <div class="sub-menu">
                                    <div class="user-info">
                                        <span > @ <?= $fetch['username']; ?> </span>
                                    </div>
                                    <hr>
                                    <a href="account.php" class="sub-menu-link">
                                        <p>  <span class="fa-regular fa-user"> </span> &nbsp; My Account</p>
                                    </a>
                                    <a href="edit_profile.php" class="sub-menu-link">
                                        <p>  <span class="fa-solid fa-gear"> </span> &nbsp; Profile Settings </p>
                                    </a>
                                    <a href="logout.php" class="sub-menu-link">
                                        <p>  <span class="fa-solid fa-right-from-bracket"> </span> &nbsp; Logout</p>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <?php

                    }else{
                        ?>
                            <a  href='' aria-label='Login (Opens login modal)' data-target='#myModal' data-toggle='modal' ><i class='fa fa-lock'></i> Login | </a> <a aria-label='Redirects to Employer Login page' href='employers/index.php'>For Employers</a></p>";
                        <?php
                    }
                    
                    ?>
            
                </div>
            </div>
          </div>
        </div> 


        <div style="min-height: 30px;"></div>
        <div class="navbar navbar-default navbar-static-top" > 
            <div class="container">

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <div class="nav-logo" style="display:flex; justify-content:space-between">
                        <span style="padding-top:13px">
                        <?php 
                            $fetch_query1 = mysqli_query($conn, "SELECT logo FROM content_manage");
                            $fetch_logo = mysqli_fetch_array($fetch_query1);  
                        ?>
                            <img src="assets/home-plugins/img/<?= $fetch_logo['logo'] ?>" style="width:50px;">
                        </span> 
                        <span  style="font-size: 50px; padding-top:20px; ">
                        
                            <div style="display: flex; justify-content:space-between">
                                <span>|</span>
                                <div style="position: absolute; width:30px; font-size:15px; line-height: 1.7rem; text-transform:uppercase;  margin: -7px 0px 10px 25px" >
                                    <span style="color:#77A6F7">S</span>earch <br> <span style="color:#77A6F7">S</span>upport <br> <span style="color:#77A6F7">S</span>hare
                                </div>    
                            </div>
                        </span>
                    </div>

                </div>

                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav">
                        <li class="<?php if ($page_title == '3S | Index Page'){echo 'active';} ?>"><a aria-label="link to home page" href="index.php">Home</a></li>
                        <li class="<?php if ($page_title == '3S | Hiring Page'){echo 'active';} ?>"><a aria-label="See all available job (click this link)" href="hiring_now.php">Hiring Now</a></li>
                        <li class="<?php if ($page_title == '3S | Campaigns Page'){echo 'active';} ?>"><a aria-label="Support PWDs Initiatives (click this link)" href="campaigns.php">Campaigns</a></li>
                        <li class="<?php if ($page_title == '3S | About Page'){echo 'active';} ?>"><a aria-label="See people behind this website (click this link)" href="aboutus.php">About Us</a></li>
                        <li class="<?php if ($page_title == '3S | Contact Page'){echo 'active';} ?>"><a aria-label="Send message to admin (click here)" href="contact.php">Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
</header>


<!-- modal --> 

<div class="modal fade" id="myModal" tabindex="-1">
  <div class="modal-dialog" style="width:350px; padding-top:20px;">
    <div class="modal-content">

      <form action="connections/login.php" autocomplete="off"  method="POST">

        <div class="modal-body hold-transition login-page">
            <button class="close" data-dismiss="modal" type="button"><i class="fa-solid fa-circle-xmark"></i></button><br><br>
              
            <div class = "login-box-body" 
                 style = "width:      310px; 
                         min-height: 330px;"> 
              
              <h4 class = "modal-title" 
                  id    = "myModalLabel" 
                  style = "text-align: center; font-size:30px"> Login</h4>

                    <div id="blink"> 
                        <i class="fa-solid fa-ban" style="padding-left: 4px; padding-top:4px"></i> <span id="response"> </p>
                    </div>

                  <div     class       = "form-group has-feedback" style="padding-top: 10px; ">
                    <input type        = "text" 
                           class       = "form-control" 
                           placeholder = "Email" 
                           id          = "email"
                           style      = " font-weight:600 " >
                          <span class  = "fa fa-user form-control-feedback" style = "margin-top: -12px;"></span>
                  </div>

                  <div class="form-group has-feedback">
                      <input type        = "password" 
                             class       = "form-control" 
                             placeholder = "Password" 
                             id          = "password" 
                             style       = " font-weight:600">
                            <span class="fa fa-lock form-control-feedback" style="margin-top: -22px;"></span>
                            </div>

                  <div class="row">

                    <div class = "col-xs-6" >
                    <div style="padding-bottom:10px; text-align:left">
                        <label style="font-size: 14px; font-weight:300"> <input type="checkbox" id="show" style="vertical-align: middle; position: relative; bottom: 3px;"> Show Password</label> 
                      </div>
                    </div>
                          
                    <div class="col-xs-6">

                      <div style="padding-bottom:10px; text-align:right">
                        <a href="forgot-pass.php" style="text-decoration: none;">Forgot password?</a>
                      </div>
                    </div>
                          
                  </div> 
                          
                  <input type  = "button" 
                         class = "btn" 
                         id    = "login" 
                         value = "Login" 
                         style = "width: 310px; 
                                  border-radius:5px; 
                                  background-color:#77A6F7;font-size : 15px; text-transform:uppercase; font-weight:900; letter-spacing:1px">
        
                  <br>
                  <hr>
                  <div style="align-items: center; text-align:center">
                      <p>Don't have an Account?<a href="register.php" style="text-decoration: none;">&nbsp;Register Here.</a></p>
                  </div>                      
              </div>
           </div>
        </form>

     </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>

<script type="text/javascript">


    $(document).ready(function () {

        $('#myImage').on('click', function(){
            $("#subMenu").slideToggle();
        });

        $('#show').on('click', function(){
            var x = document.getElementById('password');
            if (x.type === "password"){
                x.type = 'text';
            } else{
                x.type = 'password';
            }
        });


        $('#login').on('click', function(){

            var email = $('#email').val();
            var password = $('#password').val();

            if (email == "" || password == "" ){
                $('#blink').show().delay(3000).hide(0);
                $("#response").html('All fields are required!');
            }else{
                $.ajax(
                    {
                    url: 'connections/login.php',
                    method:"POST",
                    data: {
                        login: 1,
                        emailPHP: email,
                        passwordPHP: password
                    },
                    success: function (response){
                        
                        if(response == 'No')  
                          {  
                            $('#blink').show().delay(3000).hide(0);
                            $("#response").html('Email or Password is incorrect');
                          }  
                          else  
                          {  
                               $('#myModal').hide();  
                               window.location = 'account.php';  
                          }  
                        
                    },

                    dataType: 'text'
                  }
                );
            }
        }); 
    });
</script>




<!-- end modal-->