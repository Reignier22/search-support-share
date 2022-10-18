<?php 
$page_title = '3S | Job Offers';
include 'profile_includes/profile_head.php'; 
?>
<link rel="stylesheet" href="profile_includes/assets/css/application.css">

<div class="col-md-9 job-apply">
    <div class="jo">
            <h1>Job Offers 
            <br>
                <span>This feature only works if you specify your disability classification and you set your status to available for job offers. Once completed, you will have the opportunity to receive job offers from various employers.</span>
            </h1>

            <div class="row stats">
                <div class="col-sm-12 availability">

                    <?php 
                        if($fetch['disability'] != NULL){
                            ?>  
                                <input type="text" name="other1" id="other1" value="<?= $fetch['disability'];?>" class="form-control"  style="width: 30%;" readonly>
                            <?php
                        } else{
                            ?>
                            <select name="classification" id="classification" class="form-control" style="width: 30%;">
                                    <option selected disabled>Disability Classification</option>
                                    <option value="Psychosocial Disability">Psychosocial Disability</option>
                                    <option value="Disability Due to Chronic Illness">Disability Due to Chronic Illness</option>
                                    <option value="Learning Disability">Learning Disability</option>
                                    <option value="Mental Disability">Mental Disability</option>
                                    <option value="Visual Disability">Visual Disability</option>
                                    <option value="Orthopedic Disability">Orthopedic Disability</option>
                                    <option value="Communication Disability">Communication Disability</option>
                                    <option value="Other">Other</option>
                                </select>
                                <input type="text" name="other" id="other" class="form-control"  style="width: 30%; display:none" placeholder="Enter your disability classfication" >
                            <?php
                        }
                    ?>
                    <label for="availability"> <p class="mylabel"> <?=$fetch['status'];?> </p> </label>
                    <label class="toggle" for="myToggle">
                        <input class="toggle__input" name="checkMe" type="checkbox" id="myToggle" <?php if($fetch['status'] == "available"){ echo "checked"; } ?>>
                        <div class="toggle__fill"></div>
                    </label>    
                </div>
                <input type="hidden" name="jsid" id="jsid" value="<?= $_SESSION['userid']; ?>" >
                

                <?php 

                    if($fetch['status'] == 'available'){
                        ?>

                        <div class="col-md-12">
                            <div class="table-responsive custom-table-responsive">
                                <table class="table custom-table">
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>
                                            <th scope="col">Company</th>
                                            <th scope="col">Job Offer Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php 
                                            $jsid = $_SESSION['userid'];
                                            $query_jo = mysqli_query($conn, "SELECT job_offers.jsid, job_offers.empid, job_offers.message, job_offers.date_offered, employers.company_name AS 'cname', employers.email AS 'em', employers.contact_number AS 'cn', employers.com_profile as 'profile'
                                            FROM job_offers
                                            INNER JOIN employers ON employers.empid = job_offers.empid WHERE job_offers.jsid = '$jsid' ");
                                            
                                            if(mysqli_num_rows($query_jo) > 0){
                                                foreach($query_jo as $jrow)
                                            {
                                        ?>

                                        <tr class="spacer"> <td colspan="3"></td> </tr>
                                        
                                        <tr class="tr-container">
                                            <th scope="row"></th>
                                            <td>
                                                <div class="td-company">
                                                    <img class="img" src="employers/assets/profile/<?=$jrow['profile'];?>" alt="employer_profile">
                                                    <span> <?= $jrow['cname'] ?> <br>
                                                    <small><?= $jrow['em'] ?></small> <br>
                                                    <small><?= $jrow['cn'] ?></small>
                                                    </span>
                                                </div>
                                            </td>
                                            <td style="font-size: 1.5rem; padding:10px; text-align:justify"> <?= $jrow['message']; ?> </td>
                                        </tr>
                                    
                                        <tr class="spacer"> <td colspan="3"></td> </tr>

                                        <?php
                                            }
                                        } else{
                                            ?>
                                            <tr>
                                                <td colspan="3" class="active"><div> <p style="text-align: center;">No job offers yet. Please check again later.</p> </div> </td>
                                            </tr>
                                            <?php
                                        }    
                                        ?>

                                    </tbody>
                                </table>
                            </div>

                        <?php
                    }
                
                ?>

			</div>
        </div>
    </div>
</div>


<?php include 'profile_includes/profile_footer.php'; ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>

<script>

$('#classification').change(function(){
    var classified = $(this).val();
    if(classified === "Other"){
        $(this).css('display', 'none');
        $('#other').show();
    }
});

$('input[type="checkbox"]').click(function(){
   var jsid = $('#jsid').val();
   var classification = $('#classification').val();
   var other = $('#other').val();
   var other1 = $('#other1').val();

   if($(this).is(":not(:checked)")){
        if(!confirm("If you turn this on, you won't receive any job offers.") ){
            return false;
        } else{
            $.ajax({
                type: 'POST',
                url: 'connections/actions_2.php',
                data: {
                    'disable_btn' : true,
                    jsid_disable : jsid,
                },
                success: function(response){
                    alert(response);
                    window.location.reload();
                }
            });
        }     
    } else if (other1 != undefined ){
        if($(this).is(":checked")){
            if(!confirm("Turning this on means that you allow different employers from sending job offers to you.") ){
                return false;
            } else{
                $.ajax({
                    type: 'POST',
                    url: 'connections/actions_2.php',
                    data: {
                        'allow_btn_1' : true,
                        jsid_allow : jsid,
                    },
                    success: function(response){
                        alert(response);
                        window.location.reload();
                    }
                });
            }    
        }
    } else{
        if (classification === null){
        alert("Please select your disability classification");
        return false;
        } else if (classification === "Other" && other===""){
                alert("Please enter your disability classification");
                return false;
        } else{
                if($(this).is(":checked")){
                    if(!confirm("Turning this on means that you allow different employers from sending job offers to you.") ){
                        return false;
                    } else{
                        $.ajax({
                            type: 'POST',
                            url: 'connections/actions_2.php',
                            data: {
                                'allow_btn' : true,
                                'classification': classification,
                                'other': other,
                                jsid_allow : jsid,
                            },
                            success: function(response){
                                alert(response);
                                window.location.reload();
                            }
                        });
                    }    
                }
        }
    }

});
</script>