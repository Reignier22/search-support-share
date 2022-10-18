<?php
include_once 'config.php';

$jobid = mysqli_real_escape_string($conn, $_POST['jobid']);
$jsid = mysqli_real_escape_string($conn, $_POST['jsid']);
$empid = mysqli_real_escape_string($conn, $_POST['empid']);


$check = "SELECT * FROM `apply` WHERE jsid = '$jsid' AND jobid = '$jobid' ";
$rs = mysqli_query($conn, $check);

if (mysqli_num_rows($rs) > 0) {
    echo 'applied';

} else if (empty($_FILES['file']['name'])) {
    $insert = mysqli_query($conn, "INSERT INTO `apply`(`jobid`, `jsid`, `empid`, `resume`, `status`, `active_status`) VALUES ('$jobid','$jsid', '$empid', 'no resume added','application submitted', '0')");
    echo $insert ? 'ok' : 'err';

} else {
    if (!empty($_FILES['file']['name'])) {
        $uploadedFile = '';

        if (!empty($_FILES["file"]["type"])) {
            $fileName = time() . '_' . $_FILES['file']['name'];
            $valid_extensions = array("doc", "pdf", "ppt", "docx", "pptx");
            $temporary = explode(".", $_FILES["file"]["name"]);
            $file_extension = end($temporary);
            if ((($_FILES["file"]["type"] == "application/msword") || ($_FILES["file"]["type"] == "application/pdf") || ($_FILES["file"]["type"] == "application/vnd.ms-powerpoint") || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document") || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.presentationml.presentation")) && in_array($file_extension, $valid_extensions)) {
                $sourcePath = $_FILES['file']['tmp_name'];
                $targetPath = "../profile_includes/resume/" . $fileName;
                if (move_uploaded_file($sourcePath, $targetPath)) {
                    $uploadedFile = $fileName;
                }
            }
        }

        $insert = mysqli_query($conn, "INSERT INTO `apply`(`jobid`, `jsid`, `empid`, `resume`, `status`, `active_status`) VALUES ('$jobid','$jsid', '$empid', '$uploadedFile','application submitted', '1')");
        echo $insert ? 'ok' : 'err';
    } else {
        echo "error";
    }
}

