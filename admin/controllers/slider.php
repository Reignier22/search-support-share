<?php 

include 'dbController.php';
include 'dashboard.php';

$fileA = $_FILES['fileA']['name'];
$fileB = $_FILES['fileB']['name'];
$fileC = $_FILES['fileC']['name'];
$searchCaption = mysqli_real_escape_string($conn, $_POST['search_caption']);
$supportCaption = mysqli_real_escape_string($conn, $_POST['support_caption']);
$shareCaption = mysqli_real_escape_string($conn, $_POST['share_caption']);

$fetchA = mysqli_real_escape_string($conn, $_POST['imageA']);
$fetchB = mysqli_real_escape_string($conn, $_POST['imageB']);
$fetchC = mysqli_real_escape_string($conn, $_POST['imageC']);

if(empty($fileA) ){
    $insert = mysqli_query($conn, "UPDATE `content_manage` SET 
    `imageB`='$fetchB' ");
    echo $insert ? 'ok' : 'err';
} else{
    
    $uploadedfileA = '';
    if (!empty($_FILES["fileA"]["type"])) {
        $fileA = time() . '_' . $_FILES['fileA']['name'];
        $valid_extensions = array("jpeg", "jpg", "png");
        $temporary = explode(".", $_FILES["fileA"]["name"]);
        $file_extension = end($temporary);
        if ((($_FILES["fileA"]["type"] == "image/png") || ($_FILES["fileA"]["type"] == "image/jpg") || ($_FILES["fileA"]["type"] == "image/jpeg")) && in_array($file_extension, $valid_extensions)) {
            $sourcePath = $_FILES['fileA']['tmp_name'];
            $targetPath = "../assets/img/slider/" . $fileA;
            if (move_uploaded_file($sourcePath, $targetPath)) {
                $uploadedfileA = $fileA;
            }
        }
    }

    
    $insert = mysqli_query($conn, "UPDATE `content_manage` SET 
    `imageA`='$uploadedfileA'");
    echo $insert ? 'ok' : 'err';

}

if (empty($fileB)){
    $insert = mysqli_query($conn, "UPDATE `content_manage` SET 
    `imageB`='$fetchB' ");
    echo $insert ? 'ok' : 'err';
} else{
    $uploadedfileB = '';
    if (!empty($_FILES["fileB"]["type"])) {
        $fileB = time() . '_' . $_FILES['fileB']['name'];
        $valid_extensions = array("jpeg", "jpg", "png");
        $temporary = explode(".", $_FILES["fileB"]["name"]);
        $file_extension = end($temporary);
        if ((($_FILES["fileB"]["type"] == "image/png") || ($_FILES["fileB"]["type"] == "image/jpg") || ($_FILES["fileB"]["type"] == "image/jpeg")) && in_array($file_extension, $valid_extensions)) {
            $sourcePath = $_FILES['fileB']['tmp_name'];
            $targetPath = "../assets/img/slider/" . $fileB;
            if (move_uploaded_file($sourcePath, $targetPath)) {
                $uploadedfileB = $fileB;
            }
        }
    }

    $insert = mysqli_query($conn, "UPDATE `content_manage` SET 
    `imageB`='$uploadedfileB' ");
    echo $insert ? 'ok' : 'err';
}

if (empty($fileC)){
    $insert = mysqli_query($conn, "UPDATE `content_manage` SET 
    `imageC`='$fetchC' ");
    echo $insert ? 'ok' : 'err';
} else{
    $uploadedfileC = '';
    if (!empty($_FILES["fileC"]["type"])) {
        $fileC = time() . '_' . $_FILES['fileC']['name'];
        $valid_extensions = array("jpeg", "jpg", "png");
        $temporary = explode(".", $_FILES["fileC"]["name"]);
        $file_extension = end($temporary);
        if ((($_FILES["fileC"]["type"] == "image/png") || ($_FILES["fileC"]["type"] == "image/jpg") || ($_FILES["fileC"]["type"] == "image/jpeg")) && in_array($file_extension, $valid_extensions)) {
            $sourcePath = $_FILES['fileC']['tmp_name'];
            $targetPath = "../assets/img/slider/" . $fileC;
            if (move_uploaded_file($sourcePath, $targetPath)) {
                $uploadedfileC = $fileC;
            }
        }
    }

    $insert = mysqli_query($conn, "UPDATE `content_manage` SET 
    `imageC`='$uploadedfileC' ");
    echo $insert ? 'ok' : 'err';
}

if(!empty($searchCaption) || !empty($supportCaption) || !empty($shareCaption)){
    $insert = mysqli_query($conn, "UPDATE `content_manage` SET `search_caption`='$searchCaption',`support_caption`='$supportCaption',`share_caption`='$shareCaption'
    WHERE cmid = 1 ");
    echo $insert ? 'ok' : 'err';
}




?>
