<?php
session_start();
include "connections/config.php";
$pt = $_GET['pt'];
$page_title = "3S | $pt";
?>

<link rel="stylesheet" href="assets/home-plugins/css/campaigns.css">
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v15.0" nonce="sfOveLXB"></script>
<header>
    <?php
include 'includes/header.php';
$jumbo_title = 'Campaign Details';
include 'includes/pages.php';
?>
</header>

<?php
    $cid = $_GET['cid'];
    $campaigns = mysqli_query($conn, "SELECT campaigns.cid, campaigns.jsid, job_seekers.first_name as fname, job_seekers.last_name as lname,
    campaigns.project_title, campaigns.project_description, campaigns.project_goal, campaigns.end_date, campaigns.qr_code,
    campaigns.image, campaigns.image2, campaigns.image3, campaigns.date_added, campaigns.date_added
    FROM campaigns 
    INNER JOIN job_seekers ON job_seekers.jsid = campaigns.jsid WHERE cid = $cid ");
    $fetch = mysqli_fetch_array($campaigns);
?>

<div class="container">
    <div class="grid-container">
        <div class="item1">
        <div class="heading-job" style="display: grid; width:100%; grid-template-columns:80% 20%;">
            <h1> <?= $fetch['project_title'] ?> </h1>
            <div style="display: flex; justify-content:center; align-items:center"> <span class="report fa-regular fa-flag" aria-label="Report this campaign" title="Report Campaign" data-toggle="modal" data-target="#exampleModal"></span></div> 
        </div>
        <hr>
            <div class="row">
                <div class="col-sm-7">
                    <div class="image-container">
                        <!-- Slideshow container -->
                        <div class="slideshow-container">

                            <!-- Full-width images with number and caption text -->
                            <div class="mySlides">
                                <div class="numbertext">1 / 3</div>
                                <img src="profile_includes/assets/project-banner/<?= $fetch['image'] ?>" style="width:100%; height:200px">
                            </div>

                            <div class="mySlides">
                                <div class="numbertext">2 / 3</div>
                                <img src="profile_includes/assets/project-banner/<?= $fetch['image2'] ?>" style="width:100%; height:200px">
                            </div>

                            <div class="mySlides">
                                <div class="numbertext">3 / 3</div>
                                <img src="profile_includes/assets/project-banner/<?= $fetch['image3'] ?>" style="width:100%; height:200px">
                            </div>

                            <!-- Next and previous buttons -->
                            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                            <a class="next" onclick="plusSlides(1)">&#10095;</a>
                        </div>
                        <br>

                        <!-- The dots/circles -->
                        <div style="text-align:center">
                            <span class="dot" onclick="currentSlide(1)"></span>
                            <span class="dot" onclick="currentSlide(2)"></span>
                            <span class="dot" onclick="currentSlide(3)"></span>
                        </div>

                    </div> <!-- image-container-end -->
                </div> <!-- div-col-7-end -->

                <div class="col-sm-5">
                    <p> <span class="fa-solid fa-user-tie"></span> Project by | <?php echo $fetch['fname'] . " " . $fetch['lname'] ?></p>
                    <p> <span  class="fa-solid fa-hand-holding-dollar"></span> Project Goal : <?= $fetch['project_goal'] ?> </p>
                    <?php 
                        $donate_cid = $_GET['cid'];;
                        $donate = mysqli_query($conn, "SELECT amount FROM donations WHERE cid = $donate_cid");
                        $sum = 0;
                        while($donate_fetch = mysqli_fetch_assoc($donate)){
                            $sum += $donate_fetch['amount'];
                        }
                    ?>
                    <p> <span class="fa-solid fa-chart-simple"></span> Money Raised : <?php echo $sum;?> </p>
                    <p> <span class="fa-regular fa-calendar-plus"></span> Date Posted : <?php $timestamp = $fetch['date_added']; echo date("F d, Y", strtotime($timestamp)); ?>  </p>
                    <p> <span class="fa-regular fa-calendar-xmark"> </span> Campaign End : <?php $end_date = $fetch['end_date']; echo date("F d, Y", strtotime($end_date)); ?>  </p>
                </div>

                <div class="col-sm-12">
                    <h4> Project Description </h4>
                    <p style="text-align:justify; text-indent:10%; padding-right:10px"> <?= $fetch['project_description'] ?> </p>
                    <hr>
                    <div style="display: flex; justify-content:space-between">
                        <div>
                            <p>Share this campaign to your social your facebook account:</p>
                        </div>
                        <div>
                            <div class="fb-share-button" data-href="" data-layout="button_count" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>
                           
                        </div>
                    </div>
                </div>

            </div> <!--row-end -->

        </div>

        <div class="item2">
            <div class="row">
                <div class="col-sm-12">
                    <h3 style="text-align: center;"> You can now donate to this project by following these easy steps: </h3>

                    <form action="connections/donate.php" id="donateForm" method="POST">
                     <input type="hidden" name="jsid" id="jsid" value="<?= $fetch['jsid']; ?>">  
                     <input type="hidden" name="cid" id="cid" value="<?= $fetch['cid'] ?>"> 
                    <div class="step"> 
                        <div class="round-number" id="rn1"> <span> 1 </span> </div> 
                        <p class="step_details"> Step 1 : Enter your name on the input box then click the arrow icon to proceed. </p> 
                    </div> 
                    
                    <div class="step-input">
                        <input type="text" name="name" id="name" placeholder="Your name"> <span class="fa-solid fa-circle-right sunod" id="next_1"> </span>
                    </div>

                    <div class="step_2">
                        <div class="step"> 
                            <div class="round-number" id="rn2"> <span> 2 </span> </div> 
                            <p class="step_details"> Step 2 : Enter the amount to be donated then click the arrow icon to proceed.  </p> 
                        </div> 
                    
                        <div class="step-input ">
                            <input type="number" name="amount" id="amount" placeholder="&#8369; 0.00"> <span class="fa-solid fa-circle-right sunod" id="next_2"> </span>
                        </div>
                    </div>

                    <div class="step_3">
                        <div class="step"> 
                            <div class="round-number" id="rn3"> <span> 3 </span> </div> 
                            <p class="step_details"> Step 3 : Enter any message to project initiators then proceed to the fourth and last step.  </p> 
                        </div> 

                        <div class="step-input message">
                            <textarea type="text" name="message" id="message" placeholder="Any message to the project initiators"></textarea> <span class="fa-solid fa-circle-right sunod" id="next_3" data-toggle="modal" data-target="#step4Modal" data-backdrop="static" data-keyboard="false"> </span>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="step4Modal" tabindex="-1" role="dialog" aria-labelledby="step4ModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-body">
                                <div class="step"> 
                                    <div class="round-number"> <span> 4 </span> </div> 
                                    <p class="step_details"> Step 4 : Open your GCash, scan this QR Code, then click the done button </p> 
                                </div> 
                                
                                <div class="step-input">
                                    <img src="profile_includes/assets/qr_code/<?= $fetch['qr_code'] ?>" width="200px" height="300px" alt="QR Code">
                                </div>

                                <div class="step"> 
                                    <div class="round-number"> <span> 5 </span> </div> 
                                    <p class="step_details"> Step 5 : Please enter the 13 digit reference number of gcash transaction</p> 
                                </div> 
                                
                                <div class="step-input">
                                    <input type="number" name="ref" id="ref" placeholder="e.g. 0001500102030"> 
                                </div>

                            </div>
                            <div class="modal-footer">
                                <input type="button" id="cancel" value="Cancel" class="btn" style="background-color: #c3c3c3; border:none; border-radius:5px">
                                <input type="submit" name="donate" id="donate" value="Done" class="btn" style="background-color: #77A6F7; border:none; border-radius:5px">
                            </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                
            </div>
            
        </div>


    </div>
</div>

<br>

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
            <form action="connections/cmp-report.php" id="rpForm">
            
            <input type="hidden" name="rp_cid" id="rp_cid" value="<?=$_GET['cid'];?>">
            <select name="reason" id="reason"  class="form-control" required>
                <option value="Inapropriate or not related campaign for differently-abled persons">Inapropriate or not related campaign for differently-abled persons</option>
                <option value="Use of language">Use of language</option>
                <option value="Misleading information">Misleading information</option>
                <option value="Unrelated and violent graphic content">Unrelated and violent graphic content</option>
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

<script>
    let slideIndex = 1;
    showSlides(slideIndex);

    // Next/previous controls
    function plusSlides(n) {
    showSlides(slideIndex += n);
    }

    // Thumbnail image controls
    function currentSlide(n) {
    showSlides(slideIndex = n);
    }

    function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("dot");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" actived", "");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " actived";
    }
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function(){

        $("#rpForm").submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'connections/cmp-report.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                if (response == 'ok') {
                        alert('Your report has been sent. We will take actions to this matter after we review this campaign.');
                        $('#rpForm')[0].reset();
                        window.location.reload();
                    } else {
                        alert('Some error occured');
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

        $('#name').on('keyup', function(){
            $('#next_1').fadeIn();
        });

        $('#amount').on('keyup', function(){
            $('#next_2').fadeIn();
        });

        $('#message').on('keyup', function(){
            $('#next_3').fadeIn();
        });

        $('#next_1').on('click', function(){

            var name = $('#name').val();

            if(name === "" ){
                alert('Please input your name');
            } else{
                $('#rn1').css('background-color', '#77A6F7');
                $('.step_2').slideToggle();
            }
        });

        $('#next_2').on('click', function(){

        var amount = $('#amount').val();

            if(amount === "" || amount < 1){
                alert('Please input the amount to be donated');
            } else{
                $('#rn2').css('background-color', '#77A6F7');
                $('.step_3').slideToggle();
            }
        });

        $('#next_3').on('click', function(){

        var message = $('#message').val();

            if(message === "" ){
                alert('Please input any message or do it later?');
            } else{
                $('#rn3').css('background-color', '#77A6F7');
            }

        });

        $('#cancel').on('click', function(){
            if(!confirm("Are you sure you want to cancel?")){
                return false;
            } else{
                window.location.reload();
            }
        });


        $('#donate').on('click', function(e){
            e.preventDefault();
    
            var ref = $('#ref').val();
            var name = $('#name').val();
            var amount = $('#amount').val();
            var message = $('#message').val();
            var cid = $('#cid').val();
            var jsid = $('#jsid').val();
            var num = /^(\d{13})?$/;
            
            if (name == "" || amount == "" || message == "" || ref == ""){
                alert("All fields are required!");
            } else if(!num.test(ref)){
                alert('Please input a valid reference number');
            } else{
                    $.ajax({
                    method: 'POST',
                    url: 'connections/donate.php',
                    data: {
                        donate: 1,
                        jsidPHP: jsid,
                        namePHP: name,
                        cidPHP: cid,
                        refPHP: ref,
                        amountPHP: amount,
                        messagePHP: message
                    },
                    success: function(msg){
                        if (msg == 'ok') {
                            alert('Your donation has been submitted successfully.');
                            window.location.reload();
                        } else {
                            alert('Some problem occurred, please try again.');
                        }
                    }, 
                    dataType: 'text',
                });
            }
        
        });

    });
</script>

<footer> <?php include 'includes/footer.php'?> </footer>