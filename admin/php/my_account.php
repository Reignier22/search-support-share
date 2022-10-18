<?php 
$page_title = "Admin | My Account";
include "includes/header.php";
?>

<style>
    input[type="text"], input[type="password"]{
        background-color: #f8f8ff;
    }
</style>

<div class="content-wrapper"> <!-- Wrapper -->
    <div class="container-xxl flex-grow-1 container-p-y"> <!-- Content -->
        <div class="row"> <!-- Row -->
            <div class="col">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="fw-bold"><span class="text-muted fw-light"> Settings /</span> My Account </h4>  
                        <div class="card mb-4">
                            <h5 class="card-header">Profile Details</h5>
                        <!-- Account -->
                        <div class="card-body">
                            
                        <form action="../controllers/profile.php" id="profileForm" enctype="multipart/form-data" >
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                <img src="../assets/img/profiles/<?= $fetch_profile['pic'] ?>" alt="user-avatar" class="d-block rounded" height="100" width="100" id="profilePic">
                                    <div class="button-wrapper">
                                        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                            <span class="d-none d-sm-block">Upload new photo</span>
                                            <i class="bx bx-upload d-block d-sm-none"></i>
                                            <input type="file" id="upload" name="upload" class="account-file-input" hidden="" onchange="preview()" accept="image/png, image/jpeg">
                                            <input type="hidden" name="fileUploaded" id="fileUploaded" value="<?=$fetch_profile['pic'];?>">
                                        </label>
                                        <button type="button" onclick="resetPic()" class="btn btn-outline-secondary account-image-reset mb-4">
                                            <i class="bx bx-reset d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Reset</span>
                                        </button>
                                        <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                    </div>
                            </div>
                        </div>
                        <hr class="my-0">

                    <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="aid" id="aid" value="<?= $fetch_profile['aid']; ?>">
                                <div class="mb-3 col-md-6">
                                    <label for="username" class="form-label">Username</label>
                                    <input class="form-control" type="text" id="username" name="username" value="<?= $fetch_profile['username'] ?>" >
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input class="form-control" type="text" name="email" id="email" value="<?= $fetch_profile['email'] ?>">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <div class="form-password-toggle">
                                        <label class="form-label" for="password">Change Password</label>
                                        <div class="input-group">
                                        <input type="password" class="form-control" name="password" id="password" placeholder="············" aria-describedby="basic-default-password2">
                                        <span id="basic-default-password2" class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <div class="form-password-toggle">
                                        <label class="form-label" for="confirm_password">Confirm Password</label>
                                        <div class="input-group">
                                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="············" aria-describedby="basic-default-password2">
                                        <span id="basic-default-password2" class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2">Save changes</button>
                          <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                        </div>

                      </form>
                    </div>
                    <!-- /Account -->
                </div>
            </div>
        </div>

            </div> <!-- Col -->
        </div> <!-- Row -->
    </div>  <!-- Content -->
</div> <!-- Wrapper -->

<script type="text/javascript">
    function preview() {
        profilePic.src=URL.createObjectURL(event.target.files[0]);
    }
    function resetPic(){
        var file = document.getElementById("fileUploaded").value;
        profilePic.src='../assets/img/profiles/'+file;
    }
</script>

<?php include 'includes/footer.php'; include '../messages.php'; ?>

<script>
$(document).ready(function(){
    $('#profileForm').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '../controllers/profile.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                if(response == 'empty'){
                    $('#warning2').show();
                    $('#warning2_msg').html("Please make some changes before submitting");
                } else if (response == 'okokok') {
                    $('#updateLogo').show();
                    $('#update_body_logo').html('Profile has been updated successfully');
                } else if (response == 'okpass_errok'){
                    $('#warning2').show();
                    $('#warning2_msg').html('Password did not match. Please try again');
                } else{
                    alert('Some error occured');
                }
            }
        });
    });

    $('.bs-toast').on('click', function(){
        $('#updateLogo').fadeOut();
        $('#warning2').fadeOut();
    });
});
</script>