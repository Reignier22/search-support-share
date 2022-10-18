<?php 
session_start();
$page_title = '3S | Disability Category Page';
include 'connections/config.php';
?>
<style>

    #container {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        border: 0.5px solid #f5f5f5;
        box-shadow: 0.5px 3px #dedede;
        transition: 0.5s;
    }

    #img{
        width: 80%;
    }
</style>
    
<header> 
    <?php 
    include 'includes/header.php'; 
    $catname = $_GET['catname'];
    $jumbo_title = 'Search Results';
    include 'includes/pages.php'
    ?>   
</header>

<?php 
    $job_title = $_GET['job_position'];
    $location = $_GET['location'];
    $catid = $_GET['catid']; 
    $jobs = mysqli_query($conn, "SELECT jobs.jobid, jobs.catid,  jobs.job_title, categories.name as 'catname',  employers.company_name as 'cname', employers.com_profile as profile,
    jobs.salary, jobs.preffered_sex, jobs.address, jobs.postedOn
    FROM jobs
    INNER JOIN categories ON categories.catid = jobs.catid
    INNER JOIN employers ON employers.empid = jobs.empid WHERE jobs.job_title='$job_title' OR jobs.catid='$catid' OR jobs.address='$location' ORDER BY jobs.job_title "); 

    if (mysqli_num_rows($jobs) > 0){
        foreach($jobs as $jobrow) 
        {
?>

<div class="container" id="container">

     <div class="row" id="btn">

            <div class="col-sm-2">
                <img src="employers/assets/profile/<?php echo $jobrow['profile'] ?>" id="img" />
            </div>

            <div class="col-sm-7">
                <h5 style="color:#77A6F7; font-size:large; text-decoration:underline"> <?php echo $jobrow['job_title']; ?> </h5>
                <p style="font-style:italic ;"> <?php echo $jobrow['cname']; ?></p>
                <p> <strong> Salary </strong> <?php echo $jobrow['salary']; ?></p>
                <p> <strong> Location </strong> <?php echo $jobrow['address']; ?> </p>
                <p> <strong> Posted </strong> <?php 

                    date_default_timezone_set('Asia/Manila');
                    $todays_date = date("y-m-d h:i:sa");
                    $now = new DateTime($todays_date);

                    $posted = new DateTime(date($jobrow['postedOn']));
                
                    $diff = $posted-> diff($now);

                    if($diff->y > 0){
                        echo $diff->y .' year'. ($diff->y > 1?"s ":'') . " ago" ;
                    }
                    else if($diff->m > 0){
                        echo $diff->m . ' month'. ($diff->m > 1?"s ":'') . " ago";
                    }

                    else if($diff->d > 0){
                        echo $diff->d .' day'. ($diff->d > 1?"s ":'') . " ago" ;
                    }

                    else if($diff->h > 0){
                        echo $diff->h .' hour'.($diff->h > 1 ? "s ":'') . " ago";
                    }
                    else if($diff->i > 0){
                        echo $diff->i .' minute'. ($diff->i > 1?"s ":'') . " ago";
                    }
                    else if($diff->s > 0){
                        echo $diff->s .' second'. ($diff->s > 1?"s ":'') . " ago";
                    }

                ?></p>
            </div>

            <div class="col-sm-3">
                <p>Category: <?php echo $jobrow['catname']; ?></p>
                <br><br><br>
                
                <?php 
                if (isset($_SESSION['userid'])){
                    ?>
                        <div class="apply" style="display:flex; align-items:flex-end; justify-content:end; margin-right:50px; margin-top:15px;">
                            <a href="apply.php?jobid=<?=$jobrow['jobid']?>" class="btn btn-primary" style="height: 40px; width:80%; text-transform:uppercase; border-radius:5px; border:none;  display:flex; align-items:center; justify-content:center; background: #77A6F7"> View Details </a>
                        </div>
                    <?php
                } else{
                    ?>
                        <div class="apply" style="display:flex; align-items:flex-end; justify-content:end; margin-right:50px; margin-top:15px;">
                        
                            <button id="location" data-target="#myModal" data-toggle="modal" class="btn btn-primary" style="height: 40px; width:80%; text-transform:uppercase; border-radius:5px; border:none;  display:flex; align-items:center; justify-content:center; background: #77A6F7"> Login & Apply </button>
                        </div>
                    <?php
                }
                
                ?>

            </div>
       
    </div> 
    
</div> <br>

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
            <h3> Sorry, no jobs found :( Try searching again. <span class="fa-regular fa-face-pensive"></span> </h3>
        </div>
        <div style="display: flex; justify-content:center; align-items:center">
            <button class="btn btn-primary" style="background-color: #77A6F7; border:none; border-radius:5px" onclick="window.location.href='index.php';" >Back to Home</button>
        </div>
    </div>
</div>
    
    <?php
}
?>

<br>


<footer> <?php include 'includes/footer.php'; ?> </footer>