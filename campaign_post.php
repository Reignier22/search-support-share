 <?php
$page_title = '3S | Campaigns';
include 'connections/config.php';
include 'profile_includes/profile_head.php';
?>

<link rel="stylesheet" href="profile_includes/assets/css/campaigns.css">

<div class="col-md-9 campaigns">

    <div class="row campaign-info">
        <div class="ctitle">
            <h1> Campaign Posting </h1>
        </div>
    </div>

    <div class="row post-container">
    
    <div class="instruction">
        <p>Welcome to campaign posting, where you may upload a project that will be seen by potential contributors. You may begin by completing all of the fields and hitting the submit button.</p>
    </div>
            
    <div class="campaign__details1">
    <form enctype="multipart/form-data" id="fupForm" class="form">
        <div class="input-group" id="tgroup">
            <label for="project-title" class="placeholder">Project Title</label>
            <input type="hidden" name="jsid" id="jsid" value="<?php echo $_SESSION['userid']; ?>">
            <input type="text" name="project_title" id="project_title" placeholder="Project title" class="input" required> 
        </div>
    </div>

    <div class="campaign__details2">
        <div class="input-group" id="pgoal">
            <label for="target" class="placeholder">Project Goal</label>
            <input type="number" name="project_goal" id="project_goal" placeholder="Project goal" class="input" required> 
        </div>
    </div>

    <div class="campaign__details3">
        <div class="input-group">
            <label for="target" class="placeholder">QR Code</label>
            <input type="file" name="qr_code" id="qr_code" class="input" required>
        </div>
    </div>

    <div class="campaign__details4">
        <div class="input-group" id="dgroup">
            <label for="description" class="placeholder"> Project Description <span id="message-error" style="font-weight: 400; padding-right:5px"></span> </label>  
            <textarea name="project_description" id="project_description" placeholder="Explain everything about your project in at least 200 characters" class="textarea"
             style="white-space: pre-wrap;" oninput="auto_grow(this)" onkeyup="validateMessage()" required></textarea>
        </div>
    </div>

    <div class="campaign__details5">
        <div class="input-group">
            <label for="duedate" class="placeholder target">Target End Date of Campaign</label> <br>
            <?php
                $selected_month = date('m'); //current month
                echo '<select id="month" name="month" class="select" >' . "\n";
                    for ($i_month = 1; $i_month <= 12; $i_month++) {
                        $selected = ($selected_month == $i_month ? ' selected' : '');
                        echo '<option value="' . $i_month . '"' . $selected . '>' . date('F', mktime(0, 0, 0, $i_month)) . '</option>' . "\n";
                    }
                echo '</select>' . "\n";

                $selected_day = date('d'); //current day
                echo '<select id="day" name="day" class="select day" >' . "\n";
                    for ($i_day = 1; $i_day <= 31; $i_day++) {
                        $selected = ($selected_day == $i_day ? ' selected' : '');
                        echo '<option value="' . $i_day . '"' . $selected . '>' . $i_day . '</option>' . "\n";
                    }
                echo '</select>' . "\n";

                $year_start = date('Y');
                $year_end = $year_start + 1; // current Year

                echo '<select id="year" name="year" class="select year" >' . "\n";
                    for ($i_year = $year_start; $i_year <= $year_end; $i_year++) {
                        $selected = ($user_selected_year == $i_year ? ' selected' : '');
                        echo '<option value="' . $i_year . '"' . $selected . '>' . $i_year . '</option>' . "\n";
                    }
                echo '</select>' . "\n";
            ?> <br>
        </div>
    </div>
        
    <div class="campaign__details12">
        <div class="input-group">
            <label for="banners" class="placeholder banner"> Project Banners <br>
                <span style="font-weight: 100;"> Please select three banners to attract more contributors. You can preview the image if you select a file.</span>
            </label>
        </div>
    </div> 

    <div class="campaign__details8 file_upload">
        <img src="profile_includes/assets/img/image_placeholder.png" id="image1" alt="Banner">
        <div class="image-input">
            <input type="file" name="banner1" id="banner1" class="input image" onchange="preview1()" required>
        </div>
    </div>

    <div class="campaign__details9 file_upload">
        <img src="profile_includes/assets/img/image_placeholder.png" id="image2" alt="Banner">
        <div class="image-input">
            <input type="file" name="banner2" id="banner2" class="input image" onchange="preview2()"  required>
        </div>
    </div>  

    <div class="campaign__details0 file_upload">
        <img src="profile_includes/assets/img/image_placeholder.png" id="image3" alt="Banner">
        <div class="image-input">
            <input type="file" name="banner3" id="banner3" class="input image" onchange="preview3()"  required>
        </div>
    </div>
    
    <div class="campain__details11">
        <input type="submit" name="post_campaign" class="button-59 submitBtn" id="post_campaign" value="Upload Campaign">
    </div>    
            
    </form>

    </div> <!-- post-container-end -->
</div> <!-- campaigns-end -->

<script>
    var messageError = document.getElementById('message-error');
    function validateMessage() {
    var message = document.getElementById('project_description').value;
    var start = 0;
    var left = start + message.length;

    if (left < 200) {
        messageError.style.color = "#ff0000";
        messageError.innerHTML = left + '/200 minimun characters';
        return false;
    } else if (left >= 200 ) {
        messageError.style.color = "green";
        messageError.innerHTML = left + '/3000 maximum characters';
        return true;
    }
}
</script>

<script>
    $(document).ready(function(e) {
        $("#fupForm").on('submit', function(e) {
            e.preventDefault();

            var project_description = $('#project_description').val();
            var year = $("#year").val();
            var day = $("#day").val();
            var month = $("#month").val();
            var date = year + "/" + month + "/" + day;

            var now = new Date();
            var dateSelected = new Date(date);
            
            if (project_description.length < 200){
                alert('Please add more characters');
            }else if(dateSelected <= now) {
                alert("Invalid date. You cannot input current and past dates.");
            } else{
                    $.ajax({
                    type: 'POST',
                    url: 'connections/campaigns.php',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $('.submitBtn').attr("disabled", "disabled");
                        $('#fupForm').css("opacity", ".5");
                    },
                    success: function(msg) {
                        if (msg == 'ok') {
                            $('#fupForm')[0].reset();
                            alert('Your campaign has been uploaded successfully.');
                            window.location.reload();
                        } else {
                            alert('Some problem occurred, please try again.');
                        }
                        $('#fupForm').css("opacity", "");
                        $(".submitBtn").removeAttr("disabled");
                    }
                });
            }
        });

        //qr type validation
        $("#qr_code").change(function() {
            var qr_code = this.files[0];
            var qr_codeFile = qr_code.type;
            var match = ["image/jpeg", "image/png", "image/jpg"];
            if (!((qr_codeFile == match[0]) || (qr_codeFile == match[1]) || (qr_codeFile == match[2]))) {
                alert('Please select a valid QR Code (JPEG/JPG/PNG).');
                $("#qr_code").val('');
                return false;
            }
        });

        //banner 1 type validation
        $("#banner1").change(function() {
            var banner1 = this.files[0];
            var banner1File = banner1.type;
            var match = ["image/jpeg", "image/png", "image/jpg"];
            if (!((banner1File == match[0]) || (banner1File == match[1]) || (banner1File == match[2]))) {
                alert('Please select a valid banner file (JPEG/JPG/PNG).');
                $("#banner1").val('');
                return false;
            }
        });

        //qr type validation
        $("#banner2").change(function() {
            var banner2 = this.files[0];
            var banner2File = banner2.type;
            var match = ["image/jpeg", "image/png", "image/jpg"];
            if (!(( banner2File == match[0]) || (banner2File == match[1]) || (banner2File == match[2]))) {
                alert('Please select a valid banner file (JPEG/JPG/PNG).');
                $("#banner2").val('');
                return false;
            }
        });

        //qr type validation
        $("#banner3").change(function() {
            var banner3 = this.files[0];
            var banner3File = banner3.type;
            var match = ["image/jpeg", "image/png", "image/jpg"];
            if (!((banner3File == match[0]) || (banner3File == match[1]) || (banner3File == match[2]))) {
                alert('Please select a valid banner file (JPEG/JPG/PNG).');
                $("#banner3").val('');
                return false;
            }
        });
    });
</script>

<script type="text/javascript">
function auto_grow(element) {
    element.style.height = "5px";
    element.style.height = (element.scrollHeight) + "px";
}

function preview1() {
   image1.src=URL.createObjectURL(event.target.files[0]);
}

function preview2() {
   image2.src=URL.createObjectURL(event.target.files[0]);
}

function preview3() {
   image3.src=URL.createObjectURL(event.target.files[0]);
}

</script>




<?php include 'profile_includes/profile_footer.php';?>