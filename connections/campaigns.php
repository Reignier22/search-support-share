<?php
if (!empty($_POST['jsid']) || !empty($_POST['project_title']) || !empty($_POST['project_description']) || !empty($POST['project_goal']) || !empty($_POST['month']) || !empty($_POST['day']) || !empty($_POST['year']) || !empty($_POST['year']) || !empty($_FILES['qr_code']['name']) || !empty($_FILES['banner1']['name']) || !empty($_FILES['banner2']['name']) || !empty($_FILES['banner3']['name']) ) {
    
    $qrcodeUpload = '';
    if (!empty($_FILES["qr_code"]["type"])) {
        $qr_code = time() . '_' . $_FILES['qr_code']['name'];
        $valid_extensions = array("jpeg", "jpg", "png");
        $temporary = explode(".", $_FILES["qr_code"]["name"]);
        $file_extension = end($temporary);
        if ((($_FILES["qr_code"]["type"] == "image/png") || ($_FILES["qr_code"]["type"] == "image/jpg") || ($_FILES["qr_code"]["type"] == "image/jpeg")) && in_array($file_extension, $valid_extensions)) {
            $sourcePath = $_FILES['qr_code']['tmp_name'];
            $targetPath = "../profile_includes/assets/qr_code/" . $qr_code;
            if (move_uploaded_file($sourcePath, $targetPath)) {
                $qrcodeUpload = $qr_code;
            }
        }
    }

    $uploadedbanner1 = '';
    if (!empty($_FILES["banner1"]["type"])) {
        $banner1 = time() . '_' . $_FILES['banner1']['name'];
        $valid_extensions = array("jpeg", "jpg", "png");
        $temporary = explode(".", $_FILES["banner1"]["name"]);
        $file_extension = end($temporary);
        if ((($_FILES["banner1"]["type"] == "image/png") || ($_FILES["banner1"]["type"] == "image/jpg") || ($_FILES["banner1"]["type"] == "image/jpeg")) && in_array($file_extension, $valid_extensions)) {
            $sourcePath = $_FILES['banner1']['tmp_name'];
            $targetPath = "../profile_includes/assets/project-banner/" . $banner1;
            if (move_uploaded_file($sourcePath, $targetPath)) {
                $uploadedbanner1 = $banner1;
            }
        }
    }

    $uploadedbanner2 = '';
    if (!empty($_FILES["banner2"]["type"])) {
        $banner2 = time() . '_' . $_FILES['banner2']['name'];
        $valid_extensions = array("jpeg", "jpg", "png");
        $temporary = explode(".", $_FILES["banner2"]["name"]);
        $file_extension = end($temporary);
        if ((($_FILES["banner2"]["type"] == "image/png") || ($_FILES["banner2"]["type"] == "image/jpg") || ($_FILES["banner2"]["type"] == "image/jpeg")) && in_array($file_extension, $valid_extensions)) {
            $sourcePath = $_FILES['banner2']['tmp_name'];
            $targetPath = "../profile_includes/assets/project-banner/" . $banner2;
            if (move_uploaded_file($sourcePath, $targetPath)) {
                $uploadedbanner2 = $banner2;
            }
        }
    }

    $uploadedbanner3 = '';
    if (!empty($_FILES["banner3"]["type"])) {
        $banner3 = time() . '_' . $_FILES['banner3']['name'];
        $valid_extensions = array("jpeg", "jpg", "png");
        $temporary = explode(".", $_FILES["banner3"]["name"]);
        $file_extension = end($temporary);
        if ((($_FILES["banner3"]["type"] == "image/png") || ($_FILES["banner3"]["type"] == "image/jpg") || ($_FILES["banner3"]["type"] == "image/jpeg")) && in_array($file_extension, $valid_extensions)) {
            $sourcePath = $_FILES['banner3']['tmp_name'];
            $targetPath = "../profile_includes/assets/project-banner/" . $banner3;
            if (move_uploaded_file($sourcePath, $targetPath)) {
                $uploadedbanner3 = $banner3;
            }
        }
    }

    //include database configuration file
    include_once 'config.php';

    $jsid = mysqli_real_escape_string($conn, $_POST['jsid'] ) ;
    $project_title = mysqli_real_escape_string($conn, $_POST['project_title']) ;
    $project_goal = mysqli_real_escape_string($conn, $_POST['project_goal']) ;
    $description = mysqli_real_escape_string($conn, $_POST['project_description']) ;
    $project_description = nl2br($description);
    $year = mysqli_real_escape_string($conn, $_POST['year']) ;
    $month = mysqli_real_escape_string($conn, $_POST['month']) ;
    $day = mysqli_real_escape_string($conn,  $_POST['day']);
    $date = date("$year/$month/$day");

    //insert form data in the database
    $insert = $conn->query("INSERT campaigns (jsid, project_title,project_description,project_goal, end_date, qr_code, image, image2, image3) VALUES ('" . $jsid . "', '" . $project_title . "','" . $project_description . "' ,'" . $project_goal . "', '" . $date . "', '" . $qrcodeUpload . "','" . $uploadedbanner1 . "','" . $uploadedbanner2 . "','" . $uploadedbanner3 . "')");
    // echo $insert; die();

    echo $insert ? 'ok' : 'err';
    
}

?>
