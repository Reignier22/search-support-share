<?php 
$page_title = '3S | Job Application';
include 'profile_includes/profile_head.php'; 
?>
<link rel="stylesheet" href="profile_includes/assets/css/application.css">

<div class="col-md-9">

    <div class="row job-info">
        <div class="title"> 
            <h1>Job Application </h1> 
        </div>
    </div>

    <div class="row">
        <table id="myTable">
            <thead>
              <tr>
                <th>Job Title</th>
                <th>Company</th>
                <th>Category</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tr class="tr-space"><td class="space" colspan="5"></td></tr>
            <tbody>

            <?php
                $jsid = $_SESSION['userid'];
                $apply =  "SELECT apply.appid, apply.status, jobs.job_title as 'job_title', categories.name as 'catname',  employers.company_name as 'cname'
                FROM apply
                INNER JOIN jobs ON jobs.jobid = apply.jobid
                INNER JOIN categories ON categories.catid = jobs.catid
                INNER JOIN employers ON employers.empid = jobs.empid WHERE jsid = '$jsid' ORDER by appid DESC ";  
                $rs = mysqli_query($conn, $apply);
                
                if(mysqli_num_rows($rs) > 0) {
                    foreach($rs as $approw) 
                {
            ?>    

              <tr>
                <td><?php echo $approw['job_title']; ?></td>
                <td><?php echo $approw['cname'];  ?></td>
                <td><?php echo $approw['catname'];  ?></td>
                <td> <span class="status <?php echo $approw['status'];?>"><?php echo $approw['status'];?> </span> </td>
                <td>
                  <?php 
                    $status = $approw['status'];
                    if( $status == 'application submitted'){
                      ?>
                        <div data-toggle="tooltip" title="CANCEL" data-placement="right" class="centered"> 
                            <button type="button" value="<?= $approw['appid'];?>" class="red cancel_btn btn_design"><i class="fa-solid fa-circle-xmark"></i></button>
                        </div> 
                      <?php
                    } else if ($status == 'cancelled' || $status == 'disapproved' ){
                      ?> 
                        <div data-toggle="tooltip" title="DELETE" data-placement="right" class="centered"> 
                            <button type="button" value="<?= $approw['appid'];?>" class="red delete_btn btn_design"><i class="fa-solid fa-trash-can"></i></button>
                        </div> 
                      <?php
                    } else if($status == 'reviewed by employer') {
                      ?> 
                        <div data-toggle="tooltip" title="VIEW" data-placement="right" class="centered"> 
                          <button type="button" class="eye btn_design"> <a> <i style="color: #c3c3c3;" class="fa-solid fa-eye"></i> </a> </button>
                        </div> 
                      <?php
                    } 
                    
                    else{
                      ?> 
                        <div data-toggle="tooltip" title="VIEW" data-placement="right" class="centered"> 
                          <button type="button" class="eye btn_design"> <a href="application_status.php?view=<?= $approw['appid'];?>"> <i class="fa-solid fa-eye"></i> </a> </button>
                        </div> 
                      <?php
                    }
                  ?>
                 
                </td>
              </tr>
              <tr class="tr-space"><td class="space" colspan="5"></td></tr>
              
              <?php
                    }
                }    
                else {
                    ?>
                      <tr class="nodatafound"><td colspan="5"> <div class="centered"> No applications found. You can &nbsp;<a href="hiring_now.php"> apply here.</a> </div> </td></tr>
                    <?php
                } 
            ?> 
               

            </tbody>
        </table>
    </div>

 </div>
</div>

<!-- Cancel -->
<div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="cancelModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body" style="display: grid; align-items:center; justify-content:center">
        <h4>Are you sure you want to cancel your application?</h4> 
    
        <form action="connections/actions.php" method="POST">

            <input type="hidden" name="cancel_id" id="cancel_id" >

            <div class="modalActions" style="display: flex ; align-items:center; justify-content:center; ">
                <button type="button" name="cancel_apply" class="cancel_apply" style="background-color: 28a745; color:#fff; margin-right:10px; width: 70px; border:none; height:30px; box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;" > YES </button>
                <button type="button" style="background-color: dc3545; color:#fff; width: 70px; height:30px; border:none; box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;" data-dismiss="modal">NO</button>
            </div>

        </form>

      </div>
    </div>
  </div>
</div>

<!-- Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body" style="display: grid; align-items:center; justify-content:center">
        <h4>Are you sure you want to delete your application?</h4> 
    
        <form action="connections/actions_2.php" method="POST">

            <input type="hidden" name="delid" id="delete_id" >

            <div class="modalActions" style="display: flex ; align-items:center; justify-content:center; ">
                <button type="button" class="delete_apply" name="delete_apply" style="background-color: 28a745; color:#fff; margin-right:10px; width: 70px; border:none; height:30px; box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;" > YES </button>
                <button type="button" style="background-color: dc3545; color:#fff; width: 70px; height:30px; border:none; box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;" data-dismiss="modal">NO</button>
            </div>

        </form>

      </div>
    </div>
  </div>
</div>


<script>
$('.cancel_btn').on('click', function(e){
    e.preventDefault();
    var appid = $(this).val();
    $('#cancelModal').modal("show");
    $('#cancel_id').val(appid);
});

$('.cancel_apply').click(function(e){
    e.preventDefault();
    var appid = $('#cancel_id').val();
    $.ajax({
      method: 'POST',
      url: 'connections/actions_2.php',
      data: {
        'cancel_btn': true,
        'appid': appid
      },
      success: function(res){
        alert(res);
        $('#cancelModal').modal("hide");
        $('#myTable').load(location.href + " #myTable");
      }
    });
});

$('.delete_btn').on('click', function(e){
    e.preventDefault();
    var appid = $(this).val();
    $('#deleteModal').modal("show");
    $('#delete_id').val(appid);
});

$('.delete_apply').click(function(e){
    e.preventDefault();
    var appid = $('#delete_id').val();
    alert(appid);
    $.ajax({
      method: 'POST',
      url: 'connections/actions_2.php',
      data: {
        'del_btn': true,
        'del_id': appid
      },
      success: function(res){
        alert(res);
        $('#deleteModal').modal("hide");
        $('#myTable').load(location.href + " #myTable");
      }
    });
});

</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();  

});
</script>

<?php include 'profile_includes/profile_footer.php'; ?>

