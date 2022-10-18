<?php 
error_reporting(0);

include 'config.php';

if (isset($_POST['addjob'])){
    $catid         = mysqli_real_escape_string($conn, $_POST['catidPHP']);
    $empid         = mysqli_real_escape_string($conn, $_POST['empidPHP']);
    $title         = mysqli_real_escape_string($conn, $_POST['titlePHP']);
    $description1   = mysqli_real_escape_string($conn, $_POST['descriptionPHP']);
    $description  = nl2br($description1);
    $employees     = mysqli_real_escape_string($conn, $_POST['employeesPHP']);
    $duration      = mysqli_real_escape_string($conn, $_POST['durationPHP']);
    $salary        = mysqli_real_escape_string($conn, $_POST['salaryPHP']);
    $gender        = mysqli_real_escape_string($conn, $_POST['genderPHP']);
    $qualification1 = mysqli_real_escape_string($conn, $_POST['qualificationPHP']);
    $qualification = nl2br($qualification1);
    $location      = mysqli_real_escape_string($conn, $_POST['locationPHP']);

    $sql = "INSERT INTO `jobs`(`catid`, `empid`, `job_title`, `job_description`, `employees_needed`, `duration`, `salary`, `qualification`, `preffered_sex`, `address`) 
                        VALUES ('$catid','$empid','$title','$description','$employees','$duration','$salary','$qualification','$gender','$location')";
    $rs = mysqli_query($conn, $sql);

    if ($rs){
        echo "Yes";
    } else{
        echo "No";
    }
}  

?>