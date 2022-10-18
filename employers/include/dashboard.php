<div class="page-header">
            <div>
                <h1>Employer's Dashboard</h1>
                <small>Monitor key metrics. Check Reporting and review insights</small>
            </div>
            <!--<div class="header-actions">
                <button>
                    <span class="las la-file-export"></span>
                    Export
                </button>
                <button>
                    <span class="las la-tools"></span>
                    Settings
                </button>
            </div> -->
        </div>

        <?php 
        $query = mysqli_query($conn, "SELECT * FROM `jobs` WHERE `empid`='$_SESSION[empid]'");
        $count = mysqli_num_rows($query);
        ?>
        <div class="cards">
            <div class="card-single blue">
                <div class="card-flex">
                    <div class="card-info">
                        <div class="card-head">
                            <span>Jobs</span>
                            <small>Number of jobs Offered</small>
                        </div>
                        <h2><?php if(empty($count)) {
                            echo '0';
                            } else {
                                echo  $count; 
                            }?> </h2>
                    </div>
                    <div class="card-chart danger">
                        <span class="las la-suitcase"></span>
                    </div>
                </div>
            </div>

            <?php 
             $empid = $_SESSION['empid'];
             $apply = mysqli_query($conn, "SELECT  jobs.empid as 'empid', apply.jsid
             FROM apply 
             INNER JOIN jobs ON jobs.jobid = apply.jobid
             INNER JOIN job_seekers ON job_seekers.jsid = apply.jsid WHERE status = 'pending' AND empid = $empid " ); 
             $count_app = mysqli_num_rows($apply);
            ?>

            <div class="card-single green">
                <div class="card-flex">
                    <div class="card-info">
                        <div class="card-head">
                            <span> Pending Applicants</span>
                            <small>Number of Applicants</small>
                        </div>
                        <h2><?php if(empty($count_app)) {
                            echo '0';
                            } else {
                                echo  $count_app; 
                            }?> </h2>
                    </div>
                    <div class="card-chart">
                        <span class="las la-users"></span>
                    </div>
                </div>
            </div>

            <?php 
                $empid = $_SESSION['empid'];
                $feedback = mysqli_query($conn,"SELECT apply.status, apply.jobid, jobs.empid as empid 
                FROM apply 
                INNER JOIN jobs ON jobs.jobid = apply.jobid
                WHERE status IN('approved', 'disapproved', 'short listed') AND jobs.empid  =  $empid") ;
                $count_fb = mysqli_num_rows($feedback);

            ?>

            <div class="card-single orange">
                <div class="card-flex">
                    <div class="card-info">
                        <div class="card-head">
                            <span>Feedback</span>
                            <small>Number of feedback provided</small>
                        </div>
                        <h2><?php if(empty($count_fb)) {
                            echo '0';
                            } else {
                                echo  $count_fb; 
                            }?> </h2>
                    </div>
                    <div class="card-chart">
                        <span class="las la-comment"></span>
                    </div>
                </div>
            </div>
        </div>

