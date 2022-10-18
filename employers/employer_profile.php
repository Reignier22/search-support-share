<?php  
$page_title = "Employer | Profile Page";
include("include/header.php"); 
?>

<style>
    .grid-item{
        padding-bottom: 10px;
    }
    .grid-item input,.grid-item textarea, .grid-item select {
        width: 95%;
        height: 30px;
        padding-left: 5px;
    }
    .grid-item textarea{
        min-height: 80px;
        max-height: 500px;
    }

</style>
<main style="min-height: 100vh;">
        <?php include("include/dashboard.php") ?>
         
        <br>
        <div class="jobs">
            <h2>Job Vancies Offered <small> List of posted jobs </small></h2>
            <div class="table-responsive">
            <table width:100%>
                <thead>
                    <tr>
                        <td> <div> </div> </td>
                        <td> <div> Job Title </div>  </td>
                        <td> <div> Category </div>  </td>
                        <td> <div> Duration </div> </td>
                        <td> <div> Status </div> </td>
                        <td> <div> Actions </div> </td>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $jobs = "SELECT jobs.jobid, categories.name as 'catname',
                    jobs.empid, jobs.job_title, jobs.job_description, jobs.employees_needed, jobs.duration, jobs.salary, jobs.qualification, jobs.preffered_sex, jobs.address, jobs.postedOn
                    FROM jobs
                    INNER JOIN categories ON categories.catid = jobs.catid
                    INNER JOIN employers ON employers.empid = jobs.empid WHERE jobs.empid = '$_SESSION[empid]' ORDER BY jobid DESC ";  
                    $rs = mysqli_query($conn, $jobs);

                    if(mysqli_num_rows($rs) > 0) {
                        foreach($rs as $jobrow) 
                    {
                    
                ?>
                    <tr>    
                        <td class="jobid" style="display: none;"><?php echo $jobrow['jobid'] ?></ </td>
                        <td><div> <span class="indicator"></span></div></td>
                        <td><div> <?php echo $jobrow['job_title'] ?> </div></td>
                        <td><div> <?php echo $jobrow['catname'] ?>  </div> </td>
                        <td><div> <?php      
                        $posted = new DateTime(date($jobrow['postedOn']));
                        $enddate = new DateTime(date( $jobrow['duration']));

                        $diff = $posted-> diff($enddate);
                        echo $diff->d .' day'. ($diff->d > 1?"s ":'')

                        ?> </div> </td>
                        <td><div><?php
                        $date = date("Y-m-d");
                        $duration = date( $jobrow['duration']);
                        
                                //aug. 31, 2022      sept. 15, 2022
                            if (strtotime($duration) >= strtotime($date) ){
                                echo "<p style='color: green; font-weight:900'  >On going until  ". "&nbsp;" .  date("M j, Y", strtotime($duration)) . "</p>";
                            } else{
                                echo "<p style='color: red; font-weight:900'  >Employment ended on  " . "&nbsp;" . date("M j, Y", strtotime($duration))  . "</p>";
                            }
                        ?></div> </td>
                        <td><div>
                            <?php
                            $date = date("Y-m-d");
                            $duration = $jobrow['duration']; 
                            
                                if ( strtotime($duration) >= strtotime($date) ){
                                    ?>
                                        <button class="eye"> <i class="fa-solid fa-eye"></i></button>
                                        <button class="edit"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <?php
                                } else{
                                    ?>
                                        <button class="trash"><i class="fa-solid fa-trash"></i></button>
                                    <?php
                                }
                            ?>  
                        </div></td>
                    </tr>
                <?php
                    }
                }    
                else {
                    echo "
                    <tr>
                    <td colspan='7'> <div style='justify-content:center; align-items:center; background-color: #ececec'> <span style='color: gray; font-size:large'; font-weight:700;> There are no jobs yet </span></div> </td>
                    </tr>";
                } ?>    
                </tbody>
            </table>
            </div>
        </div>
        
    </main>

<!-- View Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewModalTitle" style="font-size: 20px; font-weight:900"> JOB DETAILS
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></h5>
        </button>
      </div>
      <div class="modal-body">
      
         <div id = "view_data">

         </div>    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalTitle" style="font-size: 20px; font-weight:900"> EDIT JOB 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></h5>
        </button>
      </div>
      <div class="modal-body">
    
     <form action="connections/actions.php" method="POST">

      <div class="grid-container" style="display: grid; grid-template-columns: auto auto;  ">
      <input type="hidden" name="jobid" id="jobid">
        <div class="grid-item">
            <label for="job_title">Title</label>
            <input type="text" name="job_title" id="job_title">
        </div>
        <div class="grid-item">
            <label for="employees">No. of Employees</label>
            <input type="text" name="employees" id="employees">
        </div>
        <div class="grid-item">
            <label for="duration">Duration</label>
            <input type="date" name="duration" id="duration">
        </div>
        <div class="grid-item">
            <label for="salary">Salary</label>
            <input type="text" name="salary" id="salary">
        </div>
        <div class="grid-item">
            <label for="gender">Preffered Gender</label>
            <select name="gender" id="gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Anyone">Anyone</option>
            </select>
        </div>
        <div class="grid-item">
            <label for="category">Category</label>
            <select name="catid" id="catid">
            <?php
                $sql = "select * from categories";
                $data = mysqli_query($conn,$sql);
                if(mysqli_num_rows( $data) > 0){
                    while($rs=mysqli_fetch_array($data)){
                            ?><option value="<?=$rs['catid']?>"><?= $rs['name']?></option><?php
                    }
                }else{
                    ?><option>No category found</option><?php
                }
            ?>
            </select>
        </div>
        <div class="grid-item">
            <label for="job_desc">Description</label>
            <textarea name="description" id="description" oninput="auto_grow(this)"></textarea>
        </div>
        <div class="grid-item">
            <label for="qual">Qualifications</label>
            <textarea name="qualification" id="qualification" oninput="auto_grow(this)"></textarea>
        </div>
        <div class="grid-item">
            <label for="loc">Location</label>
            <textarea name="location" id="location" oninput="auto_grow(this)"></textarea>
        </div>
    </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
        <button type="submit" name="update" class="btn btn-primary">Update</button>
      </div>

    </form> 

    </div>
  </div>
</div>

<!-- Delete Modal --> 
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalTitle" aria-hidden="true" style="margin-top: 15%;">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body" style="display: grid; align-items:center; justify-content:center">
        <h4>Are you sure you want to delete this job?</h4> 

            <input type="hidden" name="delid" id="delete_id" value="delete_id">

            <div class="modalActions" style="display: flex ; align-items:center; justify-content:center; ">
                <button type="button" class="delete-btn" name="delete_apply" style="background-color: #28a745; color:#fff; margin-right:10px; width: 70px; border:none; height:30px; box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;" > YES </button>
                <button type="button" style="background-color: #dc3545; color:#fff; width: 70px; height:30px; border:none; box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;" data-dismiss="modal">NO</button>
            </div>

      </div>
    </div>
  </div>
</div>


<script>
    function auto_grow(element) {
    element.style.height = "5px";
    element.style.height = (element.scrollHeight)+"px";
    }
</script>

<script>
    $(document).ready(function(){
        // getdata();

        $('.delete-btn').on('click', function(e){
            e.preventDefault();

            var jobid = $('#delete_id').val();

            $.ajax({
                type: 'POST',
                url: 'connections/actions.php',
                data: {
                    'checking_delete': true,
                    delete_id : jobid,
                },
                success: function(response){
                    $("#deleteModal").modal("hide");
                    alert(response);
                }
            });

        });

        $(document).on('click', '.trash', function(){
            var jobid = $(this).closest('tr').find('.jobid').text();
            $('#delete_id').val(jobid);
            $("#deleteModal").modal("show");
        });

    });
</script>

<script>
$(document).ready(function(){

    $('.eye').on('click', function(e){
        e.preventDefault();
        var jobid = $(this).closest('tr').find('.jobid').text();
        
        $.ajax({
            type: 'POST',
            url: 'connections/actions.php',
            data: {
                'view_btn': true,
                'jobid': jobid,
            },
            success: function(response){
                $('#view_data').html(response);
                $('#viewModal').modal("show");
            }
        });

    });

    $('.edit').on('click', function(e){
        e.preventDefault();
        var jobid = $(this).closest('tr').find('.jobid').text();
        
        $.ajax({
            type: 'POST',
            url: 'connections/actions.php',
            data: {
                'edit_btn': true,
                'jobid': jobid,
            },
            success: function(response){
                $.each(response, function(key, value){
                    $('#jobid').val(value['jobid']);
                    $('#job_title').val(value['job_title']);
                    $('#employees').val(value['employees_needed']);
                    $('#duration').val(value['duration']);
                    $('#salary').val(value['salary']);
                    $('#gender').val(value['preffered_sex']);
                    $('#catid').val(value['catID']);
                    $('#description').val(value['job_description']);
                    $('#qualification').val(value['qualification']);
                    $('#location').val(value['address']);
                });
                $('#editModal').modal("show");
            }
        });

    });

});    
</script>

<?php include("include/footer.php") ?>