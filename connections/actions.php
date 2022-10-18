<?php 
include 'config.php';
$jsid = mysqli_real_escape_string($conn, $_POST['id']);
$firstName = mysqli_real_escape_string($conn, $_POST['fn']);
$middleName = mysqli_real_escape_string($conn, $_POST['mn']);
$lastName = mysqli_real_escape_string($conn, $_POST['ln']);
$birthDate = mysqli_real_escape_string($conn, $_POST['bd']);
$civilStatus = mysqli_real_escape_string($conn, $_POST['cs']);
$gender = mysqli_real_escape_string($conn, $_POST['gd']);
$address = mysqli_real_escape_string($conn, $_POST['ad']);
$contactNumber = mysqli_real_escape_string($conn, $_POST['cn']);
$workExperience1 = mysqli_real_escape_string($conn, $_POST['we1']);
$workExperience2 = mysqli_real_escape_string($conn, $_POST['we2']);
$workExperience3 = mysqli_real_escape_string($conn, $_POST['we3']);
$workExperience4 = mysqli_real_escape_string($conn, $_POST['we4']);
$workExperience5 = mysqli_real_escape_string($conn, $_POST['we5']);
$attainment = mysqli_real_escape_string($conn, $_POST['ea']);

$sql = "UPDATE `job_seekers` SET`first_name`='$firstName',`middle_name`='$middleName',`last_name`='$lastName',
`birthday`='$birthDate',`civil_status`='$civilStatus',`gender`='$gender',`address`='$address',`contact_number`='$contactNumber',`work_experience_1`='$workExperience1',
`work_experience_2`= NULLIF('$workExperience2', ''), `work_experience_3`= NULLIF('$workExperience3', ''), `work_experience_4`= NULLIF('$workExperience4', ''),
`work_experience_5`= NULLIF('$workExperience5', ''), `attainment`='$attainment' WHERE jsid = $jsid";
$query = mysqli_query($conn, $sql);

if($query){
    echo "Your acount details has been updated successfully!";
} else{
    echo "Some error occured. Please try again";
}

?>