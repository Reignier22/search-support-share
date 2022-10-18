<?php session_start();
if(!ISSET($_SESSION['mail'])){
    header('location:index.php');    
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Employer | OTP Verification </title>
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
      <div class="back">
        <img class="backImg" src="assets/images/pwd.jpg" alt="">
        <div class="text">
          <span class="text-1">Complete miles of journey <br> with one step</span>
          <span class="text-2">Let's get started</span>
        </div>
      </div>
    </div>
    <div class="forms">
        <div class="form-content" >
          <div class="login-form">
            <div class="title">Employer OTP Verification</div> <br>
            <p> Input the otp number sent to your email to verify your account. </p>

          <form action="" method="post">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fa-solid fa-unlock-keyhole"></i>
                <input type="text" name="otp_code" placeholder="Enter OTP code" required>
              </div> <br>
              <div class="button input-box">
                <input type="submit" name="verify" value="Verify">
              </div>
              <div class="text sign-up-text">Did not receive an email? <label>Resend now</label></div>
            </div>
        </form>

      </div>
    </div>
  </div>
</body>
</html>

<?php 
    include('connections/config.php');
    if(isset($_POST["verify"])){
        $otp = $_SESSION['otp'];
        $email = $_SESSION['mail'];
        $otp_code = $_POST['otp_code'];

        if($otp != $otp_code){
            ?>
           <script>
               alert("Invalid OTP code");
               window.location.replace("otp_verify.php");
           </script>
           <?php
        }else{
            mysqli_query($conn, "UPDATE employers SET status = 1 WHERE email = '$email'");
            ?>
             <script>
                 alert("Your Account has been verified, you can now login.");
                   window.location.replace("index.php");
             </script>
             <?php
        }

    }

?>
