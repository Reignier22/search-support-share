<?php 

include 'connections/config.php';
session_start();
$ip_add = $_SERVER['REMOTE_ADDR'];
$query = "SELECT * FROM visitors WHERE ip_address= '$ip_add' ";
$result = mysqli_query($conn, $query);

if(!$result){
    die("Retrieving query error<br>".$query);
}

$total_visit= mysqli_num_rows($result);
if($total_visit < 1){
    $query = "INSERT INTO visitors(`ip_address`, `counter`) VALUES ('$ip_add', '1') ";
    $result= mysqli_query($conn, $query);
} else{
    $query = mysqli_query($conn, "UPDATE visitors SET `counter`= `counter` + 1 WHERE ip_address='$ip_add'");
}

$page_title = '3S | Index Page';
?>

<?php include 'includes/header.php'; ?> 


<div id="wrapper" class="home-page">


<section id="banner">
   
  <!-- Slider -->

  <?php 
  $fetch_query = mysqli_query($conn, "SELECT * FROM content_manage WHERE cmid = 1");
  $fetch_slider =mysqli_fetch_array($fetch_query);
  ?>

  <div class="carousel carousel__fade">
      <div class="carousel_inner">
      <div class="carousel_item carousel_item__active">
            <img src="admin/assets/img/slider/<?= $fetch_slider['imageA'];?>" alt="Image A" class="carousel_img">
            <div class="carousel_caption">
               <h1 class="carousel_title">Search</h1>
               <p class="carousel_description"><?= $fetch_slider['search_caption']; ?></p>
            </div>
         </div>
         <div class="carousel_item">
            <img src="admin/assets/img/slider/<?= $fetch_slider['imageB'];?>" alt="Image B" class="carousel_img">
            <div class="carousel_caption">
               <h1 class="carousel_title">Support</h1>
               <p class="carousel_description"><?= $fetch_slider['support_caption']; ?></p>
            </div>
         </div>
         <div class="carousel_item">
            <img src="admin/assets/img/slider/<?= $fetch_slider['imageC'];?>" alt="Image 3" class="carousel_img">
            <div class="carousel_caption">
               <h1 class="carousel_title">Share</h1>
               <p class="carousel_description"><?= $fetch_slider['share_caption']; ?></p>
            </div>
         </div>
      </div>
   </div>

  
  <!-- end slider -->
  
   </section> 

<!-- Job Search -->

<div class="jumbotron" id="jumbo" style="padding: 30px 100px 0px 100px;">

  <div class="jumbotron_caption">
      <h1 class="jumbotron_title">Find a job that's perfect for you</h1>
      <p class="jumbotron_description">3S is a Job Web Portal with Crowdfunding Platform that was created specifically for differently-abled people to give them better opportunities.</p>

    <div  style="margin-top:10px">  
      <div class="row search-area" >

        <div class="col-sm-3"> 
        <form action="search.php" method="get" autocomplete="off">
          <p id="position"> Job Position</p> 
          <input type="text" class="input-search"  name="job_position" id="position-input"> 
        </div>

        <div class="col-sm-3"> 
          <p id="loc"> Location</p> 
          <input type="text" class="input-search"  name="location" id="loc-input"> 
        </div>

        <div class="col-sm-3">
          <p id="dc"> Disability Category</p>
          <select name="catid" id="catid" class="input-search" id="dc-input">
                <?php

                    $sql = "select * from categories";
                    $data = mysqli_query($conn,$sql);
                    if(mysqli_num_rows( $data) > 0){
                        while($rs=mysqli_fetch_array($data)){
                          ?><option value="<?=$rs['catid']?>"><?= $rs['name']?></option><?php
                        }
                    }else{
                        ?><option>No category found</option><?php
                  }
                ?>
          </select>
        </div>

        <div class="col-sm-3"> 
          <p id="hide">&nbsp;</p> 
          <input type="submit" class="input-search" value="Search">
        </div>
        </form>

      </div>
    </div>

  </div>



</div>

<!-- End Job Search -->


<!-- Categories -->

<div class="container">

<h1 style="text-align: center; color:#00887A"> Disability Categories </h1>
<hr>

<div id="categories">

        <div class="row" id="con-row">

        <?php
            $category = mysqli_query($conn, "SELECT * FROM categories ORDER BY catid ASC");  
            foreach($category as $catrow) : 
        ?>

          <div class="col-lg-3">
            <div class="cat_container">
                  <div class="div1">
                    
                    <div class="img_container">
                      <img src="admin/assets/img/caticons/<?php echo $catrow['image']; ?>" />
                    </div>
                      
                      <p><?php echo $catrow['name']; ?></p>

                      <?php 
                        $catid = $catrow['catid'];
                        $position = mysqli_query($conn,"SELECT jobs.jobid, categories.catid as 'catid'
                        FROM jobs 
                        INNER JOIN categories ON categories.catid = jobs.catid
                        WHERE jobs.catid  = $catid ") ;
                        $count = mysqli_num_rows($position);
                      ?>

                      <?php 
                      if(empty($count))
                        {
                           ?>
                              <a style="text-decoration:none;"><p style="color:#d3d3d3"> No available positions </p> </a>
                           <?php
                        } else{
                          ?>
                              <a href="hiring_categories.php?catid=<?= $catrow['catid'];?>&catname=<?= $catrow['name']; ?>" style="text-decoration:none"> <p class="available"> <?=$count?> available position<?php if($count > 1){echo "s";}?> </p> </a>
                          <?php
                        } 
                      ?>  
                      <br /><br />
                  </div>
            </div> <br>
          </div>

        <?php  endforeach; ?>  

        </div>
</div>

</div>

<!-- End Category -->

<br>

<?php include 'includes/footer.php' ?>





 