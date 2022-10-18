<?php 
error_reporting(0);
include 'config.php';

    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $middlename = mysqli_real_escape_string($conn, $_POST['middlename']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $month =  mysqli_real_escape_string($conn, $_POST['month']);
    $day =  mysqli_real_escape_string($conn, $_POST['day']);
    $year =  mysqli_real_escape_string($conn, $_POST['year']);
    $civil_status = mysqli_real_escape_string($conn, $_POST['civil_status']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $attainment = mysqli_real_escape_string($conn, ($_POST['attainment']));
    $contact_number = mysqli_real_escape_string($conn, ($_POST['contact']));
    $hs = mysqli_real_escape_string($conn, $_POST['hs']);
    $brgy = mysqli_real_escape_string($conn, $_POST['brgy']);
    $munp = mysqli_real_escape_string($conn, $_POST['munp']);   
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));

    $date = date("$year/$month/$day");
    $address = $hs ." Brgy. ". $brgy . " " . $munp;

    $work_experience_1 =  mysqli_real_escape_string($conn, $_POST['field_name_1']);
    $work_experience_2 =  mysqli_real_escape_string($conn, $_POST['field_name_2']);
    $work_experience_3 =  mysqli_real_escape_string($conn, $_POST['field_name_3']);
    $work_experience_4 =  mysqli_real_escape_string($conn, $_POST['field_name_4']);
    $work_experience_5 =  mysqli_real_escape_string($conn, $_POST['field_name_5']);


    if(!empty($firstname) || !empty($middlename) || !empty($lastname) || !empty($month) || !empty($day) || !empty($year) || !empty($civil_status) ||
    !empty($gender) || !empty($attainment) || !empty($contact_number) || !empty($hs) || !empty($brgy) || !empty($munp) || !empty($username) ||
    !empty($email) || !empty($password) || !empty($confirm_password) ){

        $username_verify = mysqli_query($conn, "SELECT * FROM job_seekers WHERE username='$username' ");
        $email_verify = mysqli_query($conn, "SELECT * FROM job_seekers WHERE email='$email' ");

        if(mysqli_num_rows($username_verify)) {
            echo "username";
        } else if(mysqli_num_rows($email_verify) > 0){
            echo "email";
        } else{
            $sql = "INSERT INTO `job_seekers`(`first_name`, `middle_name`, `last_name`, `birthday`, `civil_status`, `gender`, `address`, `contact_number`, `work_experience_1` , `work_experience_2` , `work_experience_3` , `work_experience_4` , `work_experience_5` , `attainment`, `username`, `email`, `password`) 
            VALUES ('$firstname','$middlename','$lastname','$date','$civil_status','$gender','$address','$contact_number','$work_experience_1', NULLIF('$work_experience_2', ''),  NULLIF('$work_experience_3', ''),  NULLIF('$work_experience_4', ''),  NULLIF('$work_experience_5', ''),
            '$attainment','$username','$email','$password')";

            $result = mysqli_query($conn, $sql);

            if ($result){
            echo 'Yes';
            } else{
            echo 'No';
            }
        }

    }
    
?>