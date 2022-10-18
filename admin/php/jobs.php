<?php 
$page_title = "Admin | Jobs";
include "includes/header.php";
?>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y"> <!-- Content -->
        <div class="row"> <!-- Row -->
            <h4 class="fw-bold"><span class="text-muted fw-light"> Data Tables /</span> Jobs </h4>  
                <div class="col-md">
                    <div class="card">
                        <div class="card-body">

                        <table id="example" class="table table-striped  nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category</th>
                                    <th>Employer</th>
                                    <th>Job Title</th>
                                    <th>Employees Needed</th>
                                    <th>Duration</th>
                                    <th>Salary</th>
                                    <th>Preferred Gender</th>
                                    <th>Address</th>
                                    <th>Date Posted</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php 
                                $query = mysqli_query($conn, "SELECT jobs.jobid, categories.name as 'catname', employers.company_name as 'cname',
                                jobs.job_title, jobs.employees_needed, jobs.duration, jobs.salary, jobs.preffered_sex, jobs.address, jobs.postedOn
                                FROM jobs
                                INNER JOIN categories ON categories.catid = jobs.catid
                                INNER JOIN employers ON employers.empid = jobs.empid");
                                if(mysqli_num_rows($query) > 0){
                                    foreach($query as $row) 
                                {
                            ?>

                                <tr>
                                    <td><?= $row['jobid'];?></td>
                                    <td><?= $row['catname'];?> </td>
                                    <td><?= $row['cname'] ?></td>
                                    <td><?= $row['job_title']; ?></td>
                                    <td><?= $row['employees_needed']; ?></td>
                                    <td>until <?= $row['duration']; ?></td>
                                    <td><?= $row['salary']; ?></td>
                                    <td><?= $row['preffered_sex']; ?></td>
                                    <td><?= $row['address']; ?></td>
                                    <td><?php $ts=$row['postedOn']; echo date("M. j, Y - g:i a ",strtotime($ts)); ?></td>
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