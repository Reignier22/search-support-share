<?php 
$page_title = "Admin | Categories";
include "includes/header.php";
?>

<div class="content-wrapper">
<div class="container-xxl flex-grow-1 container-p-y"> <!-- Content -->
        <div class="row"> <!-- Row -->
            <div class="col">
                <div class="card">
                    <div style="display: flex; justify-content:space-between">
                        <h5 class="card-header">Disability Categories</h5>
                        <span style="display: flex; align-items:center; margin-right:20px">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                          Add Category
                        </button>
                        </span>
                    </div>
                        <div class="table-responsive ">
                            <table class="table table-hover" id="myTable">
                            <caption class="ms-4"> <?php 
                                if(empty($cat)){
                                    echo "No categories yet.";
                                } else{
                                    echo "Total Categories : " .$cat; 
                                }
                            ?> </caption>
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Icon</th>
                                        <th scope="col">Date Added</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                            
                                <tbody class="table-border-bottom-0">
                                <?php 
                                    $crows = mysqli_query($conn, "SELECT * FROM categories ORDER BY catid ASC"); 
                                    
                                    if (mysqli_num_rows($crows) > 0){
                                    foreach($crows as $crow) 
                                    {
                                ?>
                                <tr >
                                    <td class="catid"> <?= $crow['catid']; ?> </td>
                                    <td><?= $crow['name'] ?> </td>
                                    <td><img src="../assets/img/caticons/<?php echo $crow['image']; ?>" alt="category icon" style= "height: 50px" > </td>
                                    <td><?php $ts=$crow['date_added']; echo date("M. j, Y - g:i a ",strtotime($ts));  ?></td>
                                    <td>

                                    <button type="button" value="<?= $crow['catid'];?>" class="edit_btn btn btn-icon btn-warning">
                                        <span class="tf-icons bx bxs-edit" data-bs-toggle="modal" data-bs-target="#editModal"></span>
                                    </button>
                                    <button type="button" class="btn btn-icon btn-danger trash">
                                        <span class="tf-icons bx bxs-trash"></span>
                                    </button>

                                    </td>
                                </tr>
                                <?php 
                                        }
                                    } else{
                                        ?>
                                            <td colspan="5"> <div style="display: flex; justify-content:center; align-items:center"> <span> No Categories found. </span> </div> </td>
                                        <?php
                                    }
                                ?>
                                </tbody>
                               
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- Row -->
    </div>  <!-- Content -->
</div>


<!--MODAL-->

<div class="col-lg-4 col-md-6">
    <div class="mt-3">
        <div class="modal fade" id="basicModal" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Add New Category</h5>
                        <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    <form action="../controllers/categories.php" id="catForm" enctype="multipart/form-data">

                            <div class="alert alert-danger" role="alert" style="display: none;" id="errMsg" ></div>
                            <div class="alert alert-success" role="alert" style="display: none;"  id="succMsg" ></div>

                            <div class="row">
                                <div class="col mb-3">
                                    <label for="name" class="form-label">Category Name</label>
                                    <input type="text" name="catname" id="catname" class="form-control" placeholder="Enter Category Name">
                                </div>
                            </div>
                            
                            <div class="row g-2">
                                <div class="col mb-0">
                                    <label for="emailBasic" class="form-label">Category Icon</label>
                                    <input type="file" name="caticon" id="caticon" class="form-control" onchange="preview1()" accept="jpeg, jpg, png" >
                                </div>

                                <div class="col mb-0">
                                    <div style="display: flex; justify-content:center ">
                                        <img src="../assets/img/avatars/placeholder.png" id="image1" width="100px" alt="placeholder">
                                    </div>
                                </div>
                            </div>

                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary close" data-bs-dismiss="modal"> Close </button>
                            <button type="submit" class="btn btn-primary"> Add </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="col-lg-4 col-md-6">
    <div class="mt-3">
        <div class="modal fade" id="editModal" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Edit Category</h5>
                        <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    <form action="../controllers/actions.php" id="catForm1" enctype="multipart/form-data">

                            <div class="alert alert-danger" role="alert" style="display: none;" id="errMsgUpdate" ></div>
                            <div class="alert alert-success" role="alert" style="display: none;"  id="succMsgUpdate" ></div>

                            <div class="row">
                                <div class="col mb-3">
                                    <label for="name" class="form-label">Category Id</label>
                                    <input type="text" name="catid" id="catid" class="form-control" readonly>
                                    <input type="hidden" name="aid_upadater" id="aid_upadater"  value="<?= $_SESSION['aid'];?>">
                                    <input type="hidden" name="uname_upadater" id="uname_upadater"  value="<?= $_SESSION['username'];?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col mb-3">
                                    <label for="name" class="form-label">Category Name</label>
                                    <input type="text" name="catnamed" id="catnamed" class="form-control" >
                                </div>
                            </div>
                            
                            <div class="row g-2">
                                <div class="col mb-0">
                                    <label for="emailBasic" class="form-label">Cetegory Icon</label>
                                    <input type="file" name="caticons" id="caticons" class="form-control" onchange="preview2()" accept=".jpeg, .jpg, .png">
                                </div>

                                <div class="col mb-0">
                                    <div style="display: flex; justify-content:center ">
                                        <img id="image2" width="100px" alt="placeholder">
                                    </div>
                                </div>
                            </div>

                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary close" data-bs-dismiss="modal"> Close </button>
                            <button type="submit" class="btn btn-primary"> Save Edits </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function preview1() {
    image1.src=URL.createObjectURL(event.target.files[0]);
    }
    function preview2() {
    image2.src=URL.createObjectURL(event.target.files[0]);
    }
</script>

<?php include 'includes/footer.php'; include '../messages.php'; ?>

<script>
$(document).ready(function() {

    $("#catForm").submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '../controllers/categories.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                if(response == "required"){
                    $('#errMsg').show();
                    $('#errMsg').html("Category Name and icon is required.")
                }
                else if(response == "invalid"){
                    $('#errMsg').show();
                    $('#errMsg').html("Invalid file type! Valid image are .jpg, .jpeg, and .png");
                }
                else if(response == "large"){
                    $('#errMsg').show();
                    $('#errMsg').html("Image size was too large!");
                } else{
                    $('#succMsg').show();
                    $('#succMsg').html("A new category has been added successfully");
                    $('#catForm')[0].reset();
                    $('#myTable').load(location.href + " #myTable");
                }
                
            }
        });
    });

    $(document).on('click', '.trash', function(){
        var catid = $(this).closest('tr').find('.catid').text();

        if(!confirm("Are you sure you want to delete this category?") ){
            return false;
        } else{
            $.ajax({
                type: 'POST',
                url: '../controllers/actions.php',
                data: {
                    'del_btn' : true,
                    catid : catid,
                },
                success: function(response){
                    if(response == "delete"){
                        $('#updateHead').html('Deletion Successful');
                        $('#updateLogo').show();
                        $('#update_body_logo').html('Category has been deleted successfully');
                        $('#myTable').load(location.href + " #myTable");
                    } else{
                        alert(response);
                    }
                }
            });
        }    
    });

    $('#btnClose').on('click', function(){
        $('#updateLogo').fadeOut();
    });

    $(document).on('click', '.edit_btn', function (){
        var catid = $(this).val();
        
        $.ajax({
            type: "GET",
            url: "../controllers/actions.php?catid="+catid,
            success: function(response){
                var res = jQuery.parseJSON(response);
                if (res.status == 422){
                    alert(res.message);
                } else if (res.status == 200){
                    $('#catid').val(res.data.catid);
                    $('#catnamed').val(res.data.name);
                    $("#image2").attr('src', '../assets/img/caticons/'+res.data.image);
                    $('#editModal').modal('show');
                }
            }
        });

    });

    $(document).on('submit', '#catForm1', function(e){
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("update_cat", true);

        $.ajax({
            type: 'POST',
            url: "../controllers/actions.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response){
                if(response == 'Yes' || response == 'success'){
                    $('#succMsgUpdate').show();
                    $('#succMsgUpdate').html('This category has been updated successfully');
                    $('#catForm1')[0].reset();
                    $('#myTable').load(location.href + " #myTable");
                } else if (response == 'invalid'){
                    $('errMsgUpdate').show();
                    $('errMsgUpdate').html('File type not allowed. Please use .jpeg, .png, .jpg');
                } else if (response == 'large'){
                    $('errMsgUpdate').show();
                    $('errMsgUpdate').html('File type too large. Please try again');
                } else{
                    $('errMsgUpdate').show();
                    $('errMsgUpdate').html('Some error occured');
                }
            }
        });

    });

    $(document).on('click', '.close', function(e){
        e.preventDefault();
        $('#succMsg').hide();
        $('#succMsgUpdate').hide();
        $('errMsgUpdate').hide();
        $('#catForm1')[0].reset();
        $('#catForm')[0].reset();

    });

});
</script>

