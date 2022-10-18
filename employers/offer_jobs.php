<?php  
$page_title = "Employer | Offer Jobs";
include("include/header.php"); 
?>

<!-- Link Swiper's CSS -->
<link rel="stylesheet" href="assets/css/swiper-bundle.min.css" />
<!-- CSS -->
<link rel="stylesheet" href="assets/css/styles.css">


<main style="padding-top:55px; min-height: calc(110vh - 70px);">

        <div>
            <h1 style="font-weight: 900 ;">Job Offer</h1>
            <small>Here are the list of Job Seekers who are available for job offer.</small>
        </div>

        <section class="swiper mySwiper">

            <div class="swiper-wrapper">

            <?php 
                $query = mysqli_query($conn, "SELECT * FROM job_seekers WHERE status='available' ");
                
                if(mysqli_num_rows($query) > 0){
                    foreach($query as $jsrow) {
            ?>

                <div class="card swiper-slide">
                    <div class="card__image">
                        <img src="../profile_includes/profile_pic/<?= $jsrow['profile'];?>" alt="card image">
                    </div>

                    <div class="card__content">
                        <span class="card__title"><?php $lname=$jsrow['middle_name'];  echo $jsrow['last_name']. ", ". $jsrow['first_name']. " " . $lname[0]. "."; ?></span>
                        <span class="card__name">
                            <?php 
                                $dob = $jsrow['birthday'];
                                $bday = new DateTime($dob);
                                $today = new DateTime(date('m.d.y'));
                                $diff = $today-> diff($bday);
                                printf(' %d years old ', $diff->y);
                            ?> | 
                            <?= $jsrow['gender'];?>
                        </span>
                        <p class="card__text">Currently living in <?= $jsrow['address'];?>, this job seeker classified his disability as <?= $jsrow['disability'];?></p>
                        <button class="card__btn" data-toggle="modal" data-target="#exampleModal" value="<?= $jsrow['jsid'];?>">View More</button>
                    </div>
                </div>

            <?php

                    }
                } else{
                    ?>
                        <div class="nodata">
                                <img src="assets/Images/nodata.png" alt="no data">
                                <br><br>
                                <p>There aren't any job seekers available for offers right now. Please check this page again some other time.</p>
                        </div>
                        
                    <?php
                }

            ?>
            
            </div>
        </section>

</main>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> <strong><span id="lastname"></span>, <span id="firstname"></span> <span id="middlename"></span></strong> 
            <button type="button" class="close close_btn" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </h5>
      </div>
      <div class="modal-body">

        <div class="grid_body">

            <div>
                <strong>Civil Status:</strong> <span id="cs"></span> <br>
                <strong>Contact Number:</strong> <span id="cn"></span> <br>
                <strong>Email: </strong> <span id="em"></span> <br>
                <strong>Educational Attainment</strong> <span id="ea"></span>
            </div>

            <div>
                <strong>Work Experiences</strong>
                <p id="we1"></p>
                <p id="we2"></p>
                <p id="we3"></p>
                <p id="we4"></p>
                <p id="we5"></p>
            </div>

        </div>

        <p class="instruction"> Offer job to this person by filling out the text area and clicking the offer job button. </p>

        <div class="offer_container">
            <form action="connections/offers.php" id="joForm">
            <input type="text" class="form-control" value="Good day," readonly>
            <input type="hidden" name="jbskid" id="jbskid">
            <input type="hidden" name="empid" id="empid" value="<?= $_SESSION['empid'];?>">
            <textarea name="message" id="message" class="form-control" placeholder="Please specify here the details of your job offer to this person." oninput="auto_grow(this)" required></textarea>
            <div class="company">
                <input type="text" class="form-control" value="From: <?php echo $fetch['company_name'];?>" readonly>
            </div>
            <div class="company">
                <input type="text" class="form-control" value="Contact: <?php echo $fetch['contact_number'];?>" readonly>
            </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="close_btn btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="offer_btn btn btn-primary" id="offer_job">Offer job</button>
        </form>

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

<!-- Swiper JS -->
<script src="assets/js/swiper.js"></script>
<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper(".mySwiper", {
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: "auto",
        coverflowEffect: {
            rotate: 0,
            stretch: 0,
            depth: 300,
            modifier: 1,
            slideShadows: false,
        },
        pagination: {
            el: ".swiper-pagination",
        },
    });
</script>

<?php include("include/footer.php") ?>

<script>
$(document).ready(function(){
    $('.card__btn').click(function(e){
        e.preventDefault();
        var jsid = $(this).val();
        $.ajax({
            type: "GET",
            url: "connections/offers.php?jsid="+jsid,
            success: function(response){
                var res = jQuery.parseJSON(response);
                if (res.status == 422){
                    alert(res.message);
                } else if (res.status == 200){
                    $('#jbskid').val(res.data.jsid);
                    $('#firstname').html(res.data.first_name);
                    $('#middlename').html(res.data.middle_name);
                    $('#lastname').html(res.data.last_name);
                    $('#cs').html(res.data.civil_status);
                    $('#cn').html(res.data.contact_number);
                    $('#em').html(res.data.email);
                    $('#ea').html(res.data.attainment);
                    $('#we1').html(res.data.work_experience_1);
                    $('#we2').html(res.data.work_experience_2);
                    $('#we3').html(res.data.work_experience_3);
                    $('#we4').html(res.data.work_experience_4);
                    $('#we5').html(res.data.work_experience_5);
                }
            }
        });
    });

    $('.offer_btn').click(function(e){
        e.preventDefault();
        var jbskid = $('#jbskid').val();
        var empid = $('#empid').val();
        var message = $('#message').val();

        if(message === ""){
            alert('Please fill out the textarea first.');
        } else{
            
            $.ajax({
                method: 'POST',
                url: 'connections/offers.php',
                data: {
                    'offer_btn': true,
                    'message': message,
                    'jbskid': jbskid,
                    'empid': empid
                }, 
                success: function(res){
                    alert(res);
                    $('#joForm')[0].reset();
                }
            });
        }

    });

    $('.close_btn').click(function(){
        $('#joForm')[0].reset();
    });

});
</script>