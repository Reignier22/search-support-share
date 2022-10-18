<?php
include "config.php";
error_reporting(0);

if(isset($_POST['update'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $contact_number = $_POST['cnumber'];
    $company_name = $_POST['cname'];
    $empid = $_POST['empid'];


    if($_FILES['image']['error'] === 4){
        echo "<script>alert('Image doesn't Exist');</script>";
    }else{
        $filename = $_FILES['image']['name'];
        $fileSize = $_FILES['image']['size'];
        $tmpName = $_FILES['image']['tmp_name'];

        $validImageExtention = ['jpg','jpeg','png'];
        $imageExtention = explode('.',$filename);
        $imageExtention = strtolower(end($imageExtention));

        if(!in_array($imageExtention, $validImageExtention)){
            echo "<script>alert('Invalid Image Extention');</script>";
        }elseif($fileSize > 1000000){
            echo "<script>alert('Image too Large');</script>";
        }else{
            $newImageName = uniqid();
            $newImageName.= "." .$imageExtention;

            move_uploaded_file($tmpName, 'com-logo/'. $newImageName);
            $query = "UPDATE `employers` SET `company_name`='$company_name',`contact_number`='$contact_number',`email`='$email',`password`='$password',`com_profile`='$newImageName' WHERE empid = $empid ";
            mysqli_query($conn, $query);
            echo 
            "<script>
                alert('Profile Updated');
                document.location.href = '../edit_profile.php';
            </script>";
        }
    }
}

?>