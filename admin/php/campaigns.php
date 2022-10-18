<?php 
$page_title = "Admin | Campaigns";
include "includes/header.php";
?>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y"> <!-- Content -->
        <div class="row"> <!-- Row -->
            <h4 class="fw-bold"><span class="text-muted fw-light"> Data Tables /</span> Campaigns </h4>  
                <div class="col-md">
                    <div class="card">
                        <div class="card-body">

                        <table id="example" class="table table-striped  nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Posted By</th>
                                    <th>Campaign Title</th>
                                    <th>Goal</th>
                                    <th>Date Posted</th>
                                    <th>End Date</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php 
                                $query = mysqli_query($conn, "SELECT campaigns.cid, campaigns.jsid, campaigns.project_title, campaigns.project_description, campaigns.project_goal, campaigns.end_date, campaigns.date_added, 
                                job_seekers.first_name AS 'fname', job_seekers.last_name AS 'lname'
                                FROM `campaigns` 
                                INNER JOIN job_seekers ON job_seekers.jsid = campaigns.jsid ");
                                if(mysqli_num_rows($query) > 0){
                                    foreach($query as $row) 
                                {
                            ?>

                                <tr>
                                    <td><?= $row['cid'];?></td>
                                    <td><?= $row['fname']. " " . $row['lname']; ?> </td>
                                    <td><?= $row['project_title'] ?></td>
                                    <td><?= $row['project_goal']; ?></td>
                                    <td><?php $ts=$row['date_added']; echo date("M. j, Y - g:i a ",strtotime($ts)); ?></td>
                                    <td><?php $ts=$row['end_date']; echo date("M. j, Y - g:i a ",strtotime($ts)); ?></td>
                                    <td> <?php 
                                    $input = $row['project_description'];
                                    $str = $input;
                                    if( strlen( $input) > 120) {
                                        $str = explode( "\n", wordwrap( $input, 120));
                                        $str = $str[0] . '...';
                                    }
                                    
                                    echo $str;
                                     ?> </td>
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