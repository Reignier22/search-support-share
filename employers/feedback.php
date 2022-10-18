<?php  
$page_title = "Employer | Feedback Page";
include("include/header.php"); 
?>

<link rel="stylesheet" href="assets/css/applicants.css?v=1">
<main style="min-height: 100vh;">
        <?php include("include/dashboard.php") ?>
         
        <br>
        <div class="jobs">
        <h2>Feedback <small> List of applicants that has approved, disapproved and short-listed status  </small></h2>
            <div class="table-responsive">
            <table width:100%>
                <thead>
                    <tr>
                        <td> <div> </div> </td>
                        <td> <div> Applicant Name </div>  </td>
                        <td> <div> Job Title </div>  </td>
                        <td> <div> Date Applied </div> </td>
                        <td> <div> Status </div> </td>
                        <td> <div> Remarks </div> </td>
                        <td> <div> Actions </div> </td>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $empid = $_SESSION['empid'];
                    $apply = "SELECT apply.appid, job_seekers.first_name AS fname, job_seekers.middle_name as mname, job_seekers.last_name as lname, jobs.job_title AS job_title, 
                    jobs.empid as 'empid', apply.jobid, apply.jsid, apply.resume, apply.status, apply.date_applied, apply.remarks
                    FROM apply 
                    INNER JOIN jobs ON jobs.jobid = apply.jobid
                    INNER JOIN job_seekers ON job_seekers.jsid = apply.jsid WHERE status IN('approved', 'disapproved', 'short-listed') AND jobs.empid = $empid ORDER BY appid DESC";  
                    $rs = mysqli_query($conn, $apply);

                    if(mysqli_num_rows($rs) > 0) {
                        foreach($rs as $approw) 
                    {
                    
                ?>
                    <tr>    
                        <td class="jobid" style="display: none; "><?php $approw['appid']; ?> </td>
                        <td><div> <span class="indicator"></span></div></td>
                        <td style="text-transform:capitalize" ><div> <?php echo $approw['fname']." ". $approw['mname']. " " . $approw ['lname'] ?> </div></td>
                        <td><div> <?php echo $approw['job_title'] ?>  </div> </td>
                        <td><div> 
                            <?php 
                            $date = $approw['date_applied'];
                            echo date('F d, Y', strtotime($date));
                            ?> 
                        </div> </td>
                        <td> <div> <span class="<?= $approw['status']; ?>"> <?php echo $approw['status']; ?> </span></div> </td>
                        <td> <div> 
                            <?php 
                            
                            if(empty($approw['remarks'])){
                                echo "No remarks yet";
                            }else{
                                echo $approw['remarks'];
                            }
                            ?>
                        
                        </div> </td>
                        <td> <div> <button class="viewApp" ><a href="give_feedback.php?appid=<?=$approw['appid']?>" id="lods">View Applicant <span class="fa-solid fa-users-viewfinder eyes" style="display: none;"></span> </a></button></div></td>
                    </tr>
                <?php
                    }
                }    
                else {
                    echo "
                    <tr>
                    <td colspan='7'> <div style='justify-content:center; align-items:center; background-color: #ececec'> <span style='color: gray; font-size:large'; font-weight:700;> There are no applicants yet </span></div> </td>
                    </tr>";
                } ?>    
                </tbody>
            </table>
            </div>
        </div>

    </main>      

<?php include("include/footer.php") ?>