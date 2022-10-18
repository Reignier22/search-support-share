<?php 
$page_title = "Admin | Visitors";
include "includes/header.php";
?>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y"> <!-- Content -->
        <div class="row"> <!-- Row -->
            <h4 class="fw-bold"><span class="text-muted fw-light"> Data Tables /</span> Visitors </h4>  
                <div class="col-md">
                    <div class="card">
                        <div class="card-body">

                        <table id="example" class="table table-striped nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>IP Address</th>
                                    <th>No. of Times Visited</th>
                                    <th>Last Date Visited</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php 
                                $query = mysqli_query($conn, "SELECT * FROM visitors");
                                if(mysqli_num_rows($query) > 0){
                                    foreach($query as $row) 
                                {
                            ?>

                                <tr>
                                    <td><?= $row['vid'];?></td>
                                    <td><?= $row['ip_address'];?></td>
                                    <td><?= $row['counter']; ?></td>
                                    <td><?php $ts=$row['date_visited']; echo date("M. j, Y - g:i a ",strtotime($ts)); ?></td>
                                </tr>
                            
                                <?php
                                    }
                                }    
                                else {
                                    echo "
                                    <tr'>
                                        <td colspan='7' style='background-color:#f6f6f6'; > <span style='color:#a3a6ab;'> No data found. </span>  </td>
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