<?php
include 'config.php';

$id = mysqli_real_escape_string($conn, $_POST['jsid']);
$profile_pic = mysqli_real_escape_string($conn, $_FILES['profileImage']['name']);

$profile = time() . "_" . $profile_pic;
$target = '../profile_includes/profile_pic/' . $profile;
move_uploaded_file($_FILES['profileImage']['tmp_name'],  $target);

$sql = "UPDATE `job_seekers` SET `profile` = '$profile' WHERE jsid = $id";
$upload = mysqli_query($conn, $sql);

if($upload){
    echo "Profile picture has been updated successfully!";
} else{
    echo "Some error occured. Please try again";
}

?>
