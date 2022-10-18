<?php 
$page_title = "Admin | Activity Log";
include "includes/header.php";
?>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y"> <!-- Content -->
        <div class="row"> <!-- Row -->
            <h4 class="fw-bold"><span class="text-muted fw-light">  Account/</span> Activity Log </h4>  
            <div class="col-md-12">
                 
                <div class="card" style="max-height:600px">
                    <!-- Notifications -->
                    <h5 class="card-header">Recent Activities</h5>
                    <div class="card-body">
                      <span>These are the activities that has been done throughout the admin account.
                        <span class="notificationRequest"><strong> Please monitor this regularly.</strong></span></span>
                      <div class="error"></div>
                    </div>
                    <div class="table-responsive">
                      <table class="table table-striped table-borderless border-bottom">
                        <thead>
                        
                          <tr>
                            <th class="text-nowrap">Time</th>
                            <th class="text-nowrap">Admin Username</th>
                            <th class="text-nowrap">Activity</th>
                            <th class="text-nowrap text-center">Date</th>
                          </tr>
                        </thead>
                        <tbody>

                        <?php 
                            $log = mysqli_query($conn, "SELECT audit.aid, audit.date, audit.activity, admin_table.username AS 'user'
                            FROM audit INNER JOIN admin_table ON admin_table.aid = audit.aid ORDER BY audit_id DESC");
                            foreach ($log as $lrow):
                        ?>
                          <tr>
                            <td class="text-nowrap "><?php date_default_timezone_set('Asia/Manila'); $date = $lrow['date']; echo date("g:iA", strtotime($date)); ?></td>
                            <td class="text-nowrap "><?= $lrow['user'];?></td>
                            <td class="text-nowrap"><?= $lrow['activity']; ?></td>
                            <td class="text-nowrap text-center"> <?php $date = $lrow['date']; echo date("F j, Y",strtotime($date));  ?> </td>
                          </tr>
                        <?php
                            endforeach;
                        ?>
                        </tbody>
                      </table>
                    </div>
                
                    <!-- /Notifications -->
                </div>
            </div>
        </div> <!-- row -->
    </div> <!-- Content -->
</div> <!-- Content-wrapper -->
    

<?php include 'includes/footer.php'; ?>