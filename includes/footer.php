<style>
    #logo-footers{
        display: grid;
       grid-template-columns: 80px 100px;
       line-height: 2.3rem;
       padding: 10px;
    }
    #logo-footers p{
        font-size: 2.3rem;
        text-transform: uppercase;
        margin-left: 5px;
    }
    #logo-footers img{
        height: 80px;
        width: 80px;
    }
</style>

<a href="#" class="scrollup"><i class="fa fa-arrow-up" aria-hidden="true"></i></a> 

<footer>
<div class="container" >
    <div class="row">

    <div class="col-md-3 col-sm-3" id="logo-footers">
        <?php 
            $fetch_query1 = mysqli_query($conn, "SELECT * FROM content_manage");
            $fetch_content = mysqli_fetch_array($fetch_query1);  

            $fetch_query1 = mysqli_query($conn, "SELECT * FROM url_tbl WHERE uid = '1' ");
            $fetch_fb = mysqli_fetch_array($fetch_query1); 

            $fetch_query2 = mysqli_query($conn, "SELECT * FROM url_tbl WHERE uid = '2' ");
            $fetch_tw = mysqli_fetch_array($fetch_query2); 

            $fetch_query3 = mysqli_query($conn, "SELECT * FROM url_tbl WHERE uid = '3' ");
            $fetch_in = mysqli_fetch_array($fetch_query3); 

            $fetch_query4 = mysqli_query($conn, "SELECT * FROM url_tbl WHERE uid = '4' ");
            $fetch_tk = mysqli_fetch_array($fetch_query4); 

            $fetch_query5 = mysqli_query($conn, "SELECT * FROM url_tbl WHERE uid = '5' ");
            $fetch_yt = mysqli_fetch_array($fetch_query5); 
        ?>
        <div>
            <img src="assets/home-plugins/img/<?= $fetch_content['logo'];?>" alt="logo">
        </div>

        <div>
            <p> <span style="color:#77A6F7 !important"> S</span>earch <br> <span style="color:#77A6F7 !important">S</span>upport <br> <span style="color:#77A6F7 !important">S</span>hare </span> </p>
        </div>
    </div>

      <div class="col-md-3 col-sm-3">
        <div class="widget">
          <h5 class="widgetheading">Contact Us</h5>
          <p>
            <i class="fa-solid fa-mobile-retro"></i> &nbsp; <?= $fetch_content['cnumber']; ?> <br>
            <i class="fa-solid fa-phone"></i> &nbsp; <?= $fetch_content['tnumber']; ?> <br>
            <i class="fa-solid fa-envelope"></i> &nbsp; <?= $fetch_content['email_add']; ?>
          </p>
        </div>
      </div>

      <div class="col-md-3 col-sm-3">
        <div class="widget">
          <h5 class="widgetheading">Quick Links</h5>
          <ul class="link-list">
            <li><a href="index.php">Home</a></li>
            <li><a href="hiring_now.php">Hiring Now</a></li>
            <li><a href="campaigns.php">Campaigns</a></li>
          </ul>
        </div>
      </div>

      <div class="col-md-3 col-sm-3">
        <div class="widget">
        <h5 class="widgetheading">Address</h5>
        <address>
          <?= $fetch_content['address']; ?>
        </address>
        </div>
      </div>

    </div>
  </div> <br>
  <div id="sub-footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="copyright">
            <p>
              <span>&copy; 3S 2022 All right reserved.  
            </p>
          </div>
        </div>
        <div class="col-lg-6">
          <ul class="social-network" style="color: #fff !important ;">
            <?php 
              if($fetch_fb['display'] == "show"){
                ?>
                  <li><a href="<?= $fetch_fb['url'];?>" data-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                <?php
              }
              if($fetch_tw['display'] == "show"){
                ?>
                  <li><a href="<?= $fetch_tw['url'];?>" data-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                <?php
              }
              if($fetch_in['display'] == "show"){
                ?>
                  <li><a href="<?= $fetch_in['url'];?>" data-placement="top" title="Instagram"><i class="fa-brands fa-instagram"></i></a></li>
                <?php
              }
              if($fetch_tk['display'] == "show"){
                ?>
                  <li><a href="<?= $fetch_tk['url'];?>" data-placement="top" title="Tiktok"><i class="fa-brands fa-tiktok"></i></a></li>
                <?php
              }
              if($fetch_yt['display'] == "show"){
                ?>
                  <li><a href="<?= $fetch_yt['url'];?>" data-placement="top" title="Email"><i class="fa-brands fa-youtube"></i></a></li>
                <?php
              }

            ?>
          </ul>
          <br></br>
        </div>
      </div>
    </div>
  </div>


     
</div>
</footer>


<script src="assets/home-plugins/js/slider.js"></script>

<script>
  
   //scroll to top
   $(window).on('scroll', function() {
        if ($(this).scrollTop() > 100) {
            $('.scrollup').fadeIn();
        } else {
            $('.scrollup').fadeOut();
        }
    });
    $('.scrollup').on('click', function() {
        $("html, body").animate({ scrollTop: 0 }, 1000);
        return false;
    });

</script>

 
</body>
</html>