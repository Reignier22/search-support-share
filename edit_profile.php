<?php
$page_title = '3S | Profile Settings Page';
include 'profile_includes/profile_head.php'; 
?>

<style>
    input[type="text"]{
        background-color: #d3d3d3;
    }
    input[type="text"]:focus{
        background-color: #fff;
    }
</style>

<div class="col-md-9 account-info" id="#account">
    <div class="row">
        <div class="title"> 
            <h1>Profile Settings </h1> 
        </div>
    </div>

    <div class="row" style="background-color: white; border-radius:10px">

        <div class="col-md-6" style="padding: 20px;">
            <label for="username">Username</label>
            <input type="text" id="username" value="<?= $fetch['username'] ?>" class="form-control" > <br>
            <label for="password">Create New Password</label>
            <input type="password" id="set_password" name="password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" style="margin-bottom: 10px;">
            <input type="hidden" id="set_jsid" value="<?= $fetch['jsid']; ?>">
            <div style="margin-left: 5px;">
                <label style=" display: block; padding-left: 15px; text-indent: -15px; font-weight:400;">
                    <input id="showpass" type="checkbox" style=" width: 13px; height: 13px; padding: 0; margin:0; vertical-align: middle; position: relative; top:-1.8px; *overflow: hidden;" > 
                     Show Password
                </label>
            </div>
        </div>

        <div class="col-md-6" style="padding: 20px">
            <form action="connections/actions_2.php" id="saveForm" >
                <label for="email">Email</label>
                <input type="text" id="set_email" value="<?= $fetch['email'] ?>" class="form-control"> <br>
                <label for="confirm-password">Confirm New Password</label>
                <input type="password" id="confirm-password" name="confirm-password" class="form-control"  placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                <br>
                <div style="float: right;">
                    <button type="button" class="btn reset" style="background-color: #c3c3c3; border:none; border-radius:5px">Reset</button>
                    <button type="button" class="btn save" style="background-color: #77A6F7; border:none; border-radius:5px">Save Changes</button>
                </div>
            </div>
        </form>

        <div class="col-md-12" style="padding: 0 20px 20px 20px;">
        <hr>
            <h3 style="font-size: 1.8rem;">Delete Account</h3>
            <p style="background-color: rgba(255,204,0, 0.5); padding:10px; width:65%; border-radius: 5px;"> <strong> Are you sure you want to delete your account? </strong> <br>
                Once you delete your account, there is no going back. Please be certain.
            </p>
            <div style="margin-left: 5px;">
                <label style=" display: block; padding-left: 15px; text-indent: -15px; font-weight:400;">
                    <input type="checkbox" id="conFirm" style=" width: 13px; height: 13px; padding: 0; margin:0; vertical-align: middle; position: relative; top: -1px; *overflow: hidden;" > 
                    I confirm the deletion of my Account. 
                </label>
            </div>
            <br>
            <div>
                <button type="button" class="btn delete_button" style="background-color: red; border:none; border-radius:5px" >
                    Delete Account
                </button>
            </div>
        </div>

    </div>
</div>

<?php include 'profile_includes/profile_footer.php'; ?>

<script>
$(document).ready(function (){
    $('.reset').click(function(e){
        e.preventDefault();
        $('#saveForm')[0].reset();
    });

    $('.save').click(function(){
        var jsid = $('#set_jsid').val();
        var email = $('#set_email').val();
        var username = $('#username').val();
        var password = $('#set_password').val();
        var cpassword = $('#confirm-password').val();

        $.ajax({
            method: 'POST',
            url: 'connections/actions_2.php',
            data: {
                'save_btn' : true,
                'jsid': jsid,
                'email': email,
                'username': username,
                'password': password,
                'cpassword': cpassword
            },
            success: function(res){
                alert(res);
                $('#saveForm')[0].reset();
            }
        });
    }); 

    $('.delete_button').click(function(e){
        e.preventDefault();
        var checkbox = $('#conFirm');
        var jsid = $('#set_jsid').val(); 
        if(checkbox.prop('checked') == false){
            alert('Please confirm your deletion first.');
        } else{
            $.ajax({
                method: 'POST',
                url: 'connections/actions_2.php',
                data: {
                    'delete_acc': true,
                    'jsid': jsid
                }, 
                success: function(res){
                    alert(res);
                    window.location.href="logout.php";
                }
            });
        }
    });

    $('#showpass').on('click', function(){
        var x = document.getElementById('set_password');
        if (x.type === "password"){
            x.type = 'text';
        } else{
            x.type = 'password';
        }
    });
});
</script>
