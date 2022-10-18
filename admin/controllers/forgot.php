<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require "phpmailer/src/Exception.php";
    require "phpmailer/src/PHPMailer.php";
    require "phpmailer/src/SMTP.php";

    if(isset($_POST["recover"])){
        include('dbController.php');
        $email = mysqli_real_escape_string($conn, $_POST["email"]);

        $sql = mysqli_query($conn, "SELECT * FROM admin_table WHERE email='$email'");
        $query = mysqli_num_rows($sql);
  	    $fetch = mysqli_fetch_assoc($sql);

        if(mysqli_num_rows($sql) <= 0){
            ?>
            <script>
                alert("<?php  echo "Sorry, no emails exists "?>");
                window.location.replace("../auth-forgot-password.php");
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
            // get email from input
            $mail->addAddress($email);
            //$mail->addReplyTo('lamkaizhe16@gmail.com');

            // HTML body
            $mail->isHTML(true);
            $mail->Subject="Recover your password";
            $mail->Body="<b>Good Day User</b>
            <h3>We received a request to reset your password.</h3>
            <p>Kindly click the below link to reset your password</p>
            http://localhost/Capstone_project/admin/reset_pass.php?token=$token
            <br><br>
            <p>With regrads,</p>
            <b>3S Application</b>";

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
                        window.location.replace("../auth-forgot-password.php");
                    </script>
                <?php
            }
        }
    }

