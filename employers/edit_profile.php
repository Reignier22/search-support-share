<?php  
$page_title = "Employer | Edit Profile Page";
include("include/header.php"); 
?>

<style>
input[type="file"] {
    display: none;
}

.custom-file-upload, .reset-btn {
    background-color: #77A6F7;
    display: flex;
    padding: 10px;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    height: 40px;
    border-radius: 5px;
    color: #fff;
    box-shadow: rgba(0, 0, 0, 0.07) 0px 1px 2px, rgba(0, 0, 0, 0.07) 0px 2px 4px, rgba(0, 0, 0, 0.07) 0px 4px 8px, rgba(0, 0, 0, 0.07) 0px 8px 16px, rgba(0, 0, 0, 0.07) 0px 16px 32px, rgba(0, 0, 0, 0.07) 0px 32px 64px;
}

.reset-btn{
    background-color: #c3c3c3;
    width: 100px;
    border: none;
    outline: none;
}
hr{
    border: none;
    height: 1px;
    color: #c3c3c3; 
    background-color: #c3c3c3; 
}

input[type="text"], input[type="password"]{
    background-color: #f8f8f8;
}

input[type="text"]:focus, input[type="password"]:focus{
    background-color: #fff;
}
</style>
<link rel="stylesheet" href="assets/css/edit-profile.css">

<main style="padding-top:60px; min-height: calc(110vh - 70px);"> 
    <div>
        <h1 style="font-weight: 900 ;">Edit Profile</h1>
        <small>Edit and update your account details. You can also set up a new password. When you setup your company location, youu don't need to re-type it when posting a job.</small>
    </div>

    <br>

    <div class="row">
        <form action="connections/edit-profile.php" enctype="multipart/form-data" id="editForm">
        <div class="col-lg-12">
            <div style="display: grid; grid-template-columns:12% 88%">
                <div style="display:flex; align-items:center; justify-content:center">     

                        <?php 
                            if($fetch['com_profile'] == 'company_default.png'){
                                ?>
                                    <img src="assets/Images/company_default.png" id="image1" alt="Profile-pic" width="100px" height="100px" alt="company logo">
                                <?php
                            } else{
                                ?>
                                    <img src="assets/profile/<?php echo $fetch['com_profile'] ?>" id="image1" alt="Profile-pic" width="100px" height="100px" alt="company logo">
                                <?php
                            }
                        ?>
                    <input type="hidden" id="image_logo" value="<?= $fetch['com_profile'];?>">
                </div>
                <div style="margin-left:10px; display: flex; justify-content:space-between; width:250px; position: relative; margin-top:10px">
                    <div>
                        <label for="file-upload" class="custom-file-upload">
                            Upload New Logo
                        </label>
                        <input id="file-upload" name="cp" type="file" onchange="preview()" accept=".jpeg, .jpg, .png">
                    </div>
                
                    <div>
                        <button type="button" id="resetImg" class="reset-btn reset" disabled> <strong> <i class="fa-solid fa-arrow-rotate-left"></i> Reset </strong> </button>
                        <small style="position: absolute; left:0; padding-top:10px; font-size:1.5rem; font-weight:700; color:gray   "> ALLOWED JPEG JPG PNG </small>
                    </div>
                </div>
            </div>
            <hr>
        </div>

        <div class="col-md-6" style="padding: 0px 30px 20px 30px">
            <label for="">Company Name</label>
            <input type="hidden" name="ei" value="<?= $fetch['empid']; ?>">
            <input type="text" name="cn" class="form-control" value="<?= $fetch['company_name'];?>"> <br>
            <label for="">Email</label>
            <input type="text" name="em" class="form-control" value="<?= $fetch['email'];?>"> <br>
            <label for="">Create New Password</label>
            <input type="password" name="ps" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
        </div>

        <div class="col-md-6" style="padding: 0px 30px 20px 30px">
            <label for="">Contact Number</label>
            <input type="text" name="cnb" class="form-control" value="<?= $fetch['contact_number'];?>"> <br>
            <label for="">Company Location</label>
            <?php
                if($fetch['company_loc'] == NULL){
                   echo '<input type="text" name="cl" class="form-control" > <br>';
                } else{
                    echo '<input type="text" name="cl" class="form-control" value="'.$fetch['company_loc'].'"> <br>';
                }
            ?>
            <label for="">Confirm New Password</label>
            <input type="password" name="cps" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
           
        </div>

        <div class="col-md-12">
            <div style="float: right; padding-right:20px">
                <button type="button" class="btn btn-warning reset">Reset Changes</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
        </form>
    </div>

</main>

<script>
function preview() {
    image1.src=URL.createObjectURL(event.target.files[0]);
}
</script>

<?php include("include/footer.php") ?>

<script>
$(document).ready(function(){

    $('#file-upload').change(function(e){
        $('#resetImg').removeAttr('disabled');
    });

    $('.reset').click(function(e){
        e.preventDefault();
        var img = $('#image_logo').val();
        $("#image1").attr('src', 'assets/profile/'+img);
        $('#editForm')[0].reset();
    })

    $('#editForm').submit(function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'connections/edit-profile.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                if(response == 'okokokok'){
                    alert("Your account has been updated successfully!");
                    window.location.reload();
                }
               
            }
        });
    });
});
</script>

