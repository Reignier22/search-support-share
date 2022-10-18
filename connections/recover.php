<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require "phpmailer/src/Exception.php";
    require "phpmailer/src/PHPMailer.php";
    require "phpmailer/src/SMTP.php";

    if(isset($_POST["recover"])){
        include('config.php');
        $email = mysqli_real_escape_string($conn, $_POST["email"]);

        $sql = mysqli_query($conn, "SELECT * FROM job_seekers WHERE email='$email'");
        $query = mysqli_num_rows($sql);
  	    $fetch = mysqli_fetch_assoc($sql);

        if(mysqli_num_rows($sql) <= 0){
            ?>
            <script>
                alert("<?php  echo "Sorry, no emails exists "?>");
                window.location.replace("../forgot-pass.php");
            </script>
            <?php
        }else{
            // generate token by binaryhexa 
            $token = bin2hex(random_bytes(50));

            session_start ();
            $_SESSION['token'] = $token;
            $_SESSION['email'] = $email;

            $mail = new PHPMailer;

            $mail->isSMTP();
            $mail->Host='smtp.gmail.com';
            $mail->Port=587;
            $mail->SMTPAuth=true;
            $mail->SMTPSecure='tls';

            // h-hotel account
            $mail->Username='sapplication03@gmail.com';
            $mail->Password='uqqsuezyqxordqcv';

            // send by h-hotel email
            $mail->setFrom('sapplication03@gmail.com', 'Password Reset');
            $mail->addAddress($email);

            // HTML body
            $mail->isHTML(true);
            $mail->Subject="Reset your password";
            $mail->Body="
            <div style='margin:20px; background-color: #fff; width:500px; padding: 20px; box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px; text-align:justify'>
    
            <h3>We received a request to reset your password.</h3>
            <p>To setup your new password, please click the link beow: </p>
            http://localhost/Capstone_project/reset_pass.php?token=$token
            <br><br>
            <p>With regrads,</p>
            <b>3S Application</b> <br><br>
            <strong> <i>This is a system generated message. Please do not reply.</i> </strong>
    
            </div>
            ";

            if(!$mail->send()){
                ?>
                    <script>
                        alert("<?php echo " Invalid Email "?>");
                    </script>
                <?php
            }else{
                ?>
                    <script>
                        alert("<?php echo " A link has been sent to your email". " " .$email ?>");
                        window.location.replace("../forgot-pass.php");
                    </script>
                <?php
            }
        }
    }

