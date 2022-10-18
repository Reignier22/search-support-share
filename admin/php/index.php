<?php 
$page_title = "Admin | Dashboard & Analytics";
include "includes/header.php";
?>

<!-- Content wrapper -->
  <div class="content-wrapper">
      <!-- Content -->
      <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
          <div class="col-lg-8 mb-4 order-0">
            <div class="card" style="background-color: #77A6F7;">
              <div class="d-flex align-items-end row">
                <div class="col-sm-8">
                  <div class="card-body ">
                  
                  <h5 class="card-title text-capitalize text-white">
                    <?php 
                        date_default_timezone_set('Asia/Manila');
                        $hour = date('H', time());
                        $text = $_SESSION['username'] . "! ";
                          if( $hour < 12) {
                            echo "Good Morning, " . $text ;
                          }
                          else if($hour >= 12 && $hour <= 17) {
                            echo "Good Afternoon, " . $text;
                          }
                          else if($hour > 17 && $hour <= 24) {
                            echo "Good Evening, " . $text;
                          }
                          else {
                            echo "Why aren't you asleep?  Are you programming?";
                          }
                      ?>
                      🎉</h5>
                      <p class="text-white text-center relative">
                        <span style="font-size: .7rem;" class="absolute pb-1 bx bxs-quote-alt-left"></span> <span id="quote"></span>  <span  style="font-size: .7rem;" class="absolute pb-1 bx bxs-quote-alt-right"></span> 
                      </p>

                    <p class="text-white" style="display: flex; justify-content: right;">-&nbsp;<span id="author"></span></p> 
                  </div>
                </div>
                <div class="col-sm-4 text-center text-sm-left">
                  <div class="card-body pb-0 px-0 px-md-4">
                    <img
                      src="../assets/img/illustrations/man-with-laptop-light.png"
                      height="140"
                      alt="View Badge User"
                      data-app-dark-img="illustrations/man-with-laptop-dark.png"
                      data-app-light-img="illustrations/man-with-laptop-light.png"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-lg-4 col-md-4 order-1">
            <div class="row">

              <div class="col-lg-6 col-md-12 col-6 mb-4">
                <div class="card">
                  <div class="card-body" >
                    <div class="card-title d-flex align-items-start justify-content-between">
                      <div class="avatar flex-shrink-0">
                        <img src="../assets/img/icons/unicons/js.png" alt="chart success"/>
                      </div>
                      <div class="dropdown">
                        <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                          <a class="dropdown-item" href="job_seekers.php">View Details</a>
                        </div>
                      </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Job Seekers</span>
                    <h3 class="card-title mb-2"><?= $js ?></h3>
                    <input type="hidden" id="jsid" value="<?= $js ?>" >
                  </div>
                </div>
              </div>

              <div class="col-lg-6 col-md-12 col-6 mb-4">
                <div class="card">
                  <div class="card-body" >
                    <div class="card-title d-flex align-items-start justify-content-between">
                      <div class="avatar flex-shrink-0">
                        <img
                          src="../assets/img/icons/unicons/emp.png"
                          alt="chart success"
                          class="rounded"
                        />
                      </div>
                      <div class="dropdown">
                        <button
                          class="btn p-0"
                          type="button"
                          id="cardOpt3"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false"
                        >
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                          <a class="dropdown-item" href="employer.php">View Details</a>
                        </div>
                      </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Employers</span>
                    <h3 class="card-title mb-2"><?= $emp; ?></h3>
                    <input type="hidden" id="empid" value="<?= $emp; ?>">
                  </div>
                </div>
              </div>

            </div>
          </div>

          <!-- Total Revenue -->
          <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
            <div class="card">
              <div class="row row-bordered g-0">
                <div class="col-md-12 ">
                  <h5 class="card-header m-0 me-2 pb-3">Data Analytics</h5>
                  <div id="totalRevenueChart" class="px-2"></div>
                </div>   
              </div>
            </div>
          </div>
          <!--/ Total Revenue -->
          
          <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
            <div class="row">
              <div class="col-6 mb-4">
                <div class="card">
                  <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                      <div class="avatar flex-shrink-0">
                        <img src="../assets/img/icons/unicons/cmp.png" alt="Credit Card" class="rounded" />
                      </div>
                      <div class="dropdown">
                        <button
                          class="btn p-0"
                          type="button"
                          id="cardOpt4"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false"
                        >
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="cardOpt1">
                          <a class="dropdown-item" href="campaigns.php">View Details</a>
                        </div>
                      </div>
                    </div>
                    <span class="d-block mb-1">Campaigns</span>
                    <h3 class="card-title text-nowrap mb-2"><?= $cmp; ?></h3>
                    <input type="hidden" id="cmpid" value="<?= $cmp; ?>">
                  </div>
                </div>
              </div>

              <div class="col-6 mb-4">
                <div class="card">
                  <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                      <div class="avatar flex-shrink-0">
                        <img src="../assets/img/icons/unicons/jb.png" alt="Credit Card" class="rounded" />
                      </div>
                      <div class="dropdown">
                        <button
                          class="btn p-0"
                          type="button"
                          id="cardOpt1"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false"
                        >
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="cardOpt1">
                          <a class="dropdown-item" href="jobs.php">View Details</a>
                        </div>
                      </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Jobs</span>
                    <h3 class="card-title mb-2"><?= $jb; ?></h3>
                    <input type="hidden" id="jbid" value="<?= $jb; ?>">
                  </div>
                </div>
              </div>

              <div class="col-6 mb-4">
                <div class="card">
                  <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                      <div class="avatar flex-shrink-0">
                        <img src="../assets/img/icons/unicons/cn.png" alt="Credit Card" class="rounded" />
                      </div>
                      <div class="dropdown">
                        <button
                          class="btn p-0"
                          type="button"
                          id="cardOpt1"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false"
                        >
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="cardOpt1">
                          <a class="dropdown-item" href="contributors.php">View Details</a>
                        </div>
                      </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Contributors</span>
                    <h3 class="card-title mb-2"><?= $cn; ?></h3>
                    <input type="hidden" id="cnid" value="<?= $cn; ?>">
                  </div>
                </div>
              </div>

              <div class="col-6 mb-4">
                <div class="card">
                  <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                      <div class="avatar flex-shrink-0">
                        <img src="../assets/img/icons/unicons/rp.png" alt="Credit Card" class="rounded" />
                      </div>
                      <div class="dropdown">
                        <button
                          class="btn p-0"
                          type="button"
                          id="cardOpt1"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false"
                        >
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="cardOpt1">
                          <a class="dropdown-item" href="reports.php">View Details</a>
                        </div>
                      </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Reports</span>
                    <h3 class="card-title mb-2"><?= $rp; ?></h3>
                    <input type="hidden" id="rpid" value="<?= $rp; ?>">
                  </div>
                </div>
              </div>
              <!-- </div>
<div class="row"> -->
 
            </div>
          </div>
        </div>
        <div class="row">
 

          <!-- Expense Overview -->
          <div class="col-md-6 col-lg-8 order-1 mb-4">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3" role="tablist">
                      <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-js" aria-controls="navs-pills-top-js" aria-selected="false">
                        <i class="fad fa-users text-xs mr-2"></i>
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-emp" aria-controls="navs-pills-top-emp" aria-selected="false">
                        <i class="fad fa-user-tie text-xs mr-2"></i>
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-cmp" aria-controls="navs-pills-top-cmp" aria-selected="true">
                        <i class="fad fa-project-diagram text-xs mr-2"></i>
                        </button>
                      </li>
                         <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-jb" aria-controls="navs-pills-top-jb" aria-selected="false">
                        <i class="fad fa-briefcase text-xs mr-2"></i>
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-cn" aria-controls="navs-pills-top-cn" aria-selected="false">
                        <i class="fad fa-hands-usd text-xs mr-2"></i>
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-rp" aria-controls="navs-pills-top-rp" aria-selected="true">
                        <i class="fad fa-flag-alt text-xs mr-2"></i>
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-st" aria-controls="navs-pills-top-st" aria-selected="false">
                        <i class="fad fa-users-cog text-xs mr-2"></i>
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-vs" aria-controls="navs-pills-top-vs" aria-selected="true">
                        <i class="fad fa-user-chart text-xs mr-2"></i>
                        </button>
                      </li>
                    </ul>

                <div class="tab-content">

                      <div class="tab-pane fade active show pt-2" id="navs-pills-top-js" role="tabpanel">
                        <p>
                          <?php 
                            if(empty($js)){
                                ?>
                                    There are currently no registered job seekers or project initiators.
                                <?php
                            } else{
                                ?>
                                    There are currently <?=$js;?> registered job seekers / project initiators. </p>
                                <?php
                            }
                          ?>
                        </p>
                       
                      </div>

                      <div class="tab-pane fade" id="navs-pills-top-emp" role="tabpanel">
                        <p>
                           <?php 
                            if(empty($emp)){
                                echo "There are currently no registered employers";
                            }
                            else if ($emp > $emc){
                                echo "Among the ".$emp." registered employers, ".$emc. " of them already shared job vacancy.";
                            } else{
                                echo "All The Registered Employers Have Already Shared Jobs With Our Fellow Differently-Abled Persons.";
                            }
                            ?> 
                        </p>
                      </div>

                      <div class="tab-pane fade" id="navs-pills-top-cmp" role="tabpanel">
                        <p>
                        <?php 
                          if(empty($cmp)){
                              echo "No one posted a campaign yet.";                       
                          } else{
                              echo $cmp. " campaigns has been posted and ".$cn. " people already contributed to the projects."; 
                          }
                          
                          ?>
                        </p>
                      </div>

                      <div class="tab-pane fade" id="navs-pills-top-jb" role="tabpanel">
                        <p>
                        <?php 
                            if(empty($jb)){
                                echo "No one from the employers posted a job yet";
                            } else{
                                echo "There are currently ".$jb. " jobs posted and among the " .$app. " applicants, " .$ap. " of them received a positive feedback from employers.";
                            }
                        ?>
                        </p>
                      </div>

                      <div class="tab-pane fade" id="navs-pills-top-cn" role="tabpanel">
                        <p>
                          <?php 
                              if (empty($cn)){
                                  echo "There are no contributors yet";
                              } else{
                                  echo "A total of &#8369; ". number_format($sum,2)." has been generated from the ".$cmp. " campaigns posted.";
                              }
                          ?>
                        </p>
                      </div>

                      <div class="tab-pane fade" id="navs-pills-top-rp" role="tabpanel">
                        <p>
                        <?php 
                            if(empty($rp)){
                                echo "There are currently no reports";
                            } else{
                                echo "Admin, you need to take action to the ".$rp. " report made by the users.";
                            }
                        ?>
                        </p>
                      </div>

                      <div class="tab-pane fade" id="navs-pills-top-st" role="tabpanel">
                        <p>
                        <?php 
                            if(empty($st)){
                                echo "There are no staff/s added by the super user";
                            } else{
                                echo "The active staff are " .$st. ".";
                            }
                        ?>
                        </p>
                      </div>

                      <div class="tab-pane fade" id="navs-pills-top-vs" role="tabpanel">
                        <p>
                        <?php 
                          if(empty($vs)){
                              echo "There are no site visitors yet";
                          } else{
                              echo "The 3S Web Application already has " .$vs. " unique visitors.";
                          }
                        ?>
                        </p>
                      </div>
                      
              </div>
            </div>
          </div>
          
          <!--/ Expense Overview -->

          <div class="col-md-6 col-lg-4 order-1 mb-4">
            <div class="row">
              
              <div class="col-6 mb-4">
                <div class="card">
                  <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                      <div class="avatar flex-shrink-0">
                        <img src="../assets/img/icons/unicons/st.png" alt="Credit Card" class="rounded" />
                      </div>
                      <div class="dropdown">
                        <button
                          class="btn p-0"
                          type="button"
                          id="cardOpt1"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false"
                        >
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="cardOpt1">
                          <a class="dropdown-item" href="staff.php">View Details</a>
                        </div>
                      </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Staff</span>
                    <h3 class="card-title mb-2"><?= $st; ?></h3>
                    <input type="hidden" id="stid" value="<?= $st; ?>">
                  </div>
                </div>
              </div>

              <div class="col-6 mb-4">
                <div class="card">
                  <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                      <div class="avatar flex-shrink-0">
                        <img src="../assets/img/icons/unicons/vs.png" alt="Credit Card" class="rounded" />
                      </div>
                      <div class="dropdown">
                        <button
                          class="btn p-0"
                          type="button"
                          id="cardOpt1"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false"
                        >
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="cardOpt1">
                          <a class="dropdown-item" href="visitors.php">View Details</a>
                        </div>
                      </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Visitors</span>
                    <h3 class="card-title mb-2"><?= $vs; ?></h3>
                    <input type="hidden" id="vsid" value="<?= $vs; ?>">
                  </div>
                </div>
              </div>
            </div>
          </div>
  </div>
</div>
<!-- / Content -->

<script>
  const quote = document.querySelector('#quote');
  const author = document.querySelector('#author');

  window.addEventListener("load", getQuote);

  function getQuote(){
    fetch("http://api.quotable.io/random")
    .then(res => res.json())
    .then(data => {
      quote.innerHTML = data.content;
      author.innerHTML = data.author;
    })
  }
</script>

<?php include 'includes/footer.php'; ?>