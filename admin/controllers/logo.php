<?php
include 'dbController.php';

$file_logo = mysqli_real_escape_string($conn, $_FILES['sys_logo']['name']);

if(!empty($file_logo)){
    $uploadedsys_logo = '';
    if (!empty($_FILES["sys_logo"]["type"])) {
        $sys_logo = time() . '_' . $_FILES['sys_logo']['name'];
        $valid_extensions = array("jpeg", "jpg", "png");
        $temporary = explode(".", $_FILES["sys_logo"]["name"]);
        $file_extension = end($temporary);
        if ((($_FILES["sys_logo"]["type"] == "image/png") || ($_FILES["sys_logo"]["type"] == "image/jpg") || ($_FILES["sys_logo"]["type"] == "image/jpeg")) && in_array($file_extension, $valid_extensions)) {
            $sourcePath = $_FILES['sys_logo']['tmp_name'];
            $targetPath = "../../assets/home-plugins/img/" . $sys_logo;
            if (move_uploaded_file($sourcePath, $targetPath)) {
                $uploadedsys_logo = $sys_logo;
            }
        }
    }

    $insert = mysqli_query($conn, "UPDATE `content_manage` SET 
    `logo`='$uploadedsys_logo'");
    echo $insert ? 'ok' : 'err';

}
