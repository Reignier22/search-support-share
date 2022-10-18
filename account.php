<?php

$page_title = '3S | Account Page';
include 'profile_includes/profile_head.php'; 
?>

<div class="col-md-9 account-info" id="#account">
    <div class="row">

    <div class="title"> 
        <h1>Account Information </h1> 

        <div class="actions">
            <div class="something" id="print"><span> <i class="fa-solid fa-print"></i> <a style="text-decoration: none; color:#fff" href="profile_includes/resume.php?jsid=<?= $fetch['jsid']?>"> View as Resume </a> </span></div> 
            <div class="something" id="edit"> <span> <i class="fa-solid fa-square-pen">  </i> Edit Information </span></div>
        </div>
    </div>

    <div class="info-grid" id="default">
        <div class="info-item">
            <div class="item-title">
                <h3>Personal Information</h3>
            </div>

            <div class="labels">
                <p>First Name</p>
                <p>Middle Name</p>
                <p>Last Name</p>
                <p>Birth date</p>
                <p>Age</p>
            </div>

            <div class="values">
                <p>: &nbsp; <?php echo $fetch['first_name'] ?></p>
                <p>: &nbsp; <?php echo $fetch['middle_name'] ?></p>
                <p>: &nbsp; <?php echo $fetch['last_name'] ?></p>
                <p>: &nbsp; <?php echo $fetch['birthday'] ?></p>
                <p>: &nbsp; <?php $dob = $fetch['birthday']; $bday = new DateTime($dob); $today = new DateTime(date('m.d.y')); $diff = $today-> diff($bday); printf(' %d years old ', $diff->y); ?></p>
            </div>
        </div>

        <div class="info-item">
            <div class="item-title">
                <h3>&nbsp;</h3>
            </div>

            <div class="labels">
                <p>Gender</p>
                <p>Civil Status</p>
                <p>Contact Number</p>
                <p>Educational Attainment</p>
                <p>Address</p>
            </div>

            <div class="values">
                <p>: &nbsp; <?php echo $fetch['gender'] ?></p>
                <p>: &nbsp; <?php echo $fetch['civil_status'] ?></p>
                <p>: &nbsp; <?php echo $fetch['contact_number'] ?></p>
                <p>: &nbsp; <?php echo $fetch['attainment'] ?></p>
                <p>: &nbsp; <?php echo $fetch['address'] ?></p>
            </div>
        </div>

        <div class="item-work">
            <div class="item-title work-title">
                <p>Work Experiences</p>
            </div>

            <div class="work-1">
                <p> <?php echo $fetch['work_experience_1']; ?> </p>
                <p> <?php echo $fetch['work_experience_2']; ?> </p>
                <p> <?php echo $fetch['work_experience_3']; ?> </p>
            </div>

            <div class="work-2">
                <p> <?php echo $fetch['work_experience_4']; ?> </p>
                <p> <?php echo $fetch['work_experience_5']; ?> </p>
            </div>   
        </div>
    </div>

    <div id="editInfo">
        <div class="info-grid">

            <div class="info-item">
                <div class="item-title">
                    <h3>Personal Information</h3>
                </div>

                <div class="labels">
                    <p>First Name</p>
                    <p>Middle Name</p>
                    <p>Last Name</p>
                    <p>Birth date</p>
                </div>
            
            <form action="connections/actions.php" id="updateForm">

                <div class="values">
                    <input type="hidden" name="id" value="<?php echo $fetch['jsid']; ?>">
                    <p><input type="text" name="fn" value="<?php echo $fetch['first_name'] ?>">  </p>
                    <p><input type="text" name="mn" value="<?php echo $fetch['middle_name'] ?>"> </p>
                    <p><input type="text" name="ln" value="<?php echo $fetch['last_name'] ?>">   </p>
                    <p><input type="text" name="bd" value="<?php echo $fetch['birthday'] ?>">    </p>
                </div>
            </div>

            <div class="info-item">
                <div class="item-title">
                    <h3>&nbsp;</h3>
                </div>

                <div class="labels">
                    <p>Gender</p>
                    <p>Civil Status</p>
                    <p>Contact Number</p>
                    <p>Educational Attainment</p>
                    <p>Address</p>
                </div>

                <div class="values">
                    <p><input type="text" name="gd"  value="<?php echo $fetch['gender'] ?>">           </p>
                    <p><input type="text" name="cs" value="<?php echo $fetch['civil_status'] ?>">     </p>
                    <p><input type="text" name="cn" value="<?php echo $fetch['contact_number'] ?>">   </p>
                    <p><input type="text" name="ea" value="<?php echo $fetch['attainment'] ?>">       </p>
                    <p><input type="text" name="ad" value="<?php echo $fetch['address'] ?>">          </p>
                </div>
            </div>

            <div class="item-work">
                <div class="item-title work-title">
                    <p>Work Experiences</p>
                </div>

                <div class="work-1">
                    <?php 
                        if($fetch['work_experience_1'] != NULL){
                            ?>
                                <p><textarea  name="we1"> <?php echo $fetch['work_experience_1']; ?> </textarea></p>
                            <?php
                        } 

                        if($fetch['work_experience_2'] != NULL){
                            ?>
                                <p><textarea  name="we2"> <?php echo $fetch['work_experience_2']; ?> </textarea></p>
                            <?php
                        } else{
                            ?>
                                <input type="hidden" name="we2" value="<?= $fetch['work_experience_2'];  ?>">
                            <?php
                        }
                        if($fetch['work_experience_3'] != NULL){
                            ?>
                                <p><textarea  name="we3"> <?php echo $fetch['work_experience_3']; ?> </textarea></p>
                            <?php
                        } else{
                            ?>
                                <input type="hidden" name="we3" value="<?= $fetch['work_experience_3'];  ?>">
                            <?php
                        }
                    ?>
                </div>

                <div class="work-2">
                    <?php
                        if($fetch['work_experience_4'] != NULL){
                            ?>
                                <p><textarea  name="we4"> <?php echo $fetch['work_experience_4']; ?> </textarea></p>
                            <?php
                        } else{
                            ?>
                                <input type="hidden" name="we4" value="<?= $fetch['work_experience_4'];  ?>">
                            <?php
                        }
                        if($fetch['work_experience_5'] != NULL){
                            ?>
                                <p><textarea  name="we3"> <?php echo $fetch['work_experience_5']; ?> </textarea></p>
                            <?php
                        } else{
                            ?>
                                <input type="hidden" name="we5" value="<?= $fetch['work_experience_5'];  ?>">
                            <?php
                        }
                    ?>
                </div>
            </div>

            <div class="info-item update-item">
                <div class="update">
                    <input type="button" id="cancel" value="Cancel" style="background-color: #ccc; margin-right:5px">
                    <input type="submit" id="update" name="update" value="Update"> 
                </div>
            </form>
            </div>
            
        </div>
    </div>

    </div>
</div>

<?php include 'profile_includes/profile_footer.php'; ?>

<script>
$(document).ready(function(){
    $('#edit').click(function(){
        $('#default').hide();
        $('#editInfo').fadeIn();
    });
    $('#cancel').click(function(){
        $('#default').fadeIn();
        $('#editInfo').hide();
    });

    $('#updateForm').submit(function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'connections/actions.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
               alert(response);
               window.location.reload();
            }
        });
    });

});
</script>

