<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Employer | Login </title>
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico"/>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>  
  <div class="container">
  <span id="back"> Back to Home</span><div id="home"> <a href="../index.php"><i class="fa-solid fa-house" id="i" style="color: #ccc;"></i></a></div>  
    <input type="checkbox" id="flip">
    <div class="cover">
      <div class="front">
        <img src="assets/images/pwd.jpg" alt="">
        <div class="text">
          <span class="text-1">Support <br>  <p> Humanity lies in helping others </p></span>
          <span class="text-2">Support differently-abled people by sharing any amount <br> of money for their initiatives. </span> <br>
          <span>
            <button onclick="window.location.href='../campaigns.php' " class="button" style="vertical-align:middle"><span>Campaigns </span></button>
          </span>
        </div>
      </div>
      <div class="back">
        <img class="backImg" src="assets/images/pwd.jpg" alt="">
        <div class="text">
          <span class="text-1">Complete miles of journey <br> with one step</span>
          <span class="text-2">Let's get started</span>
        </div>
      </div>
    </div>
    <div class="forms">
        <div class="form-content">
          <div class="login-form">
            <div class="title">Employer Login</div> <br>
            <p>Sign in now and start sharing job vacancies for our beloved differently-abled people.</p>

          <form action="connections/login.php" id="loginForm" method="POST">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" name="log_email"  id="log_email" placeholder="Enter your email" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" name="log_password" id="log_password" placeholder="Enter your password" required>
              </div>

              <div class="password">
                <div class="pass"> <span style="padding-left: 13px;"> <input type="checkbox" id="show" style="vertical-align: middle; position: relative; bottom: 1px;"> Show Password  </span> </div>
                <div class="pass forgot">  <a href="forgot-pass.php" style="font-size: 15px;">Forgot password?</a></div>
              </div>

              
              <div class="button input-box">
                <input type="submit" id="login" name="login" value="Login">
              </div>
              <div class="text sign-up-text">Don't have an account? <label for="flip">Signup now</label></div>
            </div>
        </form>

      </div>
        <div class="signup-form">
          <div class="title">Registration </div>
        
          <form action="connections/register.php" method="POST">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-user"></i>
                <input type="text" name="company" id="company" placeholder="Enter your company name" required>
              </div>
              <div class="input-box">
                <i class="fa-solid fa-phone"></i>
                <input type="number" name="cnumber" id="cnumber" placeholder="Enter your contact number" required>
              </div>
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" name="email" id="email" placeholder="Enter your email" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Enter your password" required>
              </div>
              <div class="input-box">
                <i class="fa-solid fa-check-double"></i>
                <input type="password" name="cpassword" id="cpassword" placeholder="Confirm your password" required>
              </div>
              <div class="check"><input type="checkbox" id="checkbox" class="checkbox"> By signing up, I agree to the <a href="../terms.php" >Terms and Conditions and Privacy Policy</a></div>
              <div class="button input-box">
                <input type="submit" name="register" id="register" value="Create Account">
              </div>
              <div class="text sign-up-text">Already have an account? <label for="flip">Login now</label></div>
            </div>
      </form>


    </div>
    </div>
    </div>
  </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
<script>
  $('#show').on('click', function(){
      var x = document.getElementById('log_password');
      if (x.type === "password"){
          x.type = 'text';
      } else{
          x.type = 'password';
      }
  });
</script>
<script src="assets/js/script.js"></script>

</body>
</html>
