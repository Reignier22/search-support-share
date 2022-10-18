<?php 
include 'dbController.php';

if(isset($_GET['rid'])){
    $rid = mysqli_real_escape_string($conn, $_GET['rid']);
    $query = "SELECT reports.rid, reports.cid, reports.reason, campaigns.cid AS 'cid', campaigns.project_title AS 'pt', campaigns.project_description AS 'pd', campaigns.project_goal AS 'pg', campaigns.end_date AS 'ed', campaigns.qr_code AS 'qr', campaigns.image AS 'img', campaigns.image2 AS 'img2', campaigns.image3 AS 'img3', campaigns.date_added AS 'da',
    campaigns.display AS 'display'
    FROM `reports` 
    INNER JOIN campaigns ON campaigns.cid = reports.cid
    WHERE rid='$rid' AND  display IN('visible', 'not_visible'); ";
    $query_run = mysqli_query($conn, $query);
    $update = mysqli_query($conn, "UPDATE `reports` SET `status`='reviewed' WHERE rid = '$rid' ");

    if(mysqli_num_rows($query_run) == 1){
        $report = mysqli_fetch_array($query_run);
        $res = [
            'status' => 200,
            'message' => 'Report fetched successfully',
            'data' => $report
        ];
        echo json_encode($res);
        return false;

    } else{
        $res = [
            'status' => 422,
            'message' => 'Report ID not found'
        ];
        echo json_encode($res);
        return false;
    }
}

if(isset($_GET['report_id'])){
    $report_id = mysqli_real_escape_string($conn, $_GET['report_id']);
    $query = "SELECT reports.rid, reports.jobid, reports.reason, jobs.jobid AS 'jobid', jobs.empid AS 'empid',  
    employers.company_name AS 'cm', categories.name AS 'name', jobs.catid AS 'catid', jobs.job_title AS 'jt', jobs.job_description AS 'job_desc', 
    jobs.employees_needed AS 'en', jobs.duration AS 'd', jobs.salary AS 's', jobs.qualification AS 'qualification', jobs.preffered_sex AS 'ps', 
    jobs.address AS 'a', jobs.display AS 'ds'
    FROM `reports`
    INNER JOIN jobs ON jobs.jobid = reports.jobid
    INNER JOIN categories ON categories.catid = jobs.jobid
    INNER JOIN employers ON employers.empid = jobs.empid
    WHERE rid = '$report_id' AND display IN('visible', 'not_visible'); ";
    $query_run = mysqli_query($conn, $query);
    $update = mysqli_query($conn, "UPDATE `reports` SET `status`='reviewed' WHERE rid = '$report_id' ");

    if(mysqli_num_rows($query_run) == 1){
        $report = mysqli_fetch_array($query_run);
        $res = [
            'status' => 200,
            'message' => 'Report fetched successfully',
            'data' => $report
        ];
        echo json_encode($res);
        return false;

    } else{
        $res = [
            'status' => 422,
            'message' => 'Report ID not found'
        ];
        echo json_encode($res);
        return false;
    }

 }

