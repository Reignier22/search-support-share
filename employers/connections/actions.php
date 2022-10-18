<?php 
include 'config.php';

if(isset($_POST['view_btn'])){
   $jobid =  $_POST['jobid'];

   $jobs = "SELECT jobs.jobid, categories.name as 'catname',
   jobs.job_title, jobs.job_description, jobs.employees_needed, jobs.duration, jobs.salary, jobs.qualification, jobs.preffered_sex, jobs.address, jobs.postedOn
   FROM jobs
   INNER JOIN categories ON categories.catid = jobs.catid
   INNER JOIN employers ON employers.empid = jobs.empid WHERE jobid = $jobid ";  
   $rs = mysqli_query($conn, $jobs);

   if(mysqli_num_rows($rs) > 0) {
       foreach($rs as $jobrow) {

            echo $return = '
                <h5> <strong>Title </strong>  ' . $jobrow['job_title'] . '</h5>
                <h5> <strong>Category </strong>  ' . $jobrow['catname'] . '</h5>
                <h5> <strong>Description </strong> ' . $jobrow['job_description'] . '</h5>
                <h5> <strong>Employees Needed </strong> ' . $jobrow['employees_needed'] . '</h5>
                <h5> <strong>Duration </strong> ' . $jobrow['duration'] . '</h5>
                <h5> <strong>Salary </strong> ' . $jobrow['salary'] . '</h5>
                <h5> <strong>Qualification </strong> ' . $jobrow['qualification'] . '</h5>
                <h5> <strong>Preffered Gender </strong> ' . $jobrow['preffered_sex'] . '</h5>
                <h5> <strong>Date Posted </strong> ' . $jobrow['postedOn'] . '</h5>
            ';

        }
    }    
    else {
        echo $return = "<h5>No Records found </h5>";
    }

}

//EDIT

if(isset($_POST['edit_btn'])){
    $jobid =  $_POST['jobid'];
    $result_array = [];
 
    $jobs = "SELECT jobs.jobid, jobs.catid as catID,
    jobs.job_title, jobs.job_description, jobs.employees_needed, jobs.duration, jobs.salary, jobs.qualification, jobs.preffered_sex, jobs.address, jobs.postedOn
    FROM jobs 
    INNER JOIN categories ON categories.catid = jobs.catid
    WHERE jobid = $jobid ";  
    $rs = mysqli_query($conn, $jobs);
 
    if(mysqli_num_rows($rs) > 0) {
        foreach($rs as $jobrow) {
            array_push($result_array, $jobrow);
            header('Content-type: application/json');
            echo json_encode($result_array); 
        }
     }    
     else {
         echo $return = "<h5>No Records found </h5>";
     }
 
 }

 //UPDATE 
 if (isset($_POST['update'])){
    $jobid = $_POST['jobid'];
    $title = $_POST['job_title'];
    $employees = $_POST['employees'];
    $duration = $_POST['duration'];
    $salary = $_POST['salary'];
    $gender = $_POST['gender'];
    $catid = $_POST['catid'];
    $description = $_POST['description'];
    $qualification = $_POST['qualification'];
    $location = $_POST['location'];

    $update_query = "UPDATE `jobs` SET `catid`=' $catid ',`job_title`='$title ',`job_description`='$description',`employees_needed`='$employees',`duration`='$duration',`salary`='$salary',`qualification`='$qualification',`preffered_sex`='$gender',`address`='$location' WHERE jobid = '$jobid' ";
    $result = mysqli_query($conn, $update_query);

    if($result){
        ?>
        <script>
            alert("<?php echo " Job Updated " ?>");
            window.location.replace("../employer_profile.php");
        </script>
        <?php
    } else{
        ?>
        <script>
            alert("<?php echo " Job Not Updated " ?>");
            window.location.replace("../employer_profile.php");
        </script>
        <?php
    }

 }

 //DELETE

 if(isset($_POST['checking_delete'])){
    $delid = $_POST['delete_id'];
    
    $delete_query = " DELETE FROM `jobs` WHERE jobid = $delid";
    $drs = mysqli_query($conn, $delete_query);

    if($drs){
        echo " Successfully deleted";
    } else{
        echo " Deletion unsuccessful";
    }
 }


?>

