         <!-- Footer -->
         <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  © 3S
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                   All right reserved.
                </div>
          
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->



    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/js/dashboards-analytics.js"></script>

    <!-- Ajax -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>

    <script>
        $(document).ready(function() {
        var table = $('#example').DataTable( {
            responsive: true,
            paging: false
        });
        new $.fn.dataTable.FixedHeader( table );
        });
    </script>

<script>
    $('#logout').click(function(e){
        e.preventDefault();
        if(!confirm("Are you sure you want to logout?")){
          return false;
        } else{
          var uname = $('#uname').val();
          var aid_log = $("#aid_log").val();
          
          $.ajax({
            method: 'POST',
            url: '../controllers/actions.php',
            data: {
              'log_btn': true,
              'uname': uname,
              'aid_log': aid_log
            }, 
            success: function(res){
              window.location.href = "logout.php";
            }
          });
        }
    });
    $('#logNotif').click(function(e){
        e.preventDefault();
        $.ajax({
          method: 'POST',
          url: '../controllers/actions.php',
          data: {
            'notif_btn': true
          },
          success: function(res){
            window.location.href = "activity-log.php";
          }
        });
    });
</script>



  </body>
</html>
