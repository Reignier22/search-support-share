<?php  
$page_title = "Employer | Post Job Page";
include("include/header.php"); 
include("connections/config.php")
?>
<link rel="stylesheet" href="assets/css/jobs.css?v=1">


    <main style="padding-top:55px; min-height: calc(110vh - 70px);">
        <div>
            <h1 style="font-weight: 900 ;">Job Vacancy</h1>
            <small>Start sharing job vacancy to diffrently-abled persons by clicking the add job button.</small>
        </div>

        <form action="connections/jobs.php" method="post">

            <div class="grid-container" id="container" >
            
            <?php 
                $query = mysqli_query($conn, "SELECT * FROM `employers` WHERE `empid`='$_SESSION[empid]'");
                $row = mysqli_fetch_array($query);
            ?>

                <div class="grid-item">
                    <label for="title"> Job Title </label>
                    <input type="hidden" name="empid"  value="<?=$row['empid']?>" id="empid"> 
                    <input type="text"  value="" name="title" class="input" id="title" placeholder="Job Title">
                    <span class="fa-sharp fa-solid fa-circle-check success" id="success"></span>
                    <span class="fa-solid fa-circle-exclamation error" id="error"></span>
                    <p id="errorMsg" class="errMsg"></p>
                </div>

                <div class="grid-item">
                    <label for="employees"> Employees Needed </label>
                    <input name="employees" class="input" type="number" id="employees"  placeholder="Employees Needed">
                    <span class="fa-sharp fa-solid fa-circle-check success" id="esuccess"></span>
                    <span class="fa-solid fa-circle-exclamation error" id="eerror"></span>
                    <p id="errorEmp" class="errMsg"></p>
                </div>

                <div class="grid-item">
                    <label for="duration"> Duration of Employment </label>
                    <input type="date" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>"  name="duration" id="duration" placeholder="Duration of Employment">
                    <span class="fa-sharp fa-solid fa-circle-check success" id="dsuccess"></span>
                    <span class="fa-solid fa-circle-exclamation error" id="derror"></span>
                    <p id="errorDur" class="errMsg"></p>
                </div>

                <div class="grid-item">
                    <label for="Salary"> Salary Range </label>
                    <input type="text"  value="" name="salary" id="salary" placeholder="Salary">
                    <span class="fa-sharp fa-solid fa-circle-check success" id="ssuccess"></span>
                    <span class="fa-solid fa-circle-exclamation error" id="serror"></span>
                    <p id="errorSal" class="errMsg"></p>
                </div>

                <div class="grid-item">
                    <label for="gender"> Preferred Gender of Applicants </label>
                    <select name="gender" id="gender" class="form-control">
                        <option value="Male">Anyone</option>
                        <option value="Female">Male</option>
                        <option value="Anyone">Female</option>
                    </select>
                    <span class="fa-sharp fa-solid fa-circle-check success" id="gsuccess"></span>
                    <span class="fa-solid fa-circle-exclamation error" id="gerror"></span>
                    <p id="errorGen" class="errMsg"></p>
                </div>

                <div class="grid-item">
                    <label for="category"> Disability Category </label>
                        <select name="catid" id="catid"  class="form-control">
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
                    <span class="fa-sharp fa-solid fa-circle-check success" id="csuccess"></span>
                    <span class="fa-solid fa-circle-exclamation error" id="cerror"></span>
                    <p id="errCat" class="errMsg"></p>
                </div>

                <div class="grid-item">
                    <label for="description" style="white-space: pre-wrap;"> Description </label>
                    <textarea name="description" id="description" class="form-control"  placeholder="Job Description" oninput="auto_grow(this)"></textarea>
                    <span class="fa-sharp fa-solid fa-circle-check success" id="desuccess"></span>
                    <span class="fa-solid fa-circle-exclamation error" id="deerror"></span>
                    <p id="errorDes" class="errMsg"></p>
                </div>

                <div class="grid-item">
                    <label for="qualification" style="white-space: pre-wrap;"> Qualification </label>
                    <textarea name="qualification" id="qualification" class="form-control" placeholder="Qualification" oninput="auto_grow(this)"></textarea>
                    <span class="fa-sharp fa-solid fa-circle-check success" id="qsuccess"></span>
                    <span class="fa-solid fa-circle-exclamation error" id="qerror"></span>
                    <p id="errorQua" class="errMsg"></p>
                </div>

                <div class="grid-item">
                    <label for="location"> Location </label>
                    
                    <?php 
                        if($fetch['company_loc'] == NULL){
                            ?>
                                <textarea name="address" id="location" class="form-control" placeholder="Location" oninput="auto_grow(this)"></textarea>
                            <?php
                        } else{
                            ?>
                                <textarea readonly name="address" id="location" class="form-control" placeholder="Location" oninput="auto_grow(this)"> <?= $fetch['company_loc'] ?> </textarea>
                            <?php
                        }
                    ?>

                    <span class="fa-sharp fa-solid fa-circle-check success" id="lsuccess"></span>
                    <span class="fa-solid fa-circle-exclamation error" id="lerror"></span>
                    <p id="errorLoc" class="errMsg"></p>
                </div>

            <div class="grid-item"></div>
            <div class="grid-item"></div>
            <div class="grid-item button-save">
                <input type="submit" class="save" id="save_btn" name="addjob" value="Add Job">
            </div>

            </div>

        </form>

    </main>

<script>
    function auto_grow(element) {
    element.style.height = "5px";
    element.style.height = (element.scrollHeight)+"px";
    }
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script>
$(document).ready(function(){

    $("#title").on("keyup", function(e) {
            
        if($(this).val() == "") {
            $("#errorMsg").html('This field is required');
            $(this).css('outline-color', '#ff0000');
            $(this).css('border', '2px solid #ff0000')
            $("#error").show();
            $("#success").hide();
             return false;
        } else {
            $(this).css('outline-color', 'green');
            $(this).css('border', '2px solid green')
            $("#success").show();
            $("#error").hide();
            $("#errorMsg").html('');
            return true;
        }
    });

    $("#employees").on("keyup", function(e) {
        if($(this).val() == "") {
            $("#errorEmp").html('This field is required');
            $(this).css('outline-color', '#ff0000');
            $(this).css('border', '2px solid #ff0000');
            $("#eerror").show();
            $("#esuccess").hide();
            return false;
        } else if($(this).val() == "0"){
            $("#errorEmp").html('Input numbers greater than 0');
            $(this).css('outline-color', '#ff0000');
            $(this).css('border', '2px solid #ff0000');
            $("#eerror").show();
            $("#esuccess").hide();
            return false;
        } else {
            $(this).css('outline-color', 'green');
            $(this).css('border', '2px solid green');
            $("#esuccess").show();
            $("#eerror").hide();
            $("#errorEmp").html('');
            return true;
        }
    });
   
    $("#duration").on("keyup change", function(e) {
        var now = (new Date()).toISOString().split('T')[0];
        if($(this).val() == "") {
            $("#errorDur").html('This field is required');
            $(this).css('outline-color', '#ff0000');
            $(this).css('border', '2px solid #ff0000');
            $("#derror").show();
            $("#dsuccess").hide();
            return false;
        } else if($(this).val() <= now){
            $("#errorDur").html('Input upcoming dates only');
            $(this).css('outline-color', '#ff0000');
            $(this).css('border', '2px solid #ff0000');
            $("#derror").show();
            $("#dsuccess").hide();
            return false;
        } else {
            $(this).css('outline-color', 'green');
            $(this).css('border', '2px solid green');
            $("#dsuccess").show();
            $("#derror").hide();
            $("#errorDur").html('');
            return true;
        }
    });

    $("#salary").on("keyup", function(e) {
        if($(this).val() == "") {
            $("#errorSal").html('This field is required');
            $(this).css('outline-color', '#ff0000');
            $(this).css('border', '2px solid #ff0000');
            $("#serror").show();
            $("#ssuccess").hide();
            return false;
        } else if($(this).val() == "0"){
            $("#errorSal").html('Input numbers greater than 0');
            $(this).css('outline-color', '#ff0000');
            $(this).css('border', '2px solid #ff0000');
            $("#serror").show();
            $("#ssuccess").hide();
            return false;
        } else {
            $(this).css('outline-color', 'green');
            $(this).css('border', '2px solid green');
            $("#ssuccess").show();
            $("#serror").hide();
            $("#errorSal").html('');
            return true;
        }
    });

    $("#gender").on("change", function(e) { 
        $(this).css('border-color', 'green');
        $("#gsuccess").show();
        $("#gerror").hide();
        $("#errorGen").html('');
        return true;
    });

    $("#catid").on("change", function(e) {
        $(this).css('border-color', 'green');
        $("#csuccess").show();
        $("#cerror").hide();
        $("#errCat").html('');
        return true;
    });

    $("#description").on("keyup", function(e) {
        if($(this).val() == "") {
            $("#errorDes").html('This field is required');
            $(this).css('border-color', '#ff0000');
            $("#deerror").show();
            $("#desuccess").hide();
            return false;
        } else {
            $(this).css('border-color', 'green');
            $("#desuccess").show();
            $("#deerror").hide();
            $("#errorDes").html('');
            return true;
        }
    });

    $("#qualification").on("keyup", function(e) {
        if($(this).val() == "") {
            $("#errorQua").html('This field is required');
            $(this).css('border-color', '#ff0000');
            $("#qerror").show();
            $("#qsuccess").hide();
            return false;
        } else {
            $(this).css('border-color', 'green');
            $("#qsuccess").show();
            $("#qerror").hide();
            $("#errorQua").html('');
            return true;
        }
    });

    $("#location").on("keyup", function(e) {
        if($(this).val() == "") {
            $("#errorLoc").html('This field is required');
            $(this).css('border-color', '#ff0000');
            $("#lerror").show();
            $("#lsuccess").hide();
            return false;
        } else {
            $(this).css('border-color', 'green');
            $("lsuccess").show();
            $("#lerror").hide();
            $("#errorLoc").html('');
            return true;
        }
    });


    $('#save_btn').on('click', function(e){
        e.preventDefault();
        var now = (new Date()).toISOString().split('T')[0];
        var title = $('#title').val();
        var employees = $('#employees').val();
        var duration = $('#duration').val();
        var salary = $('#salary').val();
        var gender = $('#gender').val();
        var catid = $('#catid').val();
        var empid = $('#empid').val();
        var description = $('#description').val();
        var qualification = $('#qualification').val();
        var location = $('#location').val();

       if (title == "" || employees == "" || duration == "" || salary == "" || gender == "" || catid == "" || empid == "" || description == "" || qualification == "" || location == ""){
            $("#errorMsg").html('This field is required');
            $("#error").show();
            $("#success").hide();

            $("#errorEmp").html('This field is required');
            $("#eerror").show();
            $("#esuccess").hide();

            $("#errorDur").html('This field is required');
            $("#derror").show();
            $("#dsuccess").hide();

            $("#errorSal").html('This field is required');
            $("#serror").show();
            $("#ssuccess").hide();

            $("#errorGen").html('This field is required');
            $("#gerror").show();
            $("#gsuccess").hide();

            $("#errCat").html('This field is required');
            $("#cerror").show();
            $("#csuccess").hide();

            $("#errorDes").html('This field is required');
            $("#deerror").show();
            $("#desuccess").hide();

            $("#errorQua").html('This field is required');
            $("#qerror").show();
            $("#qsuccess").hide();

            $("#errorLoc").html('This field is required');
            $("#lerror").show();
            $("#lsuccess").hide();

        } else if(duration <= now) {
            $("#errorDur").html('Input upcoming dates only');
            $("#derror").show();
            $("#dsuccess").hide();
        } else if(salary == "0"){
            $("#errorSal").html('Input numbers greater than 0');
            $("#serror").show();
            $("#ssuccess").hide();
        } else if (employees == "0") {
            $("#errorEmp").html('Input numbers greater than 0');
            $("#eerror").show();
            $("#esuccess").hide();
        }
       
        else{

        $.ajax({
                url: 'connections/jobs.php',
                method: 'POST',
                data: {
                addjob: 1,
                titlePHP: title,
                employeesPHP: employees,
                durationPHP: duration,
                salaryPHP: salary,
                genderPHP: gender,
                catidPHP: catid,
                empidPHP: empid,
                descriptionPHP: description,
                qualificationPHP: qualification,
                locationPHP: location,
            },
            success: function(response) {
                if (response=='Yes'){
                    alert('A new job has been added');
                    window.location.replace("add_job.php")
                } else{
                    alert('Failed to add the job');
                }
            },
            dataType: 'text'
         });
        }
    });
    
});
</script>

<?php include("include/footer.php") ?>
