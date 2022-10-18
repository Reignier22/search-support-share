<!DOCTYPE html>
<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Admin | Application Page</title>

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
          <!-- Register Card -->
          <div class="card">
            <div class="card-body">
                <!-- Logo -->
                     <div class="app-brand justify-content-center">
                <a href="../index.php" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                    <img src="assets/img/avatars/logo.png" width="25" alt="logo">
                  </span>
                  <span class="app-brand-text demo text-body fw-bolder"> | </span>
                  <span class="app-brand-text label text-body" style="padding-top: 5px;">Search <br> Support <br> Share </span>
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Apply as staff administrator</h4>

              <form id="formApplication" class="mb-3" action="controllers/apply.php" autocomplete="off">

                <div class="mb-3">
                  <label for="username" class="form-label">Username</label>
                  <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" autofocus/>
                </div>

                <div class="mb-3">
                  <label for="apply_email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="apply_email" name="apply_email" placeholder="Enter your email" />
                </div>

                <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="apply_password">Password</label>
                  <div class="input-group input-group-merge">
                    <input type="password" id="apply_password" class="form-control" name="apply_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password"/>
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>

                <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="confirm_password">Confirm Password</label>
                  <div class="input-group input-group-merge">
                    <input type="password" id="confirm_password" class="form-control" name="confirm_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password"/>
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
              
                <button type="submit" class="btn btn-primary d-grid w-100">Sign up</button>
              </form>

              <p class="text-center">
                <span>Already have an account?</span>
                <a href="auth-login.php">
                  <span>Sign in instead</span>
                </a>
              </p>
            </div>
          </div>
          <!-- Register Card -->
        </div>
      </div>
    </div>

    <!-- / Content -->

    <?php include 'messages.php' ?>

    <!-- Core JS -->
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
      $("#formApplication").submit(function(e) {
      e.preventDefault();
      $.ajax({
          type: 'POST',
          url: 'controllers/apply.php',
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          success: function(response) {
                if(response == "empty_fields"){
                  $('#errorMsg').show();
                  $('#error_body').html('Please fill out all the fields.');
                }
                else if (response == 'inv_email') {
                  $('#errorMsg').show();
                  $('#error_body').html('Please enter a valid email address.');
                }
                else if (response == 'mismatch') {
                  $('#errorMsg').show();
                  $('#error_body').html('Password did not match, please try again.');
                }
                else if (response == 'ok') {
                  $('#successMsg').show();
                  $('#redirect_msg').html("Redirecting back to login page..");
                  $('#success_body').html('Your application has been sent to head admin, please wait until he verifies your application.');
                  setTimeout(function(){ window.location.href= 'auth-login.php';}, 1500);
                }  else{
                  alert(response);
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
