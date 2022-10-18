<?php 
$page_title = '3S | Registration Page';
?>

 
<?php 
    include 'includes/header.php'; 
    $jumbo_title = 'Registration';
    include 'includes/pages.php'
?>   


<link rel="stylesheet" href="assets/register/multistep.css">

<style>
    input[type="date"]::-webkit-inner-spin-button,
    input[type="date"]::-webkit-calendar-picker-indicator {
        display: none;
        -webkit-appearance: none;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }


    .errMsg{
        padding-right: 8px;
        text-align: right;
        color: red;
    }
    .errspan {
        display: none;
        float: right;
        margin-right: 10px;
        margin-top: -23px;
        position: relative;
        z-index: 2;
        color: red;
    }

    .sucspan{
        display: none;
        float: right;
        margin-right: 10px;
        margin-top: -23px;
        position: relative;
        z-index: 2;
        color: green;
    }

    .errspan1 {
        display: none;
        float: right;
        margin-left: 5px;
        margin-right: -18px;
        margin-top: -23px;
        position: relative;
        z-index: 2;
        color: red;
    }

    .sucspan1{
        display: none;
        float: right;
        margin-left: 5px;
        margin-right: -18px;
        margin-top: -23px;
        position: relative;
        z-index: 2;
        color: green;
    }
    .work_div {
        display: grid;
        width:100%; 
        grid-template-columns:90% 10%;
        margin-bottom: 10px;
    }
    .button_add{
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .button_add:hover{
        text-decoration: none;
    }
    .add_button i{
        font-size: 2rem;
        color: #77A6F7;
    }
    .remove_button i{
        font-size: 2rem;
        color: red;
    }

    textarea{
        resize: none;
    }
</style>

    

</style>

<div class="container">

<div id="multi-step-form-container">
        <!-- Form Steps / Progress Bar -->
        <ul class="form-stepper form-stepper-horizontal text-center mx-auto pl-0">
            <!-- Step 1 -->
            <li class="form-stepper-active text-center form-stepper-list" step="1">
                <a class="mx-2">
                    <span class="form-stepper-circle">
                        <span>1</span>
                    </span> <br> <br>
                    <div class="label">Personal Information</div>
                </a>
            </li>
            <!-- Step 2 -->
            <li class="form-stepper-unfinished text-center form-stepper-list" step="2">
                <a class="mx-2">
                    <span class="form-stepper-circle text-muted">
                        <span>2</span> 
                    </span> <br><br>
                    <div class="label text-muted"> Other Information </div>
                </a>
            </li>
            <!-- Step 3 -->
            <li class="form-stepper-unfinished text-center form-stepper-list" step="3">
                <a class="mx-2"> 
                    <span class="form-stepper-circle text-muted">
                        <span>3</span>
                    </span> <br><br>
                    <div class="label text-muted"> Login Information </div>
                </a>
            </li>
        </ul>
        <!-- Step Wise Form Content -->
<form id="registerForm" action="connections/register.php" method="POST" >
            <!-- Step 1 Content -->
            <section id="step-1" class="form-step">
                <h2 class="font-normal">Personal Information</h2>
                <!-- Step 1 input fields -->
                <div class="mt-3">
                
                <div class="row">

                    <div class="col-sm-4">
                        <label for="firstname">First Name</label>
                        <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter firstname" onkeyup="validatefName()">
                        <span class="fa-solid fa-circle-exclamation errspan" id="errspan"></span>
                        <span class="fa-solid fa-circle-check sucspan" id="sucspan"></span>
                        <p id="errorFname" class="errMsg"></p>
                    </div>

                    <div class="col-sm-4">
                        <label for="middlename">Middle Name</label>         
                        <input type="text" name="middlename" id="middlename" class="form-control" placeholder="Enter middle name" onkeyup="validatemName()">
                        <span class="fa-solid fa-circle-exclamation errspan" id="merr"></span>
                        <span class="fa-solid fa-circle-check sucspan" id="msuc"></span>
                        <p id="errorMname" class="errMsg"></p>
                    </div>

                    <div class="col-sm-4">
                        <label for="lastname">Last Name </label>
                        <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter lastname" onkeyup="validatelName()">
                        <span class="fa-solid fa-circle-exclamation errspan" id="lerr"></span>
                        <span class="fa-solid fa-circle-check sucspan" id="lsuc"></span>
                        <p id="errorLname" class="errMsg"></p>
                    </div>

                </div>

                <div class="row row2">
                    <div class="col-sm-4"> 
                        <label for="birthday">Birthday </label> 

                        <div class="grid" style="display:grid; width:100%; grid-template-columns: 47% 20% 30% ; gap: 5px; ">
                            <div class="gid-a">
                                <?php
                                    $selected_month = date('m'); //current month
                                    echo '<select id="month" name="month" class="form-control">' . "\n";
                                        for ($i_month = 1; $i_month <= 12; $i_month++) {
                                            $selected = ($selected_month == $i_month ? ' selected' : '');
                                            echo '<option value="' . $i_month . '"' . $selected . '>' . date('F', mktime(0, 0, 0, $i_month)) . '</option>' . "\n";
                                        }
                                    echo '</select>' . "\n";
                                ?>
                            </div>

                            <div class="grid-b">
                                <?php 
                                    $selected_day = date('d'); //current day
                                    echo '<select id="day" name="day" class="form-control"  >' . "\n";
                                        for ($i_day = 1; $i_day <= 31; $i_day++) {
                                            $selected = ($selected_day == $i_day ? ' selected' : '');
                                            echo '<option value="' . $i_day . '"' . $selected . '>' . $i_day . '</option>' . "\n";
                                        }
                                    echo '</select>' . "\n";
                                ?>
                            </div>

                            <div class="grid-c">
                                <input type="text" name="year" id="year" class="form-control" placeholder="YYYY" onkeyup="validateBday()">                                         
                            </div>

                        </div>

                        <!-- <input type="date" name="birthday" class="form-control" id="birthday" onkeyup="validateBday()"> -->
                        <span class="fa-solid fa-circle-exclamation errspan" id="berr"></span>
                        <span class="fa-solid fa-circle-check sucspan" id="bsuc"></span>
                        <p id="errorBday" class="errMsg"></p>
                    </div>

                    <div class="col-sm-4">
                        <label for="civili_status">Civil Status </label> 
                        <select name="civil_status" id="civil_status" class="form-control" onchange="select()" required>
                            <option  value="Single">Single</option>
                            <option  value="Married">Married</option>
                            <option  value="Widowed">Widowed</option>
                            <option  value="Separated">Separated</option>
                        </select>

                        <span class="fa-solid fa-circle-exclamation errspan1"  id="serr"></span>
                        <span class="fa-solid fa-circle-check sucspan1" id="ssuc"></span>

                    </div>

                    <div class="col-sm-4">
                        <label for="gender">Sex </label>
                        <select name="gender" id="gender" class="form-control" onchange="selectGender()" required >            
                            <option value="Prefer not to say">Prefer not to say</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>

                        <span class="fa-solid fa-circle-exclamation errspan1" id="gerr"></span>
                        <span class="fa-solid fa-circle-check sucspan1" id="gsuc"></span>

                    </div>

                </div>


                </div>
                <div class="mt-3">
                    <button class="button btn-navigate-form-step" type="button" step_number="2">Next</button>
                </div>
            </section>
            <!-- Step 2 Content, default hidden on page load. -->
            <section id="step-2" class="form-step d-none">
                <h2 class="font-normal">Other Information </h2>
                <!-- Step 2 input fields -->
                <div class="mt-3">

                <div class="row">
                    <div class="col-sm-6">
                        <label for="contact">Contact Number </label>
                        <input type="number" name="contact" id="contact" class="form-control" placeholder="+63" onkeyup="validateContact()">
                        <span class="fa-solid fa-circle-exclamation errspan" id="cerr"></span>
                        <span class="fa-solid fa-circle-check sucspan" id="csuc"></span>
                        <p id="errorContact" class="errMsg"></p>
                    </div>
                    
                    <div class="col-sm-6">
                        <label for="attainment">Highest Educational Attainment </label>
                        <select name="attainment" id="attainment" class="form-control" onchange="selectEduc()" required >
                            <option value="Elementary">Elementary</option>
                            <option value="Junior High School">Junior High School</option>
                            <option value="Senior High School">Senior High School</option>
                            <option value="College">College</option>
                            <option value="Postgraduate">Postgraduate</option>
                            <option value="Doctoral">Doctoral</option>
                        </select>
                        <span class="fa-solid fa-circle-exclamation errspan1" id="eerr"></span>
                        <span class="fa-solid fa-circle-check sucspan1" id="esuc"></span>
                    </div>

                </div>

                <div class="row row2">

                    <div class="col-md-6">
                        <label for="address">Home Address </label>

                        <div style="display: grid; grid-template-columns:repeat(3,1fr); gap:5px">
                            <div>
                                <input type="text" name="hs" id="address" placeholder="House no/ Street/" id="hs" class="form-control" onkeyup=" validateAddress()">
                            </div>
                            <div>
                                <select name="brgy" id="brgy" class="form-control">
                                    <option value="Anibong">Anibong</option>
                                    <option value="Biñan">Biñan</option>
                                    <option value="Buboy">Buboy</option>
                                    <option value="Cabanbanan">Cabanbanan</option>
                                    <option value="Calusiche">Calusiche</option>
                                    <option value="Dingin">Dingin</option>
                                    <option value="Lambac">Lambac</option>
                                    <option value="Layugan">Layugan</option>
                                    <option value="Magdapio">Magdapio</option>
                                    <option value="Maulawin">Maulawin</option>
                                    <option value="Pinagsaŋjan">Pinagsaŋjan</option>
                                    <option value="Barangay I">Barangay I</option>
                                    <option value="Barangay II">Barangay II</option>
                                    <option value="Sabang">Sabang</option>
                                    <option value="Sampaloc">Sampaloc</option>
                                    <option value="San Isidro">San Isidro</option>
                                </select>
                            </div>
                            <div>
                                <input type="text" name="munp" id="munp" value="Pagsanjan Laguna" class="form-control" readonly>
                            </div>
                        </div>
                        <span class="fa-solid fa-circle-exclamation errspan" id="aerr"></span>
                        <span class="fa-solid fa-circle-check sucspan" id="asuc"></span>
                        <p id="errorAddress" class="errMsg"></p>

                    </div>
                    
                    <div class="col-sm-6">
                        <label for="work_experience">Work Experiences </label>
                        <div class="field_wrapper">
                            <div class="work_div">
                                <textarea name="field_name_1" id="work_experience" onkeyup="validateWork()" placeholder="Enter your work experience here" class="form-control"></textarea>
                                <span class="button_add">
                                    <a href="javascript:void(0);" class="add_button" title="Add field"><i class="fa-solid fa-square-plus"></i></a>
                                </span>
                            </div>
                        </div>
                        <span class="fa-solid fa-circle-exclamation errspan" id="werr"></span>
                        <span class="fa-solid fa-circle-check sucspan" id="wsuc"></span>
                        <p id="errorWork" class="errMsg"></p>
                    </div>

                    </div>
                   
                </div> <!--END MT-->
                <div class="mt-3">
                    <button class="button btn-navigate-form-step" type="button" step_number="1">Prev</button>
                    <button class="button btn-navigate-form-step" type="button" step_number="3">Next</button>
                </div>
            </section>
            <!-- Step 3 Content, default hidden on page load. -->
            <section id="step-3" class="form-step d-none">
                <h2 class="font-normal">Login Information </h2>
                <!-- Step 3 input fields -->
                <div class="mt-3">
                
                <div class="row">
                    <div class="col-sm-6">
                        <label for="Username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" onkeyup="validateUsername()">
                    
                        <span class="fa-solid fa-circle-exclamation errspan" id="uerr"></span>
                        <span class="fa-solid fa-circle-check sucspan" id="usuc"></span>
                        <p id="errorUsername" class="errMsg"></p>
                    </div>
                    <div class="col-sm-6">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" name="email" id="reg-email" placeholder="Enter email" onkeyup="validateEmail()">
                        <span class="fa-solid fa-circle-exclamation errspan" id="emerr"></span>
                        <span class="fa-solid fa-circle-check sucspan" id="emsuc"></span>
                        <p id="errorEmail" class="errMsg"></p>
                    </div>
                </div>

                <div class="row row2">
                    <div class="col-sm-6">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="reg-password" placeholder="Enter password" onkeyup="validatePass()">
                        <span class="fa-solid fa-circle-exclamation errspan" id="perr"></span>
                        <span class="fa-solid fa-circle-check sucspan" id="psuc"></span>
                        <p id="errorPass" class="errMsg"></p>
                    </div>

                    <div class="col-sm-6">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Re-enter your password" onkeyup="verifyPass()" >
                        
                        <span class="fa-solid fa-circle-exclamation errspan" id="conerr"></span>
                        <span class="fa-solid fa-circle-check sucspan" id="consuc"></span>
                        <p id="errorCon" class="errMsg"></p>
                    </div>

                </div>

                <div class="row">
                    <div class="col-sm-12"><p><input type="checkbox" id="checkme">&nbsp; <a href="terms.php">By signing up, I agree to the Terms and Conditions and Privacy Policy</a> </p></div>
                </div>

                </div><!--END MT-->
                <div class="mt-3"> 
                    <button class="button btn-navigate-form-step" type="button" step_number="2">Prev</button>
                    <input type="submit" class="button submit-btn" value="Register" id="register" name="register" >

                </div>
            </section>
</form>
    </div>

</div>
<br>

<?php include 'message.php'; include 'includes/terms.php'; ?>
<script src="assets/register/validate.js" ></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>

<script>
$(document).ready(function(){
    var maxField = 5; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append( '<div class="work_div"><textarea name="field_name_'+x+'" class="form-control" placeholder="Enter your work experience here"  /></textarea> <a href="javascript:void(0);" class="remove_button button_add"><i class="fa-solid fa-square-minus"></i></a> </div>'); 
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });

});

</script>

<script src="assets/register/script.js"></script>
<script src="assets/register/multistep.js"></script>

<?php include 'includes/footer.php' ?> 


