<?php 
$page_title = '3S | Campaign Status';
include 'connections/config.php';
include 'profile_includes/profile_head.php'; 
?>
<link rel="stylesheet" href="profile_includes/assets/css/status.css">
<link rel="stylesheet" href="profile_includes/assets/css/campaigns.css">

<div class="col-md-9 campaigns">

    <div class="row campaign-info">
        <div class="ctitle">
            <h1> Campaign Status </h1>
        </div>
    </div>

    <div class="row">

        <div class="campaign_status">

            <div class="grid_A">
                
                <div class="table-responsive-lg" style="width: 100%; padding:10px">
                <h4> Campaigns Posted </h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Project Title</th>
                                <th scope="col">Date Posted</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $i = 1;
                            $jsid = $_SESSION['userid'];
                            $sql = "SELECT * FROM campaigns WHERE jsid = $jsid ORDER BY cid ASC";
                            $row = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($row) > 0) {
                                foreach($row as $crow) 
                            {
                        ?>
                            <tr>
                                <th scope="row"> <?php echo $i++; ?> </th>
                                <td><?= $crow['project_title'] ?></td>
                                <td><?php $timestamp = $crow['date_added']; echo date("M d, Y", strtotime($timestamp)); ?></td>
                                <td> <div style="display: flex; justify-content:center; align-items:center;"> <a href="campaign_status_view.php?cid=<?= $crow['cid']?>" class="view" id="view_camp"> <span class="fa-regular fa-eye"></span> View </a> </div> </td>
                            </tr>
                            <?php
                            }
                                }    
                                else {
                                    echo '<td colspan="4" style="background-color:#f6f6f6;"> <div style="display: flex; justify-content:center; align-items:center;"> <span style="color:#a3a6ab;"> No campaigns yet </span></div></td>';
                                } 
                            ?>    
                        </tbody>
                    </table>
                </div>

            </div>

            <?php 
                $donors = mysqli_query($conn, "SELECT * FROM donations WHERE `jsid`='$_SESSION[userid]' ");
                $count = mysqli_num_rows($donors);
            ?>

            <div class="grid_B">
                <div class="grid-b">      
                    <h4> Contributors </h4>
                    <p> Number of Contributors </p>
                    <span id="number"> <?= $count ?> </span>
                </div>

                <div class="grid-b icon">
                    <i class="fa-solid fa-users-line"></i>
                </div>
                
            </div>

            <div class="grid_C" id="con-table">
                <table class="table table-borderless">    
                <h4> Contributor's Details </h4>
                    <thead>
                        <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $jsid = $_SESSION['userid'];
                            $sql1 = "SELECT * FROM donations WHERE jsid = $jsid ";
                            $row1 = mysqli_query($conn, $sql1);
                            if(mysqli_num_rows($row1) > 0) {
                                foreach($row1 as $drow) 
                            {
                        ?>
                        <tr>
                        <td style="display: none;" class="did" id="did"> <?= $drow['did']; ?> </td>
                        <th scope="row"><?= $drow['name'] ?></th>
                        <td><?= $drow['amount'] ?></td>
                        <td class="message-view"> <i class="fa-solid fa-message"></i> <span style="cursor: pointer;"> View </span></td>
                        </tr>
                        <?php
                        }
                            }    
                            else {
                                echo '<td colspan="4" style="background-color:#f6f6f6;"> <div style="display: flex; justify-content:center; align-items:center;"> <span style="color:#a3a6ab;"> No contibutors yet </span></div></td>';
                            } 
                        ?>    
                    </tbody>
                </table>
            </div>

            <div class="grid_C" id="con-mess" style="display: none;">
                <h4> Contributor's Message  <span style="font-size: 1.8rem; margin-left:30%" class="close_message" id="close_message"> <span class="fa-solid fa-circle-xmark"></i> </span> </h4>
                <p> Dear <?= $fetch['first_name'];?>, </p>
                <p id="message"> </p>
                <p> &#8369;<span id="amount"></span>.00 was sent to your GCash account for your campaign, <span id="project_title"></span>. <br> Reference no: <span id="reference_no"></span></p>
                <p style="text-align:right; margin-right: 10px;"> Sent by, <br> <span id="sender_name"></span> </p>
            </div>

        </div>

    </div>

</div>

<script>
    $(document).ready(function(){

        $('.message-view').on('click', function(){
                var did = $(this).closest('tr').find('.did').text();

                $.ajax({
                    type: 'POST',
                    url: 'connections/campaign_status.php',
                    data: {
                        'view_btn': true,
                        'donate_id': did,
                },
                success: function(response){
                    $.each(response, function(key, value){
                        $('#message').html(value['message']);
                        $('#amount').html(value['amount']);
                        $('#reference_no').html(value['ref']);
                        $('#sender_name').html(value['name']);
                        $('#project_title').html(value['pt']);
                    });
                    $('#con-table').hide();
                    $('#con-mess').fadeIn();
                }
            });
        });

        $('.close_message').on('click', function(){
            $('#con-table').fadeIn();
            $('#con-mess').hide();
        });

    });
</script>


<?php include 'profile_includes/profile_footer.php'; ?>