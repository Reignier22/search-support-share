<?php 
$page_title = "Admin | Slider Content";
include "includes/header.php";
?>

<style>
    .slider-caption{
        display: flex; 
        left:5%; 
        align-items:center;
        padding: 120px 0;
    }
    .slider-caption h3{
        text-align: left; 
        text-transform:uppercase; 
        color:#37393c !important;
        font-family: 'Montserrat', sans-serif; 
        font-weight: 600; 
        font-size: 5em;
    }
    .slider-caption p{
        text-align: left; 
        color:#fff; 
        width:50%
    }
    .file-group{
        padding-left: 10px;
        padding-right: 10px;
    }
    .form-label.caption{
        padding-top: 10px;
    }
    .buttons{
        display: flex;
        justify-content: right;
    } 
    .buttons button{
        margin: 5px;
    }
    .file-group textarea{
        background-color: #f5f5f9;
        padding: 8px;
    }

</style>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y"> <!-- Content -->
        <div class="row"> <!-- Row -->

        <h4 class="fw-bold"><span class="text-muted fw-light"> Manage Content /</span> Slider </h4>  

        <div class="col-md">

        <form action="controllers/slider.php" id="sliderForm" autocomplete="off" enctype="multipart/form-data">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="button-wrapper" style="display: grid; grid-template-columns:repeat(3, 1fr); margin-bottom:20px">
                        <div class="file-group">
                            <label for="formFile" class="form-label">Choose an Image for the first slide</label>
                            <input type="file" name="fileA" id="fileA" class="form-control" onchange="preview1()" accept="jpeg, jpg, png">
                            <input type="hidden" name="imageA" value="<?= $fetch_slider['imageA'] ?>" >
                        </div>

                        <div class="file-group">
                            <label for="formFile" class="form-label">Choose an Image for the second slide</label>
                            <input type="file" name="fileB" id="fileB" class="form-control" onchange="preview2()" accept="jpeg, jpg, png">
                            <input type="hidden" name="imageB" value="<?= $fetch_slider['imageB'] ?>" >
                        </div>

                        <div class="file-group">
                            <label for="formFile" class="form-label">Choose an Image for the third slide</label>
                            <input type="file" name="fileC" id="fileC" class="form-control" onchange="preview3()" accept="jpeg, jpg, png">
                            <input type="hidden" name="imageC" value="<?= $fetch_slider['imageC'] ?>" >
                        </div>

                        <div class="file-group">
                            <label for="formFile" class="form-label caption">Search Caption</label>
                            <textarea class="form-control" name="search_caption" oninput="searchCaption(this)" rows="3"> <?php echo $fetch_slider['search_caption'] ?> </textarea>
                        </div>
                        
                        <div class="file-group">
                            <label for="formFile" class="form-label caption">Support Caption</label>
                            <textarea class="form-control" name="support_caption" oninput="supportCaption(this)" id="exampleFormControlTextarea1" rows="3"> <?php echo $fetch_slider['support_caption'] ?> </textarea>
                        </div>

                        
                        <div class="file-group">
                            <label for="formFile" class="form-label caption">Share Caption</label>
                            <textarea class="form-control" name="share_caption" oninput="shareCaption(this)" id="exampleFormControlTextarea1" rows="3"> <?php echo $fetch_slider['share_caption'] ?> </textarea>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-12 col-xl-12">
                  <div class="card bg-warning text-white mb-3">
                    <div class="card-body">
                      <p class="card-text"> Remember to click the save button after you preview your slider. All changes that will be done here will reflect on the landing page of job-seekers, project initiators, contributors, and employers.</p>
                    </div>
                  </div>
                </div>

                  <div id="carouselExample-cf" class="carousel carousel-dark slide carousel mb-3" >
                    <ol class="carousel-indicators">
                      <li data-bs-target="#carouselExample-cf" data-bs-slide-to="0" class="active"></li>
                      <li data-bs-target="#carouselExample-cf" data-bs-slide-to="1" class="" aria-current="true"></li>
                      <li data-bs-target="#carouselExample-cf" data-bs-slide-to="2" class=""></li>
                    </ol>
                    <div class="carousel-inner">
                      <div class="carousel-item active" style="width: 100%;">
                        <img class="d-block" id="image1"  style="width: 1366px; height:468.02px" src="../assets/img/slider/<?= $fetch_slider['imageA']?>" alt="First slide">
                        <div class="carousel-caption d-md-block slider-caption">
                          <h3>Search</h3>
                          <p id="search_caption" ><?= $fetch_slider['search_caption'] ?></p>
                        </div>
                      </div>
                      <div class="carousel-item">
                        <img class="d-block" id="image2" style="width: 1366px; height:468.02px" src="../assets/img/slider//<?= $fetch_slider['imageB']?>" alt="Second slide">
                        <div class="carousel-caption d-md-block slider-caption">
                          <h3>Support</h3>
                          <p  id="support_caption"><?= $fetch_slider['support_caption'] ?></p>
                        </div>
                      </div>
                      <div class="carousel-item">
                        <img class="d-block" id="image3" style="width: 1366px; height:468.02px" src="../assets/img/slider//<?= $fetch_slider['imageC']?>" alt="Third slide">
                        <div class="carousel-caption d-md-block slider-caption">
                          <h3>Share</h3>
                          <p  id="share_caption"><?= $fetch_slider['share_caption'] ?></p>
                        </div>
                      </div>
                    </div>
             
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
    </div>
</div>



<?php 
include '../messages.php';
include 'includes/footer.php'; ?>

<script type="text/javascript">
    function preview1() {
    image1.src=URL.createObjectURL(event.target.files[0]);
    }
    function preview2() {
    image2.src=URL.createObjectURL(event.target.files[0]);
    }function preview3() {
    image3.src=URL.createObjectURL(event.target.files[0]);
    }function searchCaption(caption){
        document.getElementById('search_caption').innerText = caption.value;
    }function supportCaption(caption){
        document.getElementById('support_caption').innerText = caption.value;
    }function shareCaption(caption){
        document.getElementById('share_caption').innerText = caption.value;
    }
</script>

<script>

  $(document).ready(function() {
    $("#sliderForm").on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '../controllers/slider.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(msg) {
                if (msg == "okokokok"){
                    $('#updateMsg').show();
                    $('#update_body').html('Hi admin, your changes has been saved successfully.');
                    $('#sliderForm')[0].reset();
                } else{
                    $('#errorMsg').show();
                    $('#error_body').html('Some error occured, please try updating again'); 
                }
            }
        });
    });

    $('.btn-close').on('click', function(){
      $(".bs-toast").fadeOut();
    });

    $('#resetBTN').on('click', function(){
        window.location.reload();
    });

  });

</script>