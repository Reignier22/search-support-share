<?php 
$page_title = "Admin | Manage Users";
include "includes/header.php";
?>

<div class="content-wrapper"> <!-- Wrapper -->
    <div class="container-xxl flex-grow-1 container-p-y"> <!-- Content -->

        <div class="mb-4" style="display: flex; justify-content:space-between">
            <h4 class="fw-bold"> Manage Users</h4>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                Launch modal
            </button>
        </div>

        <div class="row row-cols-1 row-cols-md-3 g-4 mb-5"> 

        <?php  
            $admin_query = mysqli_query($conn, "SELECT * FROM admin_table WHERE access_level IN('1', '2')");

            if (mysqli_num_rows($admin_query)){
                foreach($admin_query as $arow)
                {
        ?>

            <div class="col">
                <div class="card h-100">
                <img class="card-img-top" height="270px" src="../assets/img/profiles/<?= $arow['pic']; ?>" alt="Card image cap">
                    <div class="card-body">
                        <div style="display: flex; justify-content:space-between">
                            <h5 class="card-title"> <span class='bx bxs-user'></span> <?= $arow['username'] ?> </h5>
                            <div class="form-check form-switch" >
                                <input class="form-check-input float-end" 
                                data-bs-toggle="tooltip" 
                                data-bs-offset="0,4" 
                                data-bs-placement="top" 
                                data-bs-html="true" 
                                data-bs-original-title="<i class='bx bx-info-circle'></i> <span>Turn this on to give user an access to admin account</span>" 
                                id="isClicked" type="checkbox"  
                                role="switch" <?php if($arow['access_level'] == 1){echo "checked disabled"; } else if($arow['status'] == "allowed"){ echo "checked"; } ?> >   
                                <div class="aid_closest"> <input type="hidden" name="aid" id="aid" class="aid" value="<?= $arow['aid'];?>"> </div>
                            </div>
                        </div>
                        <p class="card-text"> <span class='bx bx-envelope' ></span> Email: <?= $arow['email'] ?> </p>
                        <p class="card-text"> <span class='bx bxs-user-check' ></span> Role: 
                        <?php
                            if($arow['access_level'] == 1){
                                echo "Head Admin";
                            } else{
                                echo "Staff";
                            }
                        ?> </p>
                        <p class="card-text"> <span class='bx bxs-check-square' ></span> Status <?php 
                        if($arow['status'] == "allowed" ){
                            ?>
                                <span class="badge bg-success">Allowed</span>
                            <?php
                        } else if ($arow['status'] == "for_approval" ) {
                            ?>
                                <span class="badge bg-warning">For Approval</span>
                            <?php
                        } else{
                            ?>
                                <span class="badge bg-danger">Disabled</span>
                            <?php
                        }
                        ?> </p>
                       
                    </div>
                </div>
            </div>
        
        <?php 
             }
        } else{
            ?>
            <div class="col" style="display: flex; align-items:center; justify-content:center">
                <h5>No Admin or staff found.</h5>
            </div>
            <?php
        }
        ?>

        </div>

    </div> <!-- Content -->
</div> <!-- Wrapper -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
<script>
$('input[type="checkbox"]').click(function(){
   var aid = $(this).next('.aid_closest').find("input[name='aid']").val();

   if($(this).is(":checked")){
        if(!confirm(" Turning this on will grant the staff an access to admin account. Do you confirm this action?") ){
            return false;
        } else{
            $.ajax({
                type: 'POST',
                url: '../controllers/actions.php',
                data: {
                    'allow_btn' : true,
                    aid_allow : aid,
                },
                success: function(response){
                    alert(response);
                    window.location.reload();
                }
            });
        }    
   }
   else if($(this).is(":not(:checked)")){
    if(!confirm("Are you sure you want to disable the access of this person to admin account?") ){
        return false;
    } else{
        $.ajax({
            type: 'POST',
            url: '../controllers/actions.php',
            data: {
                'disable_btn' : true,
                aid_disable : aid,
            },
            success: function(response){
                alert(response);
                window.location.reload();
            }
        });
    }     
  }
});
</script>


<?php include 'includes/footer.php'; ?>


