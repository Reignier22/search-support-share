<?php 
$page_title = "Admin | Messages";
include "includes/header.php";
?>

<div class="content-wrapper"> <!-- Content-wrapper -->
    <div class="container-xxl flex-grow-1 container-p-y"> <!-- Content -->
        <div class="row"> <!-- Row -->
            <div class="col">
                <div class="card">
                    <h5 class="card-header">Messages </h5>
                        <div class="table-responsive ">
                        <table class="table table-hover" id="myTable" >
                            <caption class="ms-4"> <?php 
                                if(empty($con)){
                                    echo "You have no unread messages";
                                } else{
                                    echo "You have ".$con. " unread messages";
                                }
                            ?> </caption>
                                <thead>
                                    <tr>
                                        <th scope="col">Message ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Message</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Sent</th>
                                    </tr>
                                </thead>
                            
                                <tbody class="table-border-bottom-0">
                                <?php 
                                    $messages = mysqli_query($conn, "SELECT * FROM contact ORDER BY con_id DESC");
                                    
                                    if (mysqli_num_rows($messages) > 0){
                                    foreach($messages as $mrow) 
                                    {
                                ?>
                                <tr class="view_msg <?php if($mrow['status'] == 1){ echo 'table-active';} else { echo ""; } ?> ">
                                    <td class="conid"><?= $mrow['con_id'] ?></td>
                                    <td><?= $mrow['full_name'] ?> </td>
                                    <td width="40%"> <span style=" text-overflow: ellipsis; overflow: hidden; -webkit-line-clamp: 1;  display: -webkit-box;  -webkit-box-orient: vertical;"> <?= $mrow['con_mess'] ?> </span> </td>
                                    <td><?= $mrow['con_email'] ?></td>
                                    <td><?php 
                                        date_default_timezone_set('Asia/Manila');
                                        $todays_date = date("y-m-d h:i:sa");
                                        $now = new DateTime($todays_date);
                      
                                        $posted = new DateTime(date($mrow['date_sent']));
                                    
                                        $diff = $posted-> diff($now);
                      
                                        if($diff->y > 0){
                                            echo $diff->y .' year'. ($diff->y > 1?"s ":'') . " ago" ;
                                        }
                                        else if($diff->m > 0){
                                            echo $diff->m . ' month'. ($diff->m > 1?"s ":'') . " ago";
                                        }
                      
                                        else if($diff->d > 0){
                                            echo $diff->d .' day'. ($diff->d > 1?"s ":'') . " ago" ;
                                        }
                      
                                        else if($diff->h > 0){
                                            echo $diff->h .' hour'.($diff->h > 1 ? "s ":'') . " ago";
                                        }
                                        else if($diff->i > 0){
                                            echo $diff->i .' min'. ($diff->i > 1?"s ":'') . " ago";
                                        }
                                        else if($diff->s > 0){
                                            echo $diff->s .' sec'. ($diff->s > 1?"s ":'') . " ago";
                                        }
                                    ?> </td>
                                </tr>
                                <?php 
                                        }
                                    } else{
                                        ?>
                                            <td colspan="5"> <div style="display: flex; justify-content:center; align-items:center"> <span> No Messages found. </span> </div> </td>
                                        <?php
                                    }
                                ?>
                                </tbody>
                               
                        </table>

                        <!-- VIEW MESSAGE -->

                        <div class="card-body message" id="message" style="display: none;">
                            <div style="display: flex; justify-content:space-between" >
                                <h5> <strong>From:</strong> <span id="sender_name">Reignier Enabore</span> </h5>
                                <small id="date_sent" >October 11, 2022</small>
                            </div>
                            <p id="message_body"> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatum reprehenderit rem nobis eos dignissimos mollitia, maxime, necessitatibus libero natus aperiam earum odit! Iste, totam exercitationem esse aspernatur tempore omnis ex? </p>
                            <div style="display: flex; justify-content:space-between" >
                                <p>Contact this person through this email: <strong id="email"> reignierdy@gmail.com </strong> </p>
                                <button type="button" class="btn btn-outline-secondary" id="back_btn">
                                    <span class="tf-icons bx bx-arrow-back"></span>&nbsp; Back
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div> <!-- Row -->
    </div>  <!-- Content -->
</div> <!-- Content-wrapper -->

<?php include 'includes/footer.php'; ?>

<script>
    $('.view_msg').on('click', function(e){
        e.preventDefault();
        var conid = $(this).closest('tr').find('.conid').text();

        $.ajax({
                type: 'POST',
                url: '../controllers/actions.php',
                data: {
                    'view_btn': true,
                    'conid': conid,
            },
            success: function(response){
                $.each(response, function(key, value){
                    var date = new Date(value['date_sent']).toDateString();
                    $('#sender_name').html(value['full_name']);
                    $('#date_sent').html(date);
                    $('#message_body').html(value['con_mess']);
                    $('#email').html(value['con_email']);
                });
                $('#myTable').hide();
                $('#message').fadeIn();
            }
        });

    $('#back_btn').on('click', function(e){
        $('#myTable').fadeIn();
        $('#message').hide();
        window.location.reload();
    });

    });
</script>