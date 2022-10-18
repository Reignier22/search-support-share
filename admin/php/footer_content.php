<?php 
$page_title = "Admin | Logo and Footer";
include "includes/header.php";
?>

<style>
    .social-network li {
        border: 1px solid #535456;
        width: 32px;
        padding: 5px 0px;
        display: inline-block;
        text-align: center;
        height: 32px;
    }
    .social-network li a{
        color: #f5f5f5;
    }
    .widgetheading{
        color: #77A6F7;
        font-size: 1rem;
        font-weight: 800;
    }
    #logo-footers{
        display: grid;
       grid-template-columns: 64px 90px;
       line-height: 1.3rem;
    }
    #logo-footers p{
        font-size: 1rem;
        text-transform: uppercase;
        margin-left: 7px;
    }
    #logo-footers img{
        height: 64px;
        width: 64px;
    }
    input[type="text"],input[type="url"] {
      background-color: #f8f8f8;
    }
    .buttons{
        display: flex;
        justify-content: right;
    } 
    .buttons button{
        margin: 5px;
    }
</style>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y"> <!-- Content -->
        <div class="row"> <!-- Row -->
            
        <h4 class="fw-bold"><span class="text-muted fw-light"> Manage Content /</span> Logo and Footer </h4>  

        <div class="col-md">

        <div class="card">

            <div class="card-body mb-5">              

            <section id="basic-footer">
                <h5 class="pb-1 mt-5 mb-4">System's Logo</h5>

                <div class="app-brand justify-content-center mb-5">
                    <a class="app-brand-link gap-2">
                        <span class="app-brand-logo demo">
                            <img src="../../assets/home-plugins/img/<?= $fetch_slider['logo'];?>" id="logoImg1" width="100px" alt="logo">
                        </span>
                    <span class="app-brand-text demo text-body fw-bolder" style="font-size: 100px; color: #656565 !important;"> | </span>
                    <span class="app-brand-text label text-body mt-1"  style="font-size: 33px; color: #656565 !important; text-transform:uppercase;"><span style="color:#77A6F7 !important">S</span>earch <br> <span style="color:#77A6F7 !important">S</span>upport <br> <span style="color:#77A6F7 !important">S</span>hare </span>
                    </a>
                </div>

                
                <form action="../controllers/logo.php" id="logoForm" enctype="multipart/form-data">
                <div class="input-group">
                      <input type="file" class="form-control" name="sys_logo" id="logoFile" aria-describedby="inputGroupFileAddon04" onchange="logoPrev()" accept="image/*" aria-label="Upload">
                      <button class="btn btn-outline-primary" type="submit" >Change Logo</button>
                      <button class="btn btn-outline-primary" type="button" id="resetBTN" data-bs-toggle="tooltip" data-bs-html="true" data-bs-original-title="Reset" aria-describedby="tooltip275521"> <span class="tf-icons bx bx-reset"></span></button>
                    </form> 
                </div>

            </section>
            

            <section id="basic-footer">
                <h5 class="pb-1 mt-5 mb-4">Footer Information</h5>

                <footer style="background-color: #7F7F7F !important; padding: 40px 0 0 0; color: #f8f8f8; font-size:0.8rem" > 

                    <div class="container">
                        <div class="row">

                        <div class="col-md-3 col-sm-3" id="logo-footers">
                            <div>
                                <img src="../../assets/home-plugins/img/<?= $fetch_slider['logo'];?>" id="logoImg2" alt="logo">
                            </div>

                            <div>
                               <p> <span style="color:#77A6F7 !important"> S</span>earch <br> <span style="color:#77A6F7 !important">S</span>upport <br> <span style="color:#77A6F7 !important">S</span>hare </span> </p>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-3">
                            <div class="widget">
                            <h5 class="widgetheading">Contact Us</h5>
                            <p>
                                <i class="fa-solid fa-mobile-retro"></i> &nbsp; +639281920381 <br>
                                <i class="fa-solid fa-phone"></i> &nbsp; (+001) 123-456-789 <br>
                                <i class="fa-solid fa-envelope"></i> &nbsp; example.email@gmail.com
                            </p>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-3">
                            <div class="widget">
                            <h5 class="widgetheading">Quick Links</h5>
                            <ul class="link-list" style="list-style: none; padding-left:0px">
                                <li>Home</li>
                                <li>Hiring Now </li>
                                <li>Campaigns </li>
                            </ul>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-3">
                            <div class="widget">
                            <h5 class="widgetheading">Address</h5>
                            <address>
                            Agriculture Building, Brgy. Binan <br>
                            Pagsanjan Laguna Philippines</address>
                            </div>
                        </div>

                        </div>
                    </div>
                    <br>

                    <div id="sub-footer" style="text-shadow: none; color: #f5f5f5 !important; background-color: #6F6F6F !important; padding-top:30px;">
                        <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                            <div class="copyright">
                                <p>
                                <span>© 3S 2022 All right reserved.  
                                </span></p>
                            </div>
                            </div>
                            <div class="col-lg-6">
                            <ul class="social-network" style=" gap: 10px; color: #fff !important; display:flex; align-items:center; justify-content:right; list-style:none; margin-bottom:30px">

                              <?php 
                                if($fetch_fb['display'] == "show"){
                                  ?>
                                    <li><a href="<?= $fetch_fb['url']; ?>" data-bs-toggle="tooltip" data-bs-html="true" data-bs-original-title="Facebook" aria-describedby="tooltip275521"><i class="fa-brands fa-facebook-f"></i></a></li>
                                  <?php
                                }

                                if($fetch_tw['display'] == "show"){
                                  ?>
                                   <li><a href="<?= $fetch_tw['url']; ?>" data-bs-toggle="tooltip" data-bs-html="true" data-bs-original-title="Twitter" aria-describedby="tooltip275521" ><i class="fa-brands fa-twitter"></i></a></li>
                                  <?php
                                }

                                if($fetch_in['display'] == "show"){
                                  ?>
                                   <li><a href="<?= $fetch_in['url']; ?>" data-bs-toggle="tooltip" data-bs-html="true" data-bs-original-title="Instagram" aria-describedby="tooltip275521" ><i class="fa-brands fa-instagram"></i></a></li>
                                  <?php
                                }

                                if($fetch_tk['display'] == "show"){
                                  ?>
                                   <li><a href="<?= $fetch_tk['url']; ?>" data-bs-toggle="tooltip" data-bs-html="true" data-bs-original-title="Tiktok" aria-describedby="tooltip275521" ><i class="fa-brands fa-tiktok"></i></a></li>
                                  <?php
                                }

                                if($fetch_yt['display'] == "show"){
                                  ?>
                                    <li><a href="<?= $fetch_yt['url']; ?>" data-bs-toggle="tooltip" data-bs-html="true" data-bs-original-title="Youtube" aria-describedby="tooltip275521" ><i class="fa-brands fa-youtube"></i></a></li>
                                  <?php
                                }
                               
                                ?>
                               </ul>
                            </div>
                        </div>
                        </div>
                    </div>
        
            </footer>
        </section>


                    <h5 class="card-header">Contact Us and Address</h5>
                    <form action="../controllers/footerContent.php" id="footerForm">
                    <div class="card-body demo-vertical-spacing demo-only-element">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon11"> <i class="fa-solid fa-mobile-retro"></i> </span>
                                    <input type="text" class="form-control" placeholder="Contact Number" name="cnum" value="<?= $fetch_slider['cnumber'];?>" aria-label="Contact Number" aria-describedby="basic-addon11">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon11"> <i class="fa-solid fa-phone"></i> </span>
                                    <input type="text" class="form-control" placeholder="Telephone Number" name="tnum" value="<?= $fetch_slider['tnumber'];?>" aria-label="Telephone Number" aria-describedby="basic-addon11">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon11"> <i class="fa-solid fa-envelope"></i> </span>
                                    <input type="text" class="form-control" placeholder="Email" name="eadd" value="<?= $fetch_slider['email_add'];?>" aria-label="Email" aria-describedby="basic-addon11">
                                </div>
                            </div>
                            <br> <br> <br>

                            <div class="col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon11"> <i class="fa-solid fa-location-crosshairs"></i></span>
                                    <input type="text" class="form-control" placeholder="Address" name="addr" value="<?= $fetch_slider['address'];?>" aria-label="Address" aria-describedby="basic-addon11">
                                </div>
                            </div>

                        </div>

                        <div class="buttons">
                            <button type="button" id="reset_btn" class="btn btn-outline-secondary">
                                <span class="tf-icons bx bx-reset"></span>&nbsp; Reset Changes
                            </button>

                            <button type="submit" class="btn btn-primary">
                                <span class="tf-icons bx bx-save"></span>&nbsp; Save Changes
                            </button>
                        </div>
                        </form>
                    </div>


                        <h5 class="card-header">Linked Accounts</h5>
                        <div class="card-body">
                          <p>Display content from your linked accounts on 3S index page.</p>
                          <!-- Connections -->

                          <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                              <img src="../assets/img/icons/brands/facebook.png" alt="facebook" class="me-3" height="30">
                            </div>
                            <div class="flex-grow-1 row">
                              <div class="col-9 mb-sm-0 mb-2">
                              <input class="form-control" type="url" id="fbLink"  value="<?= $fetch_fb['url'];?>" >
                              </div>
                              <div class="col-3 text-end">
                                <div class="form-check form-switch">
                                  <input class="form-check-input float-end" id="fb_toggle" type="checkbox" role="switch" <?php if($fetch_fb['display'] == "show"){ echo "checked"; } ?> >
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                              <img src="../assets/img/icons/brands/twitter.png" alt="twitter" class="me-3" height="30">
                            </div>
                            <div class="flex-grow-1 row">
                              <div class="col-9 mb-sm-0 mb-2">
                                <input class="form-control" type="url" id="twLink" value="<?= $fetch_tw['url'];?>" >
                              </div>
                              <div class="col-3 text-end">
                                <div class="form-check form-switch">
                                  <input class="form-check-input float-end" id="tw_toggle" type="checkbox" role="switch" <?php if($fetch_tw['display'] == "show"){ echo "checked"; } ?>>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                              <img src="../assets/img/icons/brands/instagram.png" alt="instagram" class="me-3" height="30">
                            </div>
                            <div class="flex-grow-1 row">
                              <div class="col-9 mb-sm-0 mb-2">
                                <input class="form-control" type="url" id="inLink" value="<?= $fetch_in['url'];?>">
                              </div>
                              <div class="col-3 text-end">
                                <div class="form-check form-switch">
                                  <input class="form-check-input float-end" id="in_toggle" type="checkbox" role="switch" <?php if($fetch_in['display'] == "show"){ echo "checked"; } ?>>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                              <img src="../assets/img/icons/brands/tiktok.png" alt="tiktok" class="me-3" height="30">
                            </div>
                            <div class="flex-grow-1 row">
                              <div class="col-9 mb-sm-0 mb-2">
                                <input class="form-control" type="url" type="url" id="tkLink" value="<?= $fetch_tk['url'];?>">
                              </div>
                              <div class="col-3 text-end">
                                <div class="form-check form-switch">
                                  <input class="form-check-input float-end" id="tk_toggle" type="checkbox" role="switch"  <?php if($fetch_tk['display'] == "show"){ echo "checked"; } ?>>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="d-flex">
                            <div class="flex-shrink-0">
                              <img src="../assets/img/icons/brands/youtube.png" alt="youtube" class="me-3" width="30" height="28">
                            </div>
                            <div class="flex-grow-1 row">
                              <div class="col-9 mb-sm-0 mb-2">
                                <input class="form-control" type="url" id="ytLink" value="<?= $fetch_yt['url'];?>">
                              </div>
                              <div class="col-3 text-end">
                                <div class="form-check form-switch">
                                  <input class="form-check-input float-end" id="yt_toggle" type="checkbox" role="switch"  <?php if($fetch_yt['display'] == "show"){ echo "checked"; } ?>>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- /Connections -->
                        </div>

            </div> <!-- card body -->
        </div> <!-- card -->
        </div> <!-- col -->
        </div> <!-- row -->
    </div> <!-- content -->
</div> <!-- content wrapper -->

<?php include 'includes/footer.php'; 
      include '../messages.php';
?>

<script type="text/javascript">
    function logoPrev() {
      logoImg1.src=URL.createObjectURL(event.target.files[0]);
      logoImg2.src=URL.createObjectURL(event.target.files[0]);
    }
</script>

<script>

  $(document).ready(function() {
    $("#logoForm").on('submit', function(e) {
        e.preventDefault();

        if($('#logoFile').val() === "" ){
          $('#warning2_msg').html("Oopss.. looks like you haven't made any changes in your logo.");
          $('#warning2').toggle();
        }
        else if(!confirm("Are you sure you want to change the systems's logo?")){
          return false;
        } else{          
          $.ajax({
              type: 'POST',
              url: '../controllers/logo.php',
              data: new FormData(this),
              contentType: false,
              cache: false,
              processData: false,
              success: function(msg) {
                if (msg == "ok"){
                    $('#updateLogo').show();
                    $('#update_body_logo').html('Hi admin, your changes has been saved successfully.');
                    $('#logoForm')[0].reset();
                } else{
                    $('#errorMsg').show();
                    $('#error_body').html('Some error occured, please try updating again'); 
                }
              }
          });
        }
    });

    $('.btn-close').on('click', function(){
      $(".bs-toast").fadeOut();
    });

    $('#resetBTN').on('click', function(){
        window.location.reload();
    });


    $("#footerForm").on('submit', function(e) {
        e.preventDefault();

       if(!confirm("Confirm your changes.")){
          return false;
        } else{          
          $.ajax({
              type: 'POST',
              url: '../controllers/footerContent.php',
              data: new FormData(this),
              contentType: false,
              cache: false,
              processData: false,
              success: function(msg) {
                if (msg == "ok"){
                    $('#updateLogo').show();
                    $('#update_body_logo').html('Hi admin, your changes has been saved successfully.');
                    $('#logoForm')[0].reset();
                } else{
                    $('#errorMsg').show();
                    $('#error_body').html('Some error occured, please try updating again'); 
                }
              }
          });
        }
    });

    $('#reset_btn').on('click', function(){
      $('#footerForm')[0].reset();
    });

  $('#fb_toggle').click(function(){
    var fbLink = $('#fbLink').val();

    if($(this).is(":checked")){
          if(!confirm("Turning this on show your facebook link to 3S footer section.") ){
              return false;
          } else{
              $.ajax({
                  type: 'POST',
                  url: '../controllers/toggles.php',
                  data: {
                      'fb_btn' : true,
                      fbLink : fbLink,
                  },
                  success: function(response){
                      alert(response);
                      window.location.reload();
                  }
              });
          }    
    }
    else if($(this).is(":not(:checked)")){
          if(!confirm("Turning this off means that your fb link will be hidden in 3S footer section.") ){
              return false;
          } else{
              $.ajax({
                  type: 'POST',
                  url: '../controllers/toggles.php',
                  data: {
                      'fb_disable_btn' : true,
                      fb_disable : fbLink,
                  },
                  success: function(response){
                      alert(response);
                      window.location.reload();
                  }
              });
          }     
        }
    });

  
  
  
  $('#tw_toggle').click(function(){
   var twLink = $('#twLink').val();

   if($(this).is(":checked")){
        if(!confirm("Turning this on show your twitter link to 3S footer section.") ){
            return false;
        } else{
            $.ajax({
                type: 'POST',
                url: '../controllers/toggles.php',
                data: {
                    'tw_btn' : true,
                    twLink : twLink,
                },
                success: function(response){
                    alert(response);
                    window.location.reload();
                }
            });
        }    
   }
   else if($(this).is(":not(:checked)")){
        if(!confirm("Turning this off means that your twitter link will be hidden in 3S footer section.") ){
            return false;
        } else{
            $.ajax({
                type: 'POST',
                url: '../controllers/toggles.php',
                data: {
                    'tw_disable_btn' : true,
                    tw_disable : twLink,
                },
                success: function(response){
                    alert(response);
                    window.location.reload();
                }
            });
        }     
      }
    });

  $('#in_toggle').click(function(){
   var inLink = $('#inLink').val();

   if($(this).is(":checked")){
        if(!confirm("Turning this on show your instagram link to 3S footer section.") ){
            return false;
        } else{
            $.ajax({
                type: 'POST',
                url: '../controllers/toggles.php',
                data: {
                    'in_btn' : true,
                    inLink : inLink,
                },
                success: function(response){
                    alert(response);
                    window.location.reload();
                }
            });
        }    
   }
   else if($(this).is(":not(:checked)")){
        if(!confirm("Turning this off means that your instagram link will be hidden in 3S footer section.") ){
            return false;
        } else{
            $.ajax({
                type: 'POST',
                url: '../controllers/toggles.php',
                data: {
                    'in_disable_btn' : true,
                    in_disable : inLink,
                },
                success: function(response){
                    alert(response);
                    window.location.reload();
                }
            });
        }     
      }
    });

$('#tk_toggle').click(function(){
   var tkLink = $('#tkLink').val();

   if($(this).is(":checked")){
        if(!confirm("Turning this on will show your Tiktok link to 3S footer section.") ){
            return false;
        } else{
            $.ajax({
                type: 'POST',
                url: '../controllers/toggles.php',
                data: {
                    'tk_btn' : true,
                    tkLink : tkLink,
                },
                success: function(response){
                    alert(response);
                    window.location.reload();
                }
            });
        }    
   }
   else if($(this).is(":not(:checked)")){
        if(!confirm("Turning this off means that your tiktok link will be hidden in 3S footer section.") ){
            return false;
        } else{
            $.ajax({
                type: 'POST',
                url: '../controllers/toggles.php',
                data: {
                    'tk_disable_btn' : true,
                    tk_disable : tkLink,
                },
                success: function(response){
                    alert(response);
                    window.location.reload();
                }
            });
        }     
      }
    });
$('#yt_toggle').click(function(){
   var ytLink = $('#ytLink').val();

   if($(this).is(":checked")){
        if(!confirm("Turning this on will show your Youtube link to 3S footer section.") ){
            return false;
        } else{
            $.ajax({
                type: 'POST',
                url: '../controllers/toggles.php',
                data: {
                    'yt_btn' : true,
                    ytLink : ytLink,
                },
                success: function(response){
                    alert(response);
                    window.location.reload();
                }
            });
        }    
   }
   else if($(this).is(":not(:checked)")){
        if(!confirm("Turning this off means that your youtube link will be hidden in 3S footer section.") ){
            return false;
        } else{
            $.ajax({
                type: 'POST',
                url: '../controllers/toggles.php',
                data: {
                    'yt_disable_btn' : true,
                    yt_disable : ytLink,
                },
                success: function(response){
                    alert(response);
                    window.location.reload();
                }
            });
        }     
      }
    });

});

  

</script>