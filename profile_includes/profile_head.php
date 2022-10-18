<?php 
include 'connections/config.php';
error_reporting(0);

session_start();
if(!ISSET($_SESSION['userid'])){
    header('location:index.php');    
}
?>

<?php 
include 'includes/header.php'; 
$jumbo_title = 'Profile';
include 'includes/pages.php';
?>   
<script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
<link rel="stylesheet" href="profile_includes/assets/css/profile.css?v=1">

<div class="container profile" id="profile">
    <div class="row">
        
        <div class="col-md-3">
            <div class="side-profile">

                <?php 
                    $query = mysqli_query($conn, "SELECT * FROM `job_seekers` WHERE `jsid`='$_SESSION[userid]'");
                    $fetch = mysqli_fetch_array($query);
                ?>

                <div class="profilepic">

                    <?php 
                        $profileImg = $fetch['profile'];
                        $gender = $fetch['gender'];

                        if($profileImg == 'default.png'){
                            if($gender == 'Male'){
                                ?>
                                    <img class="profilepic__image" id="imageProfile" src="profile_includes/assets/defaults/male_default.png"  width="220" height="220" alt="Profibild" />
                                <?php
                            } else if($gender == 'Female'){
                                ?>  
                                    <img class="profilepic__image" id="imageProfile" src="profile_includes/assets/defaults/female_default.png"  width="220" height="220" alt="Profibild" />
                                <?php
                            } else{
                                ?>  
                                    <img class="profilepic__image" id="imageProfile" src="profile_includes/assets/defaults/default.jpg"  width="220" height="220" alt="Profibild" />
                                <?php
                            }
                        } else{
                            ?>  
                                <img class="profilepic__image" id="imageProfile" src="profile_includes/profile_pic/<?= $fetch['profile'];?>"  width="220" height="220" alt="Profibild" />
                            <?php
                        }
                    ?>

                    <div class="profilepic__content">
                        <span class="profilepic__icon"><i class="fas fa-camera"></i></span>
                        <span class="profilepic__text" data-toggle="modal" data-target="#profileModal">Edit Profile Picture</span>
                    </div>
                </div>

                <div>
                <p id="name"><?php echo $fetch['last_name']. ', ' .$fetch['first_name']. ' ' . $fetch['middle_name'];  ?> <br>
                    <span id="label"> NAME </span>
                </p> 
                </div>

                <?php 
                    $notif = mysqli_query($conn, "SELECT * FROM apply WHERE feedback_status = '1' AND `jsid`='$_SESSION[userid]' ");
                    $notif_donors = mysqli_query($conn, "SELECT * FROM donations WHERE status = '1' AND `jsid`='$_SESSION[userid]' ");
                    $count = mysqli_num_rows($notif);
                    $count_donors = mysqli_num_rows($notif_donors);
                ?>

                <ul>
                    <li class="<?php if ($page_title == '3S | Account Page')      {echo 'active';} ?>">  <i class="fa-solid fa-user-tie"></i>       &nbsp;  <a href="account.php">Account   </a></li>
                    <li class="<?php if ($page_title == '3S | Job Application')   {echo 'active';} ?>" > <i class="fa-solid fa-list-check"></i>     &nbsp;  <a href="job_application.php">Job Application     </a></li>
                    <li class="<?php if ($page_title == '3S | Application Status'){echo 'active';} ?>" > <i class="fa-solid fa-message"></i>        &nbsp;  <a href="application_status.php">Application Status  <span id="notif"> <?php echo $count; ?>  </span> </a></li>
                    <li class="<?php if ($page_title == '3S | Campaigns')         {echo 'active';} ?>" > <i class="fa-solid fa-arrow-trend-up"></i> &nbsp;  <a href="campaign_post.php">Campaigns           </a></li>
                    <li class="<?php if ($page_title == '3S | Campaign Status')   {echo 'active';} ?>" > <i class="fa-solid fa-circle-check"></i>   &nbsp;  <a href="campaign_status.php" id="view_campaign">Campaign Status <span id="notifd"> <?php echo $count_donors; ?>  </span>  </a></li>
                    <li class="<?php if ($page_title == '3S | Job Offers')         {echo 'active';} ?>" > <i class="fa-solid fa-handshake"></i>     &nbsp;  <a href="job_offers.php">Job Offers</a></li>
                </ul>
    
            </div>
        </div>


<!-- Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h3 class="modal-title" id="profileModalLabel" >Update Profile Picture</h3>
      </div>
      <div class="modal-body">
    
      <form action="connections/profile_update.php" id="profileForm" method="post" enctype="multipart/form-data">
        <label for="profileImage">Profile Image</label>
        <input type="file" name="profileImage" onchange="preview()" accept=".jpg, .jpeg, .png" class="form-control" id="profileImage">  
        <input type="hidden" name="jsid" value="<?= $_SESSION['userid'] ?>" >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" style="background-color: #c3c3c3; border-radius:5px; border:none" data-dismiss="modal">Close</button>
        <button type="submit" name="upload" id="upload" class="btn btn-primary" style="background-color: #77A6F7; border-radius:5px; border:none">Upload</button>
      </div>
      </form>

    </div>
  </div>
</div>

<script type="text/javascript">
    function preview() {
        imageProfile.src=URL.createObjectURL(event.target.files[0]);
}
</script>

<script>
$(document).ready(function(){
    $("#view_campaign").on('click', function(){
        $.ajax({
            url: 'profile_head.php',
            success: function(res){
            }
        });
    });
    $('#profileForm').submit(function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'connections/profile_update.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
               alert(response);
               window.location.reload();
            }
        });
    });
});
</script> 

<?php 
    $sql = "UPDATE donations SET status = '0' ";
    $rs = mysqli_query($conn, $sql);
?>
