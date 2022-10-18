<?php 
$page_title = "Admin | Contact Information";
include "includes/header.php";
?>

<style>
    .buttons{
        margin-top: 10px;
        display: flex;
        justify-content: right;
    } 
    .buttons button{
        margin: 5px;
    }
    .input-group textarea{
        height: 120px;
        background-color: #f8f8f8;
        resize: none;
        margin: 5px;
    } 
    .input-group textarea:focus{
        background-color: #fff;
    }
</style>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y"> <!-- Content -->
        <div class="row"> <!-- Row -->
            <h4 class="fw-bold"><span class="text-muted fw-light"> Manage Content /</span> Contact Information </h4>  

            <div class="col-md">

                <div class="card">
                    <div class="card-header">
                        Persons With Disability Affairs Office of Pagsanjan
                    </div>
                    <div class="card-body">

                    <form action="../controllers/contact.php" id="formContact">
                        <div class="input-group">
                            <textarea class="form-control" name="line1"> <?= $fetch_con['line_1'] ?></textarea> 
                        </div> 

                        <div class="input-group">
                            <textarea class="form-control" name="line2"> <?= $fetch_con['line_2'] ?></textarea>
                        </div>

                        <div class="buttons">
                            <button type="button" id="resetBTN" class="btn btn-outline-secondary">
                                <span class="tf-icons bx bx-reset"></span>&nbsp; Reset Changes
                            </button>

                            <button type="submit" class="btn btn-primary">
                                <span class="tf-icons bx bx-save"></span>&nbsp; Save Changes
                            </button>
                        </div>
                    </form>

                    </div>
                    
                </div>

            </div> <!-- col -->
        </div> <!-- row -->
    </div> <!-- Content -->
</div> <!-- Content-wrapper -->

<?php include 'includes/footer.php';
include '../messages.php'; ?>
<script>
$(document).ready(function() {
    $("#formContact").on('submit', function(e) {
        e.preventDefault();
 
        if(!confirm("Confirm your changes to proceed.")){
          return false;
        } else{          
          $.ajax({
              type: 'POST',
              url: '../controllers/contact.php',
              data: new FormData(this),
              contentType: false,
              cache: false,
              processData: false,
              success: function(msg) {
                if (msg == "ok"){
                    $('#updateLogo').show();
                    $('#update_body_logo').html('Hi admin, your changes has been saved successfully.');
                    $('#formContact')[0].reset();
                } else{
                    $('#errorMsg').show();
                    $('#error_body').html('Some error occured, please try updating again'); 
                }
              }
          });
        }
    });

    $('.btn-close').on('click', function(){
      $(".bs-toast").fadeOut();
    });

    $('#resetBTN').on('click', function(){
        $('#formContact')[0].reset();
    });


});
</script>