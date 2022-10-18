<?php 
session_start();

include 'config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "phpmailer/src/Exception.php";
require "phpmailer/src/PHPMailer.php";
require "phpmailer/src/SMTP.php";

if(isset($_POST["register"])){

    $company_name = mysqli_real_escape_string($conn, $_POST['companyPHP']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contactNumberPHP']);
    $email = mysqli_real_escape_string($conn, $_POST['emailPHP']);
    $password = mysqli_real_escape_string($conn, md5($_POST['passwordPHP']));

    $check_query = mysqli_query($conn, "SELECT * FROM employers where email ='$email'");
    $rowCount = mysqli_num_rows($check_query);

    if($rowCount > 0){
        echo "email";
    } else{

        $result = mysqli_query($conn, "INSERT INTO employers (company_name, contact_number, email, password, status) VALUES ('$company_name', '$contact_number', '$email', '$password', 0)");

        if($result){
            $otp = rand(100000,999999);
            $_SESSION['otp'] = $otp;
            $_SESSION['mail'] = $email;
            $mail = new PHPMailer;

            $mail->isSMTP();
            $mail->Host='smtp.gmail.com';
            $mail->Port=587;
            $mail->SMTPAuth=true;
            $mail->SMTPSecure='tls';

            $mail->Username='sapplication03@gmail.com';
            $mail->Password='uqqsuezyqxordqcv';

            $mail->setFrom('sapplication03@gmail.com', 'OTP Verification');
            $mail->addAddress($_POST["emailPHP"]);
            $mail->addAddress($_POST["email"]);

            $mail->isHTML(true);
            $mail->Subject="Your verify code";
            $mail->Body="<p>Dear user, </p> <h3>Your verify OTP code is $otp <br></h3>
            <br><br>
            <p>With regards,</p>
            <b>3S Job Portal</b>
            ";

                    if(!$mail->send()){
                        echo "No";
                    }else{
                       echo "Yes";
                    }
                }
            }
        }


?>