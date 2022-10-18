<?php 
$page_title = '3S | Campaign Status';
include 'connections/config.php';
include 'profile_includes/profile_head.php'; 
?>
<link rel="stylesheet" href="profile_includes/assets/css/status.css">
<link rel="stylesheet" href="profile_includes/assets/css/campaigns.css">

<div class="col-md-9 campaigns">

    <div class="row campaign-info">
        <div class="ctitle">
            <h1> Campaign Details </h1>
        </div>
    </div>

    <div class="row">

    <div class="campaign_view" >
            <?php
                $cid = $_GET['cid'];
                $campaigns = mysqli_query($conn, "SELECT * FROM campaigns WHERE cid = $cid ");
                $fetch = mysqli_fetch_array($campaigns);
            ?>
    <form action="" method="POST">
            <div class="grid-info"> 
                    <div class="info1">       
                        <p class="default"> <strong>Project Title: </strong> <?= $fetch['project_title'] ?> </p>
                        <p class="for_edit"> <strong>Project Title: </strong> <input type="text" name="project_title" id="project_title" value="<?= $fetch['project_title'] ?>"> </p>
                        <p class="default"> <strong>Project Goal:</strong> <?= $fetch['project_goal'] ?> </p>
                        <p class="for_edit"> <strong>Project Goal: </strong> <input type="text" name="project_goal" id="project_goal" value="<?= $fetch['project_goal'] ?>"> </p>
                        <p class="default"> <strong>Project End Date: </strong> <?= $fetch['end_date'] ?> </p>
                        <p class="for_edit"> <strong>Project End Date: </strong> <input type="text" name="end_date" id="end_date" value="<?= $fetch['end_date'] ?>"> </p>
                        <p class="default"> <strong>Project Description: </strong> <?= $fetch['project_description'] ?> </p>
                        <p class="for_edit"> <strong>Project Description: </strong></p> <span class="for_edit"> <textarea name="project_description" id="project_description"><?php echo $fetch['project_description'] ?></textarea> </span>
                    </div>
                <div class="info2">
                    <p> <strong> Qr code </strong> <span id="back-btn"> </p>
                    <img src="profile_includes/assets/qr_code/<?= $fetch['qr_code'] ?>" class="banner" alt="Qr Code">
                </div>
            </div>

            <div class="grid_banner">
                <div class="banner1">
                    <p> <strong>Banner 1</strong> </p>
                    <img src="profile_includes/assets/project-banner/<?= $fetch['image'] ?>" class="banner" alt="Banner 1">
                </div>

                <div class="banner2">
                    <p> <strong>Banner 2</strong> </p>
                    <img src="profile_includes/assets/project-banner/<?= $fetch['image2'] ?>" class="banner"  alt="Banner 2">
                </div>

                <div class="banner3">
                    <p> <strong>Banner 3</strong> </p>
                    <img src="profile_includes/assets/project-banner/<?= $fetch['image3'] ?>" class="banner"  alt="Banner 3">
                </div>

                <div class="actions" id="default_actions">
                    <p class="button-59" id="edit_btn" style="background-color: #ffa500;"> Edit </p>
                    <input type="submit" name="delete" id="deleteCampaign" class="button-59" value="Delete" style="background-color: red;">
                    <input type="button" class="button-59" value="Back" onclick="location.href= 'campaign_status.php';" style="background-color: #c3c3c3;">
                </div>

                <div class="actions update" id="update_actions">
                    <input type="submit" class="button-60" name="update" id="updateCampaign" value="Update" style="background-color: #77A6F7;">
                    <input type="button" class="button-60" value="Cancel" id="cancel_btnn" style="background-color: #c3c3c3;">
                </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
$(document).ready(function(){
   
    $('#edit_btn').on('click', function(){
        $('#default_actions').hide();
        $('.default').hide();
        $('.banner').css('opacity', '0.5');
        $('#update_actions').fadeIn();
        $('.for_edit').fadeIn();
    });

    $('#cancel_btnn').on('click', function(){
        $('#default_actions').fadeIn();
        $('.default').fadeIn();
        $('.banner').css('opacity', '1');
        $('#update_actions').hide();
        $('.for_edit').hide();
    });

 
    $("#updateCampaign").on('click', function(){
        $.ajax({
            url: 'campaign_status_view.php',
            success: function(res){
                if(res="yes"){
                    alert("Campaign has been updated successfully");
                    window.location.reload();
                } else{
                    alert("Some problems occured");
                }
          
            }
        });
    });

    $('#deleteCampaign').on('click', function(){
        if(!confirm('Are you sure you want to delete this campaign? All data associated with this campaign will be deleted as well.')){
            return false;
        } else{
            $.ajax({
                url: 'campaign_status_view.php',
                success: function(res){
                    if(res="del"){
                        alert("Campaign has been deleted.");
                        window.location.replace('campaign_status.php');
                    } else{
                        alert("Some problems occured");
                    }
            
                }
            });
        }
    });
   
    
});
</script>

<?php 

if(isset($_POST['update'])){

    $cid = $_GET['cid'];
    $project_title = mysqli_real_escape_string($conn, $_POST['project_title']);
    $project_goal = mysqli_real_escape_string($conn, $_POST['project_goal']);
    $project_description = mysqli_real_escape_string($conn, $_POST['project_description']);
    $end_date = mysqli_real_escape_string($conn, $_POST['end_date']);

    $sql = "UPDATE campaigns SET project_title='$project_title',  project_goal='$project_goal', project_description='$project_description', end_date='$end_date' WHERE cid='$cid' ";
    $rs = mysqli_query($conn, $sql);

    if($rs){
        echo "yes";
    } else{
        echo "no";
    }

}

if (isset($_POST['delete'])){
    $cidelete = $_GET['cid'];
    $delete = "DELETE FROM `campaigns` WHERE cid = '$cidelete' ";
    $res = mysqli_query($conn, $delete);
    if ($res){
        echo'del';
    } else{
        echo'not_del';
    }
}

?>


<?php include 'profile_includes/profile_footer.php'; ?>