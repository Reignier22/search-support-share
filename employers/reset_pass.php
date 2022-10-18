<?php 
session_start();
if (!isset($_SESSION['email'])){
    header("Location: forgot-pass.php");
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Employer | Reset Password </title>
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
            <div class="title">New Password </div> <br>
            <p> Please enter your password. This will serve as your new password when you login again to the system </p>

          <form action="reset_pass.php" method="post">
            <div class="input-boxes">
              <div class="input-box">
              <i class="fa-solid fa-envelope"></i>
                <input type="password" name="password" id="password" placeholder="Enter your new password"> 
              </div> <br>
              <div class="button input-box">
                <input type="submit" name="reset" value="Reset Password">
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
    if(isset($_POST["reset"])){
        include('connections/config.php');
    
        $token = $_SESSION['token'];
        $Email = $_SESSION['email'];
    
        $sql = mysqli_query($conn, "SELECT * FROM employers WHERE email='$Email'");
        $query = mysqli_num_rows($sql);
        $fetch = mysqli_fetch_assoc($sql);
    
        if($Email){
            $password = mysqli_real_escape_string($conn, md5($_POST['password']));
            mysqli_query($conn, "UPDATE employers SET password='$password' WHERE email='$Email'");
            echo '<script>
                alert("Your password has been succesfully reset");
            </script>';
                session_unset();
                session_destroy();
            echo '<script>  window.location.replace("index.php"); </script>';
        }else{
            ?>
            <script>
                alert("<?php echo "Please try again"?>");
            </script>
            <?php
        }
    }
?>

