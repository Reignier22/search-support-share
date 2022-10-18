<!DOCTYPE html>

<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Admin Login</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/css/demo.css" />
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="assets/vendor/css/pages/page-auth.css" />
    <script src="assets/vendor/js/helpers.js"></script>
    <script src="assets/js/config.js"></script>

  </head>

  <body> 
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="../index.php" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                    <img src="assets/img/avatars/logo.png" width="25" alt="logo">
                  </span>
                  <span class="app-brand-text demo text-body fw-bolder"> | </span>
                  <span class="app-brand-text label text-body">Search <br> Support <br> Share </span>
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Welcome Admin! 👋</h4>
              <p class="mb-4">Please sign-in to your account and start the adventure</p>

              <form id="formAuthentication" class="mb-3" action="controllers/signupController.php" autocomplete="off">
                <div class="mb-3">
                  <label for="email" class="form-label">Email login</label>
                  <input
                    type="text"
                    class="form-control"
                    name="email" 
                    id="email"
                    placeholder="Enter your email"
                    autofocus
                  />
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                    <a href="auth-forgot-password.php">
                      <small>Forgot Password?</small>
                    </a>
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" name="login" id="login" type="submit"> Sign in</button>
                </div>
              </form>

              <p class="text-center">
                <span>Don't have an account?</span>
                <a style="cursor:pointer; color:#77A6F7" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBoth" aria-controls="offcanvasBoth">
                  <span>Contact system administrator</span> 
                </a> or
                <a href="auth-register.php" style="cursor:pointer; color:#77A6F7">
                  <span>Apply as Staff here.</span> 
                </a>
              </p>
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>

    <?php include 'messages.php' ?>

    <!-- / Content -->

    <script src="assets/vendor/libs/jquery/jquery.js"></script>
    <script src="assets/vendor/libs/popper/popper.js"></script>
    <script src="assets/vendor/js/bootstrap.js"></script>
    <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="assets/vendor/js/menu.js"></script>
    <script src="assets/js/main.js"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
<script>
$(document).ready(function() {

    $("#formAuthentication").submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'controllers/signupController.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                if(response == "empty"){
                  $('#errorMsg').show();
                  $('#error_body').html('Please fill out all the fields.');
                }
                else if (response == 'email_err') {
                  $('#errorMsg').show();
                  $('#error_body').html('Please enter a valid email address.');
                }
                else if (response == 'no') {
                  $('#errorWarning').show();
                  $('#warning_body').html('Please wait for the admin to activate your account.');
                  $('#formAuthentication')[0].reset();
                }
                else if (response == 'disabled') {
                  $('#errorWarning').show();
                  $('#warning_body').html('Your access to admin account has been disabled by the head admin');
                  $('#formAuthentication')[0].reset();
                }
                else if (response == 'yes') {
                  $('#successMsg').show();
                  $('#redirect_msg').html("Redirecting to your home page..");
                  $('#success_body').html('Hi admin, your login was successful.');
                  setTimeout(function(){ window.location.href= 'php/index.php';}, 1500);
                } 
                else if (response == 'err') {
                  $('#errorMsg').show();
                  $('#error_body').html('Password is incorrect, please try again.');
                  $('#password')[0].reset();
                }
                else {
                  $('#errorMsg').show();
                  $('#error_body').html('Email does not exist, please contact system admin or apply as admin'); 
                }
            }
        });
    });

    $('.btn-close').on('click', function(){
      $(".bs-toast").fadeOut();
    });
});
</script>
  </body>
</html>
