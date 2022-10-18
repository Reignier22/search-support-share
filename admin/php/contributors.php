<?php 
$page_title = "Admin | Contributors";
include "includes/header.php";
?>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y"> <!-- Content -->
        <div class="row"> <!-- Row -->
            <h4 class="fw-bold"><span class="text-muted fw-light"> Data Tables /</span> Contributors </h4>  
                <div class="col-md">
                    <div class="card">
                        <div class="card-body">

                        <table id="example" class="table table-striped  nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Contributor's Name</th>
                                    <th>Project Initiator</th>
                                    <th>Campaign Title</th>
                                    <th>Amount Received</th>
                                    <th>Date Donated</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php 
                                $query = mysqli_query($conn, "SELECT donations.did, donations.name, donations.amount, donations.jsid, donations.cid, donations.date_donated,
                                job_seekers.first_name AS 'fname', job_seekers.last_name AS 'lname', campaigns.project_title AS 'pt'
                                FROM donations
                                INNER JOIN job_seekers ON job_seekers.jsid = donations.jsid
                                INNER JOIN campaigns ON campaigns.cid = donations.cid ");
                                if(mysqli_num_rows($query) > 0){
                                    foreach($query as $row) 
                                {
                            ?>

                                <tr>
                                    <td><?= $row['did'];?></td>
                                    <td><?= $row['name']; ?></td>
                                    <td><?= $row['fname'] . " " . $row['lname'];?> </td>
                                    <td><?= $row['pt'] ?></td>
                                    <td><?= $row['amount']; ?></td>
                                    <td><?php $ts=$row['date_donated']; echo date("M. j, Y - g:i a ",strtotime($ts)); ?></td>
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