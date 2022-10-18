<?php 
$page_title = '3S | Application Status';
include 'profile_includes/profile_head.php'; 
?>
<link rel="stylesheet" href="profile_includes/assets/css/application.css">

<div class="col-md-9 job-apply">

<?php 
    $apply = "SELECT employers.company_name AS company, jobs.job_title as 'job',
    job_seekers.first_name as fname, job_seekers.last_name as lname, job_seekers.middle_name as mname,
    apply.appid, apply.empid, apply.jobid, apply.jsid, apply.status, apply.remarks, apply.message, apply.date_approved 
    FROM apply 
    INNER JOIN employers ON employers.empid = apply.empid 
    INNER JOIN jobs ON jobs.jobid = apply.jobid 
    INNER JOIN job_seekers ON job_seekers.jsid = apply.jsid 
    WHERE apply.empid IS NOT NULL AND apply.remarks IS NOT NULL AND apply.message IS NOT NULL AND apply.date_approved IS NOT NULL 
    AND apply.status IN('approved', 'short-listed', 'disapproved') 
    AND apply.appid = '$_GET[appid]' ";  
    $rs = mysqli_query($conn, $apply);
    $fetch = mysqli_fetch_array($rs);
?>

    <div class="message">
        <div class="grid-item">
            <h1>Employer's Message <br>
                <span>With Regards to your applicantion as <?php echo $fetch['job'] ?> </span>
            </h1>

            <h2> To : <?php echo $fetch['fname']. " " . $fetch['mname']. " " . $fetch['lname'] ?> <br> 
                <span>From: <?php echo $fetch['company'] ?> </span>
            </h2>
            
            <p> Hello <?= $fetch['fname'] ?>, </p>
            <p> <?= $fetch['company'] ?> would like to say, Congratulations, you are approved. </p>
            <p> After reviewing your credentials, here's the full detatils regarding with your application: </p>
            <p id="details"> <?php echo nl2br($fetch['message'] ); ?> </p>
            <p> Respectfully yours, <br>
                <span> <?= $fetch['company'] ?> </span>
            </p>
            
        </div>

        <div class="grid-item">
            
       
            <div class="back">
                <span style="display:none" id="icon" class="fa-solid fa-arrow-left"> </span> <a href="application_status.php" id="back"> Back </a>
            </div>
        
            <div class="message-icon">
                <img src="assets/home-plugins/img/mess.png" alt="Message icon" width="250px" height="230px"> 
                <span>Date Responded | <?php 
                    $da = $fetch['date_approved'];
                    echo date("F j, Y", strtotime($da))
                ?></span>
            </div>
           
        </div>
    </div>

</div>

<script>
    $('#back').mouseover(function(){
        $('#icon').show();
    });
    $('#back').mouseleave(function(){
        $('#icon').fadeOut();
    });
</script>


<?php include 'profile_includes/profile_footer.php'; ?>