<?php
session_start();
include "connections/config.php";
$page_title = '3S | Campaigns Page';
?>

<?php
include 'includes/header.php';
$jumbo_title = 'Campaign Lists';
include 'includes/pages.php';
?>

<link rel="stylesheet" href="assets/home-plugins/css/campaigns.css">
<div id="blog">
    <?php
        $campaigns = mysqli_query($conn, "SELECT campaigns.cid, job_seekers.first_name as fname, job_seekers.last_name as lname,
        campaigns.date_added, campaigns.project_title, campaigns.project_description, campaigns.image, campaigns.display
        FROM campaigns 
        INNER JOIN job_seekers ON job_seekers.jsid = campaigns.jsid WHERE campaigns.display='visible'  ORDER BY cid DESC");
        
        if(mysqli_num_rows($campaigns) > 0){
            foreach ($campaigns as $crow)
        {
    ?>

    <div class="blog-container">

        <div class="blog-box">

            <div class="blog-img">
                <img src="profile_includes/assets/project-banner/<?=$crow['image'];?>" alt="Image 1">
            </div>

            <div class="blog-text">
                <span> Posted on <?php 
                $timestamp = $crow['date_added']; 
                echo date("M, d Y", strtotime($timestamp));
                ?> 
                by <?php echo $crow['fname'] . " " . $crow['lname']; ?></span>
                <p class="blog-title"><?php echo htmlentities($crow['project_title']); ?></p>
                <p class="desc"><?php echo nl2br($crow['project_description']); ?></p>

                <a href="campaign_read-more.php?cid=<?=$crow['cid']?>&pt=<?=$crow['project_title']?>">Read
                    More</a>
            </div>

        </div>
    </div>

    <?php  
    }
} else{
   ?>
    
    <div class="container">
    <div class="error_container" style="padding: 10%;">
        <div class="image-container" style="display: flex; justify-content:center; align-items:center">
            <img src="assets/home-plugins/img/not_found.png" alt="Job not Found" style="width: 40%;">
        </div>

        <div class="h1-container" style="display: flex; justify-content:center; align-items:center">
            <h3> Sorry, no campaigns found Please check again later. <span class="fa-regular fa-face-pensive"></span> </h3>
        </div>
        <div style="display: flex; justify-content:center; align-items:center">
            <button class="btn btn-primary" style="background-color: #77A6F7; border:none; border-radius:5px" onclick="window.location.href='index.php';" >Back to Home</button>
        </div>
    </div>
</div>
    
    <?php
}
?> 

</div>

<br>


<?php include 'includes/footer.php'?>