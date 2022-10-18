<?php 
$page_title = "Admin | Job Seekers";
include "includes/header.php";
?>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y"> <!-- Content -->
        <div class="row"> <!-- Row -->
            <h4 class="fw-bold"><span class="text-muted fw-light"> Data Tables /</span> Job Seekers or Project Initiators </h4>  
                <div class="col-md">
                    <div class="card">
                        <div class="card-body">

                        <table id="example" class="table table-striped  nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Profile</th>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Civil Status</th>
                                    <th>Gender</th>
                                    <th>Address</th>
                                    <th>Contact Number</th>
                                    <th>Work Experience</th>
                                    <th>Educational Attainment</th>
                                    <th>Email</th>
                                    <th>Date Registered</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php 
                                $query = mysqli_query($conn, "SELECT * FROM job_seekers");
                                if(mysqli_num_rows($query) > 0){
                                    foreach($query as $row) 
                                {
                            ?>

                                <tr>
                                    <td><?= $row['jsid'];?></td>
                                    <td><img src="../../profile_includes/profile_pic/<?=$row['profile'];?>" width="40px" alt="profile pic"></td>
                                    <td><?php $mn =$row['middle_name']; echo $row['last_name']. ", " . $row['first_name'] . $mn[0]; ?></td>
                                    <td>
                                        <?php 
                                            $dob = $row['birthday'];
                                            $bday = new DateTime($dob);
                                            $today = new DateTime(date('m.d.y'));
                                            $diff = $today-> diff($bday);
                                            printf(' %d years old ', $diff->y);
                                        ?>
                                    </td>
                                    <td><?= $row['civil_status']; ?></td>
                                    <td><?= $row['gender']; ?></td>
                                    <td><?= $row['address']; ?></td>
                                    <td><?= $row['contact_number']; ?></td>
                                    <td>
                                    <?php 
                                        if($row['work_experience_1'] != NULL){
                                            echo '<br>' . $row['work_experience_1'] . "<br>";
                                        } 

                                        if($row['work_experience_2'] != NULL){
                                            echo $row['work_experience_2'] . "<br>";
                                        } else{
                                            echo $row['work_experience_3'] . "<br>";
                                        }
                                        if($row['work_experience_3'] != NULL){
                                            echo $row['work_experience_4'] . "<br>";
                                        } else{
                                            echo $row['work_experience_5'] . "<br>";
                                        }
                                    ?>
                                    </td>
                                    <td><?= $row['attainment']; ?></td>
                                    <td><?= $row['email']; ?></td>
                                    <td><?php $ts=$row['created_on']; echo date("M. j, Y - g:i a ",strtotime($ts)); ?></td>
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

