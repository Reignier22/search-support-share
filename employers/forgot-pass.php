<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Employer | Forgot Password </title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="container">
    <input type="checkbox" id="flip" >
    <div class="cover">
      <div class="front" >
        <img src="assets/images/pwd.jpg" alt="">
        <div class="text" style="margin-top: 85px;">
          <span class="text-1">Support <br>  <p> Humanity lies in helping others </p></span>
          <span class="text-2">Support differently-abled people by sharing any amount <br> of money for their initiatives. </span> <br>
          <span>
            <button class="button" style="vertical-align:middle"><span>Campaigns </span></button>
          </span>
        </div>
      </div>
 
    </div>
    <div class="forms">
        <div class="form-content" >
          <div class="login-form">
            <div class="title">Email</div> <br>
            <p> Please enter your email address. You will receive an email message with instructions on how to reset your password. </p>

          <form action="connections/forgot.php" method="post">
            <div class="input-boxes">
              <div class="input-box">
              <i class="fa-solid fa-envelope"></i>
                <input type="text" name="email" placeholder="Enter email address" required>
              </div> <br>
              <div class="button input-box">
                <input type="submit" name="continue" value="Continue">
              </div>
              <div class="text sign-up-text">Did not receive an email? <label>Resend now</label></div>
            </div>
        </form>

      </div>
    </div>
  </div>
</body>
</html>

