<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: hiring_now.php");
}

?>

<?php
$page_title = '3S | Applicattion Page';
?>

<header>
    <?php
include 'includes/header.php';
$jumbo_title = 'Job Details';
include 'includes/pages.php'
?>
</header>


<style>
.details {
    background-color: #fff;
    height: auto;
    box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
    padding-left: 30px;
    padding-right: 30px;
    padding-bottom: 30px;
}

.details h3 {
    font-weight: 500;
}

.details i {
    padding-right: 10px;
}

.details span {
    padding-right: 5px;
    font-weight: 900;
}

.details h5 {
    font-weight: 900;
    font-size: 15px;
}

.resume {
    background-color: #fff;
    height: 150px;
    box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
}

.apply {
    display: flex;
    align-items: flex-end;
    justify-content: end;
    margin-top: 15px;
}

.apply input,
.apply button {
    height: 40px;
    width: 80%;
    text-transform: uppercase;
    border-radius: 5px;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-weight: 900;
}

.apply input #disable {
    cursor: not-allowed !important;
}

.apply button {
    pointer-events: none;
    opacity: 0.7
}

.apply span {
    cursor: not-allowed;
} 
.report{
    margin-left:55%; 
    font-size: 1.5rem; 
}
.report:hover{
    color: red;
}
</style>

<div class="container">
    <div class="row">
        <div class="col-lg-12 details">

            <?php
$jobid = $_GET['jobid'];
$query = mysqli_query($conn, "SELECT jobs.empid, jobs.jobid, categories.name as 'catname', employers.company_name as 'cname',
            jobs.job_title, jobs.job_description, jobs.employees_needed, jobs.duration, jobs.salary, jobs.qualification, jobs.preffered_sex, jobs.address, jobs.postedOn
            FROM jobs
            INNER JOIN categories ON categories.catid = jobs.catid
            INNER JOIN employers ON employers.empid = jobs.empid
            WHERE jobs.jobid = $jobid ");
$jobdata = mysqli_fetch_array($query);
?>

            <div class="heading-job" style="display: grid; width:100%; grid-template-columns:80% 20%;">
                <h3> <?=$jobdata['cname'];?> is now looking for <?=$jobdata['job_title'];?></h3>
                <div style="display: flex; justify-content:center; align-items:center"> <span class="report fa-regular fa-flag" aria-label="Report this job" title="Report job" data-toggle="modal" data-target="#exampleModal"></span></div> 
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <p><i class="fa-solid fa-caret-right"></i> <span> Category: </span> <?=$jobdata['catname'];?> </p>
                    <p><i class="fa-solid fa-caret-right"></i> <span> Employees Needed: </span>
                        <?=$jobdata['employees_needed'];?> </p>
                    <p><i class="fa-solid fa-caret-right"></i> <span> Category: </span> <?=$jobdata['salary'];?> </p>
                </div>

                <div class="col-md-6">
                    <p><i class="fa-solid fa-caret-right"></i> <span> Employment Status: </span>
                        <?php
$date = $jobdata['postedOn'];
$duration = $jobdata['duration'];

if (strtotime($date) < strtotime($duration)) {
    echo "On going until" . " " . date("M j, Y", strtotime($duration));
} else {
    echo "Employment ended on " . " " . date("M j, Y", strtotime($duration));
}
?>
                    </p>
                    <p><i class="fa-solid fa-caret-right"></i> <span> Preffered Gender: </span>
                        <?=$jobdata['preffered_sex'];?> </p>
                    <p><i class="fa-solid fa-caret-right"></i> <span> Location: </span> <?=$jobdata['address'];?> </p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <h5>Job Description</h5>
                </div>

                <div class="col-lg-12">
                    <p> <?=nl2br($jobdata['job_description']);?> </p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <h5>Qualifications</h5>
                </div>

                <div class="col-lg-12">
                    <p> <?=nl2br($jobdata['qualification']);?> </p>
                </div>
            </div>

        </div>
    </div>

    <br>

    <form action="connections/apply_job.php" id="formApply" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-12 resume">

                <h3> <i class="fa-solid fa-paperclip"></i> Upload Your Resume (optional) </h3>
                <hr>
                <p class="statusMsg"></p>
                <input type="hidden" name="empid" id="empid" value="<?=$jobdata['empid']?>">
                <input type="hidden" name="jobid" id="jobid" value="<?=$_GET['jobid']?>">
                <input type="hidden" name="jsid" id="jsid" value="<?=$fetch['jsid']?>">
                <input type="file" class="form-control" id="file" name="file">
            </div>
        </div>

        <div class="row apply">
            <div class="col-lg-10"></div>
            <div class="col-lg-2">

                <?php
$date = $jobdata['postedOn'];
$duration = $jobdata['duration'];

if (strtotime($date) < strtotime($duration)) {
    echo "<input type='submit' name='submit' value='Apply' class='submitBtn' id='apply' style='background-color: #77A6F7;' >";
} else {
    echo "<span> <button style='background: #ccc'> Apply </button> </span>";
}
?>

            </div>
        </div>

    </form>

</div>

<br>

<?php include 'message.php';?>

<!-- Modal -->
<div class="modal fade" style="margin-top: 5%;" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> <strong> Report Job </strong>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> </h5>
      </div>
      <div class="modal-body">
        <div class="select-reason">
            <p>Please select the reason why you want to report this job.</p>
            <form action="connections/report.php" id="rpForm">
            
            <input type="hidden" name="rp_jobid" id="rp_jobid" value="<?=$_GET['jobid'];?>">
            <select name="reason" id="reason"  class="form-control" required>
                <option value="Differently-abled persons discrimination">Differently-abled persons discrimination</option>
                <option value="Inapropriate job description for differently-abled persons">Inapropriate job description for differently-abled persons</option>
                <option value="Age/Gender Discrimination">Age/Gender Discrimination</option>
                <option value="Language/Civil Status Discrimination">Language/Civil Status Discrimination</option>
                <option value="Other reasons">Other reasons</option>
            </select>
        </div>

        <div class="input-reason" style="display: none;">
            <p>Please specify your reason here:</p>
            <textarea type="text" name="other_reason" id="other_reason" class="form-control" style="height: 20%;"> </textarea>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" id="cancelBTN" class="btn" style="background-color: #f3f3f3; border:none; color:black">Cancel</button>
        <input type="submit" name="rp_btn" id="rp_btn" class="btn" style="background-color: #77A6F7; border:none" value="Submit Report" >
      </div>
      </form>  
    </div>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>

<script>
$(document).ready(function() {

    $("#rpForm").submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'connections/report.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                if (response == 'ok') {
                    alert('Your report has been sent. We will take actions to this matter after we review this job.');
                    $('#rpForm')[0].reset();
                    window.location.reload();
                } else {
                    $('#error').show();
                }
            }
        });
    });

    $('#cancelBTN').on("click", function(){
        $('#rpForm')[0].reset();
        $(".input-reason").hide();
    });

    $(function(){

        $("#reason").change(function(){
            var reason = $(this).val();
            if (reason === "Other reasons"){
                $(".input-reason").slideDown();
            } else{
                $(".input-reason").hide();
            }
        });

    });

    $("#formApply").on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'connections/apply_job.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(msg) {
                $('.statusMsg').html('');
                if (msg == 'ok') {
                    $('#formApply')[0].reset();
                    $('#success').show();
                } else if (msg == 'applied') {
                    $('#formApply')[0].reset();
                    $('#applied').show();
                } else {
                    $('#error').show();
                }
            }
        });
    });

    //file type validation
    $("#file").change(function() {
        var file = this.files[0];
        var fileType = file.type;
        var match = ["application/msword", "application/pdf", "application/vnd.ms-powerpoint",
            "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
            "application/vnd.openxmlformats-officedocument.presentationml.presentation"
        ];
        if (!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType ==
                match[3]) || (fileType == match[4]))) {
            $('#file_error').show();
            $("#file").val('');
            return false;
        }
    });


    $('#a_button').on('click', function(e) {
        e.preventDefault();
        $('#applied').fadeOut();
    });

    $('#e_button').on('click', function(e) {
        e.preventDefault();
        $('#error').fadeOut();
    });

    $('#f_button').on('click', function(e) {
        e.preventDefault();
        $('#file_error').fadeOut();
    });

    $('#s_button').on('click', function(e) {
        e.preventDefault();
        $('#success').fadeOut();
    });

});
</script>


<footer> <?php include 'includes/footer.php';?> </footer>

