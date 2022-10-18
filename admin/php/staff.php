<?php 
$page_title = "Admin | Staff";
include "includes/header.php";
?>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y"> <!-- Content -->
        <div class="row"> <!-- Row -->
            <h4 class="fw-bold"><span class="text-muted fw-light"> Data Tables /</span> Administrators </h4>  
                <div class="col-md">
                    <div class="card">
                        <div class="card-body">

                        <table id="example" class="table table-striped nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Date Added</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php 
                                $query = mysqli_query($conn, "SELECT * FROM admin_table WHERE access_level IN('1', '2') AND status = 'allowed' ");
                                if(mysqli_num_rows($query) > 0){
                                    foreach($query as $row) 
                                {
                            ?>

                                <tr>
                                    <td><?= $row['aid'];?></td>
                                    <td><img src="../assets/img/profiles/<?= $row['pic'];?>" width="40px" alt="profile"></td>
                                    <td><?= $row['username']; ?></td>
                                    <td><?= $row['email'];?></td>
                                    <td><?php
                                        $al = $row['access_level'];
                                        if($al == '1'){
                                            echo 'Head Admin';
                                        } else{
                                            echo 'Staff';
                                        }
                                    ?></td>

                                    <td><?php $ts=$row['date_created']; echo date("M. j, Y - g:i a ",strtotime($ts)); ?></td>
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