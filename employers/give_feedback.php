<?php  
include("connections/config.php");

$id = $_GET['appid'];

if(isset($_GET['appid'])){
    $query = mysqli_query($conn, "UPDATE `apply` SET `active_status`='1', `status`='reviewed by employer' WHERE appid = '$id'");
}

$head_query = mysqli_query($conn, "SELECT apply.appid, apply.jsid, job_seekers.first_name AS fn, job_seekers.middle_name as mn, job_seekers.last_name as ln
FROM apply INNER JOIN job_seekers ON job_seekers.jsid = apply.jsid WHERE apply.appid = $id ;");
$get = mysqli_fetch_array($head_query);

$page_title = "Applicant | " . $get['ln'] . " " . $get['fn']. " " . $get['mn'];
include("include/header.php"); 
?>

<link rel="stylesheet" href="assets/css/apply.css?v=1">

<main style="padding-top:55px; min-height: calc(110vh - 70px);">

<?php 
    $appid = $_GET['appid'];
    $sql = "SELECT apply.appid, apply.jobid, apply.jsid, apply.resume, apply.message, apply.status, apply.date_applied, apply.date_approved,
    job_seekers.profile as pic, job_seekers.first_name AS fname, job_seekers.middle_name as mname, job_seekers.last_name as lname, job_seekers.email as email,
    job_seekers.birthday as bday, job_seekers.civil_status as cs, job_seekers.gender as gen,
    job_seekers.address as address, job_seekers.contact_number as cn, job_seekers.work_experience_1 as we1, 
    job_seekers.work_experience_2 as we2, job_seekers.work_experience_3 as we3, job_seekers.work_experience_4 as we4, job_seekers.work_experience_5 as we5, job_seekers.attainment as att
    FROM apply 
    INNER JOIN job_seekers ON job_seekers.jsid = apply.jsid WHERE apply.status IN('application submitted', 'reviewed by employer') AND appid = '$appid'; ";  
    $query = mysqli_query($conn, $sql);
    $fetch = mysqli_fetch_array($query);
?>
    <div>
        <h1 style="font-weight: 900 ;">Applicant's Details</h1>
        <small >Start accepting diffrently-abled persons by clicking the actions. </small>
    </div>

    <div class="jobs">

    <div class="grid-container">

        <div class="grid-item">

            <div class="row">
                <div class="col-sm-4">
                    <img src="../profile_includes/profile_pic/<?php echo $fetch['pic']?>" alt="Applicant Image">
                </div>

                <div class="col-sm-8">
                    <h3> <?php echo $fetch['lname'] . ", " . $fetch['fname'] . ", " . $fetch['mname'] ?> </h3>
                    <p> <span class="fa-solid fa-envelope"></span> <?php echo $fetch['email'] ?> </p>
                    <p> <span class="fa-solid fa-phone"></span> <?php echo $fetch['cn'] ?>   </p>
                </div>

                <div class="row info">
                    <div class="col-sm-12"> 
                        <h3> Personal Information </h3>
                    </div>
                    <div class="col-sm-4 captions">
                        <p> Sex: </p>
                        <p> Age: </p>
                        <p> Civil Status: </p>
                        <p> Home Address:  </p>
                    </div>
                    <div class="col-sm-8">
                        <p> <?php echo $fetch['gen'] ?>  </p>
                        <p> <?php  $dob = $fetch['bday'];
                            $bday = new DateTime($dob);
                            $today = new DateTime(date('m.d.y'));
                            $diff = $today-> diff($bday);
                            printf(' %d years old ', $diff->y); ?> 
                        </p>
                        <p> <?php echo $fetch['cs'] ?> </p>
                        <p> <?php echo $fetch['address'] ?> </p>
                    </div>
                </div>

                <div class="row info">
                    <div class="col-sm-12"> 
                        <h3> Educational Attainment </h3>
                    </div>

                    <div class="col-sm-12">
                        <p> <?php echo $fetch['att'] ?> </p>
                    </div>

                </div>

                <div class="row info">
                    <div class="col-sm-12"> 
                        <h3> Work Experiences </h3>
                    </div>

                    <div class="col-sm-12">
                        <?php 
                        $we1 = $fetch['we1'];
                        $we2 = $fetch['we2'];
                        $we3 = $fetch['we3'];
                        $we4 = $fetch['we4'];
                        $we5 = $fetch['we5'];
                        if(!empty($we1)){
                            echo "<p>".$we1."</p>";
                        }
                        if(!empty($we2)){
                            echo "<p>".$we2."</p>";
                        }
                        if(!empty($we3)){
                            echo "<p>".$we3."</p>";
                        }
                        if(!empty($we4)){
                            echo "<p>".$we4."</p>";
                        }
                        if(!empty($we5)){
                            echo "<p>".$we5."</p>";
                        }
                        ?>

                        <p> <?php echo $fetch['we'] ?> </p>
                    </div>

                </div>

            </div>
        </div>

        <div class="grid-item item2">
            <div class="row">
                <div class="col-sm-12">
                    <h3> <span class="fa-solid fa-paperclip"></span> Attachnment File </h3>
                </div>
                <div class="col-sm-12">
                    <div class="download">
                    <?php 
                        if ($fetch['resume'] == "no resume added"){
                            ?>
                                <h3>The applicant did not submit any resume.</h3>
                            <?php
                        } else{
                            ?> 
                                <h3> View / Download Applicant's Resume <a href="../connections/uploads/<?php echo $fetch['resume'] ?>"> by clicking Here</a> </h3>
                            <?php
                        }
                    ?>

                       
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-12">
                    <h3>Feedback</h3>
                </div>

                <?php 
                        if ($fetch['status'] == 'application submitted' || $fetch['status'] == 'reviewed by employer'){
                            ?>
                                 <form action="connections/remarks.php" method="post">
                                    <div class="col-sm-12 remarks">
                                        <input type="hidden" name="appid" id="appid" value="<?php echo $_GET['appid']; ?>">
                                        <input type="hidden" name="empid" id="empid" value="<?php echo $_SESSION['empid'] ?>">
                                        <label for="remark">Remark</label>
                                        <select name="remark" id="remark-id" class="form-control ">
                                            <option selected="true" disabled="disabled"> Please select a remark </option>
                                            <option value="Congratulations, you are approved"> Congratulations, you are approved </option>
                                            <option value="You're shortlisted, you will be interviewed"> You're shortlisted, you will be interviewed </option>
                                            <option value="Sorry, you have been disapproved"> Sorry, you have been disapproved </option>
                                        </select>
                                    </div>

                                    <div class="col-sm-12 message" id="approve">
                                        <label for="approved">Requirement to be submitted by approved applicant</label>
                                        <textarea name="approved-message" class="form-control" id="approved-message" placeholder="Specify the requirements needed here" style="white-space: pre-wrap; padding:10px"></textarea>
                                        <br>
                                        <div class="buttons">
                                            <input type="submit" name="approve" id="approve-btn" class="approved" value="Approve" >
                                        </div>
                                    </div>

                                    <div class="col-sm-12 message" id="shortlisted">
                                        <label for="shortlisted">Details of the Interview and Requirements needed</label>
                                        <textarea name="short-message" class="form-control" id="short-message" placeholder="Specify the details of the interview and requirements needed here" style="white-space: pre-wrap; padding:10px"></textarea>
                                        <br>
                                        <div class="buttons">
                                            <input type="submit" name="shortlist" id="short-btn" class="short" value="Submit"> 
                                        </div>
                                    </div>

                                    <div class="col-sm-12 message" id="disapproved">
                                        <label for="disapproved">Reason of Disapproval</label>
                                        <textarea name="disapproved-message" class="form-control" id="disapproved-message" placeholder="Specify the reason of disaprroval here" style="white-space: pre-wrap; padding:10px"></textarea>
                                        <br>
                                        <div class="buttons">
                                            <input type="submit" name="disapprove" id="disapprove-btn" class="disapproved" value="Disapprove"> 
                                        </div>
                                    </div>
                                    
                                </div>
                                </form>

                            <?php
                        } else  {
                            ?>
                                <div class="col-sm-12 feedback">
                                    <label for="remark"> Remark </label>
                                    <p style="text-transform: capitalize; background-color: #ececec; padding:20px" > <?php 
                                        $date = $fetch['date_approved'];
                                        $dis = date("F j, Y", strtotime($date));
                                        echo $fetch['status'] . " - " . $dis ?> </p>

                                    <label for="message">Message</label>
                                    <p style = "background-color: #ececec; padding:20px"> <?= nl2br($fetch['message'])  ?> </p>
                                </div>

                            <?php
                        }  
                ?>            

               

        </div>

    </div>

    </div>


</main>

<script>
    $(document).ready(function(){

        $(function(){

            $("#remark-id").change(function(){
                var remark = $(this).val();
                if (remark === "Congratulations, you are approved"){
                    $("#approve").slideDown("slow");
                    $("#shortlisted").hide();
                    $("#disapproved").hide();
                } else if ( remark === "You're shortlisted, you will be interviewed"){
                    $("#shortlisted").slideDown("slow");
                    $("#approve").hide();
                    $("#disapproved").hide();
                } else if (remark === "Sorry, you have been disapproved"){
                    $("#disapproved").slideDown("slow");
                    $("#approve").hide();
                    $("#shortlisted").hide();
                }
            });

        });

        $("#approve-btn").on('click', function(e){
            e.preventDefault();
            var appid = $('#appid').val();
            var remark = $('#remark-id').val();
            var message = $('#approved-message').val();
            var empid = $("#empid").val();

            if (message == ""){
                alert('Please specify the requirements needed by approved applicant');
            } else{
                $.ajax({
                        url: 'connections/remarks.php',
                        method: 'POST',
                        data: {
                        approve : 1,
                        appidPHP : appid,
                        remarkPHP : remark,
                        messagePHP: message,
                        empidPHP: empid,
                    },
                    success: function(response) {
                        if (response == 'Yes'){
                            alert('Applicant has been approved');
                            window.location.reload();
                        }
                        else{
                            alert('Applicant was not approved');
                            window.location.reload();
                        }
                    },
                    dataType: 'text'
                });
            }

        });

        $("#short-btn").on('click', function(e){
            e.preventDefault();
            var appid = $('#appid').val();
            var remark = $('#remark-id').val();
            var smessage = $('#short-message').val();
            var empid = $("#empid").val();

            if (smessage == ""){
                alert('Please specify the details of the interview and requirements needed of the applicant');
            } else{
                $.ajax({
                        url: 'connections/remarks.php',
                        method: 'POST',
                        data: {
                        shortlist : 1,
                        appidPHP : appid,
                        remarkPHP : remark,
                        smessagePHP: smessage,
                        empidPHP: empid,
                    },
                    success: function(response) {
                        if (response == 'Yes'){
                            alert('Applicant has been shortlisted');
                            window.location.reload();
                        }
                        else{
                            alert('Applicant was not shortlisted');
                            window.location.reload();
                        }
                    },
                    dataType: 'text'
                });
            }

        });

        $("#disapprove-btn").on('click', function(e){
            e.preventDefault();
            var appid = $('#appid').val();
            var remark = $('#remark-id').val();
            var dmessage = $('#disapproved-message').val();
            var empid = $("#empid").val();

            if (dmessage == ""){
                alert('Specify the reason of disaprroval of the applicant');
            } else{
                $.ajax({
                        url: 'connections/remarks.php',
                        method: 'POST',
                        data: {
                        disapprove : 1,
                        appidPHP : appid,
                        remarkPHP : remark,
                        dmessagePHP: dmessage,
                        empidPHP: empid,
                    },
                    success: function(response) {
                        if (response == 'Yes'){
                            alert('Applicant has been disapproved');
                            window.location.reload();
                        }
                        else{
                            alert('Applicant was not disapproved');
                            window.location.reload();
                        }
                    },
                    dataType: 'text'
                });
            }

        });


    });

</script>


<?php include("include/footer.php") ?>