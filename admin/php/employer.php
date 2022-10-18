<?php 
$page_title = "Admin | Employers";
include "includes/header.php";
?>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y"> <!-- Content -->
        <div class="row"> <!-- Row -->
            <h4 class="fw-bold"><span class="text-muted fw-light"> Data Tables /</span> Employers </h4>  
                <div class="col-md">
                    <div class="card">
                        <div class="card-body">

                        <table id="example" class="table table-striped  nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Company Logo</th>
                                    <th>Company Name</th>
                                    <th>Contact Number</th>
                                    <th>Email</th>
                                    <th>Date Registered</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php 
                                $query = mysqli_query($conn, "SELECT * FROM employers");
                                if(mysqli_num_rows($query) > 0){
                                    foreach($query as $row) 
                                {
                            ?>

                                <tr>
                                    <td><?= $row['empid'];?></td>
                                    <td><img src="../../employers/assets/profile/<?=$row['com_profile'];?>" width="40px" alt="profile pic"></td>
                                    <td><?= $row['company_name'] ?></td>
                                    <td><?= $row['contact_number']; ?></td>
                                    <td><?= $row['email']; ?></td>
                                    <td><?php $ts=$row['dateCreated']; echo date("M. j, Y - g:i a ",strtotime($ts)); ?></td>
                                </tr>
                            
                                <?php
                                    }
                                }    
                                else {
                                    echo "
                                    <tr style= 'margin-top-10px'>
                                        <td colspan='7' style='background-color:#f6f6f6';> <span style='color:#a3a6ab;'> No data available, <a href='hiring_now.php' style='text-decoration:none';  >Apply Now </a> </span>  </td>
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