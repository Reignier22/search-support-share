<?php 
include '../controllers/dashboard.php';

session_start();
if (!isset($_SESSION['aid'])){
  header('Location:../auth-login.php');
}


?>
<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>  
    <?php
      require "../controllers/dbController.php";
      if(isset($page_title)){echo "$page_title"; }
    ?>
  </title>

    <meta name="description" content="" />
  
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.12.1/css/pro.min.css">
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />
    <script src="../assets/vendor/js/helpers.js"></script>
    <script src="../assets/js/config.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.4/css/fixedHeader.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">

  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index.html" class="app-brand-link">
              <span class="app-brand-logo demo">
                  <img src="../assets/img/avatars/logo.png" width="28" alt="logo">
              </span>
              <span class="app-brand-text demo text-body px-1" style="font-size: 2.1rem;" > | </span>
              <span class="app-brand-text label text-body" style="font-size: 0.7rem;">Search <br> Support <br> Share </span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item <?php if ($page_title == 'Admin | Dashboard & Analytics'){echo 'active';} ?>">
              <a href="index.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-bar-chart-alt-2"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li> 

            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Actions</span>
            </li>

            <li class="menu-item <?php if ($page_title == 'Admin | Messages'){echo 'active';} ?>">
              <a href="messages.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-chat"></i>
                <div data-i18n="Basic">View Messages</div>
              </a>
            </li>

            <li class="menu-item <?php if ($page_title == 'Admin | Categories'){echo 'active';} ?>">
              <a href="categories.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-accessibility"></i>
                <div data-i18n="Basic">Disability Categories</div>
              </a>
            </li>

            <li class="menu-item <?php if ($page_title == 'Admin | Manage Reports'){echo 'active';} ?>">
              <a href="manage_reports.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-flag"></i>
                <div data-i18n="Basic">Manage Reports</div>
              </a>
            </li>

            <?php  
            
            if($_SESSION['access_level'] == 1){
              ?>
              <li class="menu-item <?php if ($page_title == 'Admin | Manage Users'){echo 'active';} ?>">
                <a href="users.php" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-user"></i>
                  <div data-i18n="Basic">Manage Users</div>
                </a>
              </li>
              <?php
            }
            ?>

            <li class="menu-item  <?php if ($page_title == 'Admin | Slider Content' || $page_title == 'Admin | Logo and Footer' ||   $page_title == 'Admin | Contact Information' ){echo 'active open';} ?> ">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Manage Content</div>
              </a>

              <ul class="menu-sub">
                <li class="menu-item <?php if ($page_title == 'Admin | Slider Content'){echo "active";} ?>">
                  <a href="slider_content.php" class="menu-link">
                    <div data-i18n="Slider Content">Slider Content</div>
                  </a>
                </li>
                <li class="menu-item <?php if ($page_title == 'Admin | Logo and Footer'){echo "active";} ?>">
                  <a href="footer_content.php" class="menu-link">
                    <div data-i18n="Footer Content">Logo and Footer</div>
                  </a>
                </li>

                <li class="menu-item  <?php if ($page_title == 'Admin | Contact Information'){echo "active";} ?>">
                  <a href="contact_info.php" class="menu-link">
                    <div data-i18n="Contact Information">Contact Information</div>
                  </a>
                </li>

              </ul>
            </li>

            <!-- Components -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Dashboard Details</span></li>
            <!-- User interface -->
            <li class="menu-item <?php if ($page_title == 'Admin | Job Seekers' || $page_title == 'Admin | Employers' || $page_title == 'Admin | Campaigns'
              || $page_title == 'Admin | Jobs' || $page_title == 'Admin | Contributors' || $page_title == 'Admin | Reports' 
              || $page_title == 'Admin | Staff' || $page_title == 'Admin | Visitors')
              {echo 'active open';} ?>">
              <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-table"></i>
                <div data-i18n="User interface">Data Tables</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item <?php if ($page_title == 'Admin | Job Seekers'){echo 'active';} ?>">
                  <a href="job_seekers.php" class="menu-link">
                    <div data-i18n="Accordion">Job Seekers</div>
                  </a>
                </li>
                <li class="menu-item <?php if ($page_title == 'Admin | Employers'){echo 'active';} ?>">
                  <a href="employer.php" class="menu-link">
                    <div data-i18n="Alerts">Employers</div>
                  </a>
                </li>
                <li class="menu-item <?php if ($page_title == 'Admin | Campaigns'){echo 'active';} ?>">
                  <a href="campaigns.php" class="menu-link">
                    <div data-i18n="Badges">Campaigns</div>
                  </a>
                </li>
                <li class="menu-item <?php if ($page_title == 'Admin | Jobs'){echo 'active';} ?>">
                  <a href="jobs.php" class="menu-link">
                    <div data-i18n="Buttons">Jobs</div>
                  </a>
                </li>
                <li class="menu-item <?php if ($page_title == 'Admin | Contributors'){echo 'active';} ?>">
                  <a href="contributors.php" class="menu-link">
                    <div data-i18n="Carousel">Contributors</div>
                  </a>
                </li>
                <li class="menu-item <?php if ($page_title == 'Admin | Reports'){echo 'active';} ?>">
                  <a href="reports.php" class="menu-link">
                    <div data-i18n="Collapse">Reports</div>
                  </a>
                </li>
                <li class="menu-item <?php if ($page_title == 'Admin | Staff'){echo 'active';} ?>">
                  <a href="staff.php" class="menu-link">
                    <div data-i18n="Dropdowns">Staff</div>
                  </a>
                </li>
                <li class="menu-item <?php if ($page_title == 'Admin | Visitors'){echo 'active';} ?>">
                  <a href="visitors.php" class="menu-link">
                    <div data-i18n="Footer">Visitors</div>
                  </a>
                </li>
              
              </ul>
            </li>
       
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">

              <?php
                $profile_query = mysqli_query($conn, "SELECT * FROM admin_table WHERE access_level IN('1', '2') AND aid = '$_SESSION[aid]' ");
                $fetch_profile = mysqli_fetch_array($profile_query);
              ?>
                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="../assets/img/profiles/<?= $fetch_profile['pic']; ?>" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="../assets/img/profiles/<?= $fetch_profile['pic']; ?>" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block text-capitalize"> <?= $_SESSION['username']; ?> </span>
                            <small class="text-muted"> <?php if($_SESSION['access_level'] == 1 ) { echo "PDAO Head"; } else { echo "Staff"; } ?> </small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="my_account.php">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">My Account</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" id="logNotif" style="cursor: pointer;">
                        <span class="d-flex align-items-center align-middle">
                          <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                          <span class="flex-grow-1 align-middle">Activity Log</span>
                          <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20"> <?=$notif;?></span>
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" id="logout" style="cursor: pointer;">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <input type="hidden" id="uname" value="<?= $_SESSION['username'];?>">
          <input type="hidden" id="aid_log" value="<?= $_SESSION['aid']; ?>">

          <!-- / Navbar -->

