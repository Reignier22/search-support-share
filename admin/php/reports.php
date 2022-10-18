<?php 
$page_title = "Admin | Reports";
include "includes/header.php";
?>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y"> <!-- Content -->
        <div class="row"> <!-- Row -->
            <h4 class="fw-bold"><span class="text-muted fw-light"> Data Tables /</span> Reports </h4>  
                <div class="col-md">
                    <div class="card">
                        <div class="card-body">

                        <table id="example" class="table table-striped  nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Reported Content</th>
                                    <th>Type</th>
                                    <th>Reason</th>
                                    <th>Date Reported</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php 
                                error_reporting(0);
                                $query = mysqli_query($conn, "SELECT reports.rid, reports.cid, reports.jobid, campaigns.project_title AS p_title, jobs.job_title AS j_title, 
                                reports.reason, reports.other_reason, reports.date_reported
                                FROM reports 
                                LEFT JOIN campaigns ON campaigns.cid = reports.cid
                                LEFT JOIN jobs ON jobs.jobid = reports.jobid ");
                                if(mysqli_num_rows($query) > 0){
                                    foreach($query as $row) 
                                {
                            ?>

                                <tr>
                                    <td><?= $row['rid'];?></td>
                                    <td><?php 
                                        if (empty( $row['cid'])){
                                            echo $row['j_title'];
                                        } else{
                                            echo $row['p_title'];
                                        }
                                    ?>
                                    </td>
                                    <td><?php
                                        if(empty($row['cid'])){
                                            echo "Job Post";
                                        } else{
                                            echo "Campaign Post";
                                        } 
                                    ?> 
                                    </td>

                                    <td><?php 
                                    
                                    $reason = $row['reason'];
                                    if(!empty($row['other_reason'])){
                                        echo $reason. "/" . $row['other_reason'];
                                    } else{
                                        echo $reason;
                                    }
                                    ?></td>

                                    <td><?php $ts=$row['date_reported']; echo date("M. j, Y - g:i a ",strtotime($ts)); ?></td>
                                </tr>
                            
                                <?php
                                    }
                                }    
                                else {
                                    echo "
                                    <tr style= 'margin-top-10px'>
                                        <td colspan='7' style='background-color:#f6f6f6';> <span style='color:#a3a6ab;'> No data available. Please check again next time. </span>  </td>
                                    </tr>";
                                } ?>    
                
                                </tbody>
                        </table>
        
                    </div>
                </div>
            </div> <!-- col -->
        </div> <!-- row -->
    </div> <!-- Content -->
</div> <!-- Content-wrapper -->

<?php include 'includes/footer.php'; ?>