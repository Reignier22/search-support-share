<?php 
$page_title = "Admin | Manage Reports";
include "includes/header.php";
?>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y"> <!-- Content -->
        <div class="row"> <!-- Row -->
            <div class="col">
                <div class="card">
                    <h5 class="card-header">Manage Reports</h5>
                        <div class="table-responsive ">
                            <table class="table table-hover" id="myTable">
                            <caption class="ms-4"> <?php 
                                if(empty($cat)){
                                    echo "No reports yet.";
                                } else{
                                    echo "Total Reports : " .$rp; 
                                }
                            ?> </caption>
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Reasons</th>
                                        <th scope="col">No. of times Reported</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Date Reported</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                            
                                <tbody class="table-border-bottom-0">
                                <?php 
                                    $i = 1;
                                    $rrows = mysqli_query($conn, 'SELECT reports.rid, reports.cid, reports.jobid, campaigns.project_title AS p_title, jobs.job_title AS j_title, 
                                    reports.reason, reports.no_rp, reports.status, reports.date_reported
                                    FROM reports  
                                    LEFT JOIN campaigns ON campaigns.cid = reports.cid
                                    LEFT JOIN jobs ON jobs.jobid = reports.jobid
                                    ORDER BY rid ASC;'); 
            
                                    if (mysqli_num_rows($rrows) > 0){
                                        foreach($rrows as $rrow) 
                                    {
                                ?>
                                <tr >
                                    <td><?php echo $i++; ?> </td>
                                    <td><?php 
                                    if (empty( $rrow['cid'])){
                                        echo $rrow['j_title'];
                                    } else{
                                        echo $rrow['p_title'];
                                    }
                                    ?> </td>
                                    <td><?php 
                                    if(empty($rrow['cid'])){
                                        echo "Job Post";
                                    } else{
                                        echo "Campaign Post";
                                    }    
                                    ?></td>
                                    <td><?= $rrow['reason'];?></td>
                                    <td><?= $rrow['no_rp'];?></td>
                                    <td>
                                        <?php 
                                            if ($rrow['status'] == 'reported'){
                                                ?>
                                                    <span class="badge bg-label-warning me-1"><?= $rrow['status'];?></span>
                                                <?php
                                            } else if ($rrow['status'] == 'reviewed'){
                                                ?>
                                                    <span class="badge bg-label-primary me-1"><?= $rrow['status'];?></span>
                                                <?php
                                            } else if ($rrow['status'] == 'resolved'){
                                                ?>
                                                    <span class="badge bg-label-success me-1"><?= $rrow['status'];?></span>
                                                <?php
                                            } else{
                                                ?>
                                                    <span class="badge bg-label-danger me-1"><?= $rrow['status'];?></span>
                                                <?php
                                            }
                                        ?>
                                        

                                    </td>

                                    <td><?php $ts=$rrow['date_reported']; echo date("M. j, Y - g:i a ",strtotime($ts));  ?></td>
                                    <td> 
                                       <?php
                                            if($rrow['jobid'] == NULL) {
                                                if($rrow['status'] == 'resolved' || $rrow['status'] == 'terminated'){
                                                    ?>
                                                        <button type="button" class="review_cmp_btn btn btn-icon btn-secondary" disabled>
                                                            <span class="fa-solid fa-eye"></span>
                                                        </button>
                                                    <?php
                                                } else{
                                                    ?>
                                                    <div data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title data-bs-original-title="Review Campaign">
                                                        <button type="button" value="<?= $rrow['rid'];?>" class="review_cmp_btn btn btn-icon btn-info" data-bs-toggle="modal" data-bs-target="#campaignModal">
                                                            <span class="fa-solid fa-eye"></span>
                                                        </button>
                                                    </div> 
                                                <?php
                                                }
                                              
                                            } else{
                                                if($rrow['status'] == 'resolved' || $rrow['status'] == 'terminated'){
                                                    ?>
                                                        <button type="button" class="review_cmp_btn btn btn-icon btn-secondary" disabled>
                                                            <span class="fa-solid fa-eye"></span>
                                                        </button>
                                                    <?php
                                                } else{
                                                ?>
                                                    <div data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-html="true" title data-bs-original-title="Review Job">
                                                        <button type="button" value="<?= $rrow['rid'];?>" class="review_rp_btn btn btn-icon btn-primary" data-bs-toggle="modal" data-bs-target="#jobModal">
                                                            <span class="fa-solid fa-eye"></span>
                                                        </button>
                                                    </div>   
                                                <?php
                                                }
                                            }
                                       ?>

                                       
                                    </td>
                                </tr>
                                <?php 
                                        }
                                    } else{
                                        ?>
                                            <td colspan="8"> <div style="display: flex; justify-content:center; align-items:center"> <span> No Reports found. </span> </div> </td>
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


<!-- Campaign Modal -->

<div class="col-lg-4 col-md-6">
    <div class="mt-3">               
        <div class="modal fade" id="campaignModal" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <strong><h5 class="modal-title" id="campaignTitle"></h5></strong> 
                        <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Reason of report : <span class="badge bg-label-danger"> <strong id="reason"></strong></p> </span> 
                        <div style="display: grid; width:100%; grid-template-columns:40% 60%">
                            <div> <!-- COLUMN 1 -->
                                <strong style="padding-bottom: 20px;"> Project Banner </strong> <br>
                                <div id="carouselExample-cf" class="carousel carousel-dark slide carousel-fade" data-bs-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-bs-target="#carouselExample-cf" data-bs-slide-to="0" class="active" aria-current="true"></li>
                                        <li data-bs-target="#carouselExample-cf" data-bs-slide-to="1" class=""></li>
                                        <li data-bs-target="#carouselExample-cf" data-bs-slide-to="2" class=""></li>
                                    </ol>
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img class="d-block" style="width: 500px; height:270px" id="banner1" >
                                        </div>

                                        <div class="carousel-item">
                                            <img class="d-block" style="width: 500px; height:270px" id="banner2" >
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block" style="width: 500px; height:270px" id="banner3" >
                                        </div>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExample-cf" role="button" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" style="margin-right: 25px;" href="#carouselExample-cf" role="button" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </a>
                                </div>
                            </div> 

                            <div style="display: grid; grid-template-columns:70% 30%"> <!-- COLUMN 2 -->
                                <div>
                                <strong> Project Description </strong> <br>
                                <p id="description"></p>
                                <p>Project Goal : <strong id="goal"></strong> </p>
                                <p>Date Posted : <strong id="posted"></strong> </p>
                                <p>Campaign End : <strong id="end"></strong> </p>
                                </div>
                                <div>
                                    <strong> Qr Code </strong> <br>
                                    <img id="qr_code" alt="qr" style="width: 200px; height:300px">
                                </div>
                            </div>
                        </div> <br>

                    <form action="../controllers/actions.php">
                        <input type="hidden" name="rep_id" id="rep_id">
                        <input type="hidden" name="cidter" id="cidter">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="resolve btn btn-primary">Resolve</button>
                        <button type="button" class="terminate btn btn-danger">Terminate</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Job Modal -->

<div class="col-lg-4 col-md-6">
    <div class="mt-3">               
        <div class="modal fade" id="jobModal" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="job_title"></h5>
                        <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <p>Reason of report : <span class="badge bg-label-danger"> <strong id="reason1"></strong></p> </span> 
                        <div style="display: grid; width:100%; grid-template-columns:30% 70%">
                            <div>
                                <strong>Disability Category</strong> <span id="category"></span>
                                <br><strong>Employer</strong> <span id="employer"></span>
                                <br><strong>Employees Needed</strong> <span id="employees"></span>
                                <br><strong>Duration</strong> until <span id="duration"></span>
                                <br><strong>Salary</strong> <span id="salary"></span>
                                <br><strong>Preferred Gender of Applicant</strong> <span id="gender"></span>
                                <br><strong>Address</strong> <span id="address"></span>
                            </div>

                            <div>
                                <strong>Job Description</strong> <br> <span id="job_desc"></span>
                                <br><strong>Qualification</strong><br><span id="qualification"></span>
                            </div>
                        </div>
                    <form action="../controllers/actions.php">
                        <input type="hidden" name="rpt_id" id="rpt_id">
                        <input type="hidden" name="jobidter" id="jobidter">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="resolve1 btn btn-primary">Resolve</button>
                        <button type="button" class="terminate1 btn btn-danger">Terminate</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<script>
$(document).ready(function(){
    $(document).on('click', '.review_cmp_btn', function (){
        var rid = $(this).val();
        $.ajax({
            type: "GET",
            url: "../controllers/reports.php?rid="+rid,
            success: function(response){
                var res = jQuery.parseJSON(response);
                if (res.status == 422){
                    alert(res.message);
                } else if (res.status == 200){
                    $('#cidter').val(res.data.cid);
                    $('#rep_id').val(res.data.rid);
                    $('#campaignTitle').text(res.data.pt);
                    $('#reason').text(res.data.reason);
                    $('#description').text(res.data.pd);
                    $('#goal').text(res.data.pg);
                    $('#posted').text(res.data.da);
                    $('#end').text(res.data.ed);
                    $("#banner1").attr('src', '../../profile_includes/assets/project-banner/'+res.data.img);
                    $("#banner2").attr('src', '../../profile_includes/assets/project-banner/'+res.data.img2);
                    $("#banner3").attr('src', '../../profile_includes/assets/project-banner/'+res.data.img3);
                    $("#qr_code").attr('src', '../../profile_includes/assets/qr_code/'+res.data.qr);
                }
            }
        });

    });

    $(document).on('click', '.review_rp_btn', function (){
        var report_id = $(this).val();
        $.ajax({
            type: "GET",
            url: "../controllers/reports.php?report_id="+report_id,
            success: function(response){
                var res = jQuery.parseJSON(response);
                if (res.status == 422){
                    alert(res.message);
                } else if (res.status == 200){
                    $('#rpt_id').val(res.data.rid);
                    $('#jobidter').val(res.data.jobid);
                    $('#job_title').text(res.data.jt);
                    $('#reason1').text(res.data.reason);
                    $('#category').text(res.data.name);
                    $('#employer').text(res.data.cm);
                    $('#employees').text(res.data.en);
                    $('#duration').text(res.data.d);
                    $('#salary').text(res.data.s);
                    $('#qualification').html(nl2br(res.data.qualification));
                    $('#job_desc').html(nl2br(res.data.job_desc));
                    $('#gender').text(res.data.ps);
                    $('#address').text(res.data.a);
                }
            }
        });

        function nl2br(str, is_xhtml) {
            var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br>':'<br>';
            return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag   + '$2');
        }

    });

    $(document).on('click', '.close', function (){
        $('#myTable').load(location.href + " #myTable");
    });

    $(document).on('click', '.resolve', function (){
        var repId = $('#rep_id').val();
        $.ajax({
            method: "POST",
            url: "../controllers/actions.php",
            data: {
                'resolve_btn': true,
                'rep_id': repId
            },
            success: function(response){
                if(response == 'updatedrep'){
                    alert("This report has been resolved successfully");
                } else{
                    alert("Some error occured");
                }
            }
        });
    });

    $(document).on('click', '.terminate', function (){
        var repid = $('#rep_id').val();
        var cidter = $('#cidter').val();
        $.ajax({
            method: "POST",
            url: "../controllers/actions.php",
            data: {
                'terminate_btn': true,
                'repid': repid,
                'cidter': cidter
            },
            success: function(response){
                if(response == 'updatedrep'){
                    alert("This report has been terminated successfully");
                } else{
                    alert("Some error occured");
                }
            }
        });
    });

    $(document).on('click', '.resolve1', function (){
        var rptid = $('#rpt_id').val();
        $.ajax({
            method: "POST",
            url: "../controllers/actions.php",
            data: {
                'resolve1_btn': true,
                'rptid': rptid
            },
            success: function(response){
                if(response == 'updatedrep1'){
                    alert("This report has been resolved successfully");
                } else{
                    alert("Some error occured");
                }
            }
        });
    });

    $(document).on('click', '.terminate1', function (){
        var rptid1 = $('#rpt_id').val();
        var jobidter = $('#jobidter').val();
        $.ajax({
            method: "POST",
            url: "../controllers/actions.php",
            data: {
                'terminate1_btn': true,
                'rptid1': rptid1,
                'jobidter': jobidter
            },
            success: function(response){
                if(response == 'updatedrep'){
                    alert("This report has been terminated successfully");
                } else{
                    alert("Some error occured");
                }
            }
        });
    });



});

</script>