<!DOCTYPE html>
<html>
<head>
	<title>Resume</title>
	<link rel="stylesheet" type="text/css" href="assets/css/resume.css"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

<?php 
    include '../connections/config.php';
    $jsid = $_GET['jsid'];
    $query = mysqli_query($conn, "SELECT * FROM job_seekers WHERE jsid = '$jsid' ");
    $fetch = mysqli_fetch_array($query);
?>

	<div class="main">
		<div class="top-section">   
            <div class="print"> <i class='bx bxs-printer' title="print" onclick="window.print();"></i> </div>
            <div class="home"> <a href="../account.php"> <i class='bx bx-right-top-arrow-circle' title="back"></i> </a> </div>
			<div class="img-container"> 

            <?php 
                $profileImg = $fetch['profile'];
                $gender = $fetch['gender'];

                if($profileImg == 'default.png'){
                    if($gender == 'Male'){
                        ?>
                            <img src="assets/defaults/male_default.png"  class="profile" />
                        <?php
                    } else if($gender == 'Female'){
                        ?>  
                            <img src="assets/defaults/female_default.png"  class="profile" />
                        <?php
                    } else{
                        ?>  
                            <img src="assets/defaults/default.jpg"  class="profile" />
                        <?php
                    }
                } else{
                    ?>  
                        <img src="profile_pic/<?= $fetch['profile'];?>"  class="profile" />
                    <?php
                }
            ?>
            </div> 
			<p class="p1"><?= $fetch['last_name']. ", " ;?> <span><?php $mn = $fetch['middle_name']; echo $fetch['first_name']. " " .$mn[0] . "."; ?></span></p>
		</div>
	<div class="clearfix"></div>

		<div class="col-div-12">
			<div class="content-box p-info" style="padding-left: 40px;">

                <p class="head">Personal Information</p>

                <div class="div-1">
                    <p class="p3 label"> Gender </p>
                    <p class="p3 label"> Age </p>
                    <p class="p3 label"> Civil Status </p>
                    <p class="p3 label"> Disability Classification </p> 
                </div>
                
                <div class="div-2">
                    <p class="p3">: &nbsp; <?= $fetch['gender']; ?> </p>
                    <p class="p3">: &nbsp; <?= $fetch['birthday']; ?> </p>
                    <p class="p3">: &nbsp; <?= $fetch['civil_status']; ?> </p>
                    <?php 
                        if($fetch['disability'] != NULL){
                            echo "<p class='p3'>: &nbsp;". $fetch['disability'] . "</p>";
                        }
                    ?>
                    
                </div>		

			</div>
		</div>

        <div class="col-div-12">
			<div class="content-box p-info" style="padding-left: 40px;">

                <p class="head">Contact Information</p>

                <div class="div-1">
                    <p class="p3 label"> <i class='bx bxs-envelope'></i> &nbsp; Email </p>
                    <p class="p3 label"> <i class='bx bxs-phone'></i> &nbsp; Contact Number </p>
                    <p class="p3 label"> <i class='bx bxs-home' ></i> &nbsp; Address </p>
                </div>
                
                <div class="div-2">
                    <p class="p3">: &nbsp; <?= $fetch['email']; ?> </p>
                    <p class="p3">: &nbsp; <?= $fetch['contact_number']; ?> </p>
                    <p class="p3">: &nbsp; <?= $fetch['address']; ?> </p>
                </div>		

			</div>
		</div> 

        
        <div class="col-div-12">
			<div class="content-box p-info" style="padding-left: 40px;">

                <p class="head">Work Experience</p>

                <div class="div-3">
                    <?php 
                        if($fetch['work_experience_1'] != NULL ){
                            ?>
                                <p class='p3'> <?= $fetch['work_experience_1'] ?> </p>
                            <?php
                        }
                        if($fetch['work_experience_2'] != NULL ){
                            echo "<p class='p3'>" . $fetch['work_experience_2'] .  "</p>";
                        }
                        if($fetch['work_experience_3'] != NULL ){
                            echo "<p class='p3'>" . $fetch['work_experience_3'] .  "</p>";
                        }
                        if($fetch['work_experience_4'] != NULL ){
                            echo "<p class='p3'>" . $fetch['work_experience_4'] .  "</p>";
                        }
                        if($fetch['work_experience_5'] != NULL ){
                            echo "<p class='p3'>" . $fetch['work_experience_5'] .  "</p>";
                        }
                    ?>
                </div>		
			</div>
		</div> 

        <div class="col-div-12">
			<div class="content-box p-info" style="padding-left: 40px;">

                <p class="head">Highest Educational Attainment</p>

                <div class="div-3">
                    <p class="p3" > <?= $fetch['attainment'] ?> </p>
                </div>		

			</div>
		</div> 


		<div class="clearfix"></div>

	</div>


</body>
</html>