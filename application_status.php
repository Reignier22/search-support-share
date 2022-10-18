<?php
session_start(); 
$page_title = '3S | Application Status';
include 'profile_includes/profile_head.php'; 
?>
<link rel="stylesheet" href="profile_includes/assets/css/application.css">

<div class="col-md-9">

    <div class="row job-info">
        <div class="title"> 
            <h1>Application Status </h1> 
        </div>
    </div>

    <div class="row">
        <ul class="responsive-table">
            <li class="table-header">
                <div class="col col-1">Company</div>
                <div class="col col-2">Remark</div>
                <div class="col col-3">Date Responded</div>
                <div class="col col-4">Action</div>
            </li>

            <?php
                if(!isset($_GET['view'])){
                    ?>
                        <?php
                            $apply = "SELECT employers.company_name AS company, 
                            apply.appid, apply.empid, apply.jobid, apply.jsid, apply.status, apply.remarks, apply.message, apply.date_approved 
                            FROM apply 
                            INNER JOIN employers ON employers.empid = apply.empid 
                            WHERE apply.status IN('approved', 'short-listed', 'disapproved') 
                            AND apply.jsid = '$_SESSION[userid]' ORDER BY appid DESC ";  
                            $rs = mysqli_query($conn, $apply);

                            if(mysqli_num_rows($rs) > 0) {
                                foreach($rs as $approw) 
                            {
                        ?>    

                        <li class="table-row">
                            <div class="col col-1"> <?= $approw['company'] ?> </div>
                            <div class="col col-2"> <?= $approw['remarks'] ?> </div>
                            <div class="col col-3"> <?= $approw['date_approved'] ?> </div>
                            <div class="col col-4"> <a href="">View Message</a> </div>
                        </li>

                        <?php
                                }
                            }    
                            else {
                                ?>
                                <li class="table-row nodata">
                                        <div class="col col-6" data-label="Job Id">No data yet. Please wait for the employer to process your application. </div>
                                    </li>
                                <?php
                            } 
                        ?>    
                    <?php
                } else{
                    ?>
                        <?php
                            $view = $_GET['view'];
                            $apply = "SELECT employers.company_name AS company, 
                            apply.appid, apply.empid, apply.jobid, apply.jsid, apply.status, apply.remarks, apply.message, apply.date_approved 
                            FROM apply 
                            INNER JOIN employers ON employers.empid = apply.empid  
                            WHERE apply.appid='$view'";  
                            $rs = mysqli_query($conn, $apply);

                            if(mysqli_num_rows($rs) > 0) {
                                foreach($rs as $approw) 
                            {
                        ?>    

                        <li class="table-row">
                            <div class="col col-1"> <?= $approw['company'] ?> </div>
                            <div class="col col-2"> <?= $approw['remarks'] ?> </div>
                            <div class="col col-3"> <?= $approw['date_approved'] ?> </div>
                            <div class="col col-4"> <a href="">View Message</a> </div>
                        </li>

                        <?php
                                }
                            }    
                            else {
                                ?>
                                <li class="table-row nodata">
                                        <div class="col col-6" data-label="Job Id">No data yet. Please wait for the employer to process your application. </div>
                                    </li>
                                <?php
                            } 
                        ?>    
                    <?php
                }
            ?>
                
        </ul>

    </div>

    </div>
</div>

<script>
    $(document).ready(function()
    {
        $("#view_notif").on('click', function(){
            $.ajax({
                url: 'application_status.php',
                success: function(res){
                    console.log(res);
                }
            });
        });
    });
</script>  

<?php 
include 'connections/config.php';
$sql = "UPDATE apply SET feedback_status = '0' ";
$rs = mysqli_query($conn, $sql);
?>

<?php include 'profile_includes/profile_footer.php'; ?>
