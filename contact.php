<?php 
session_start();
$page_title = '3S | Contact Page';
?>

<?php 
include 'includes/header.php'; 
$jumbo_title = 'Contact Us';
include 'includes/pages.php'
?> 

 
<section id="content">
	
	<div class="container">
		<div class="row"> 
			<div class="col-md-12">
				<div class="about-logo">
					<h3>Persons with Disability Affairs Office of Pagsanjan</h3>
                    <?php 
                        $contact_query = mysqli_query($conn, "SELECT line_1, line_2 FROM content_manage WHERE cmid = '1' ");
                        $fetch_con = mysqli_fetch_array($contact_query);
                    ?>
					<p><?= $fetch_con['line_1']; ?></p>
                	<p><?= $fetch_con['line_2']; ?></p>
				</div>  
			</div>
		</div>

	<div class="row">
		<div class="col-md-6">
			<p>Get in touch with us by sending a message.</p>
								  	
		<!-- Form itself -->
        <form method="post" action="connections/send.php" name="sentMessage" id="contactForm">
	       <h3>Contact Us</h3>
           
        <div class="control-group">
          <div class="controls">
			<input  type="text" class="form-control" id="contact_name" name="contact_name" placeholder="Name" required
	    	   		data-validation-required-message="Please enter your name" />
            <p class="help-block"></p>
		    </div>
	    </div> 	
        
        <div class="control-group">
          <div class="controls">
			<input  type="email" class="form-control" id="contact_email" name="contact_email"  placeholder="Email" required
	    	   		data-validation-required-message="Please enter your email" />
            <p class="help-block"></p>
		    </div>
	    </div>

        <div class="control-group">
            <div class="controls">
            <textarea rows="10" cols="100" class="form-control" 
                placeholder="Message" id="contact_message" name="contact_message" required
                data-validation-required-message="Please enter your message" minlength="5" 
                data-validation-minlength-message="Min 5 characters" 
                maxlength="300" style="resize:none"></textarea>
            </div>
        </div>

        <br>
	    <button type="submit" name="send_button" id="send_button" class="btn btn-primary pull-right" style="background-color:#77A6F7; border:none; border-radius:5px">Send</button><br />
        </form>
        </div>
        
        <div class="col-md-6">

            <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
            <div style="overflow:hidden;height:500px;width:600px;">
            <div id="gmap_canvas" style="height:500px;width:600px;"></div>
            
            <style>#gmap_canvas img{max-width:none!important;background:none!important}</style>
                <a class="google-map-code" href="http://www.trivoo.net" id="get-map-data">trivoo</a>
            </div>

            </div>
        </div>
	</div>
 
	</section>

    <br>
 
    <script type="text/javascript"> 
        function init_map(){
            var myOptions = { 
                zoom:18,
                center:new google.maps.LatLng(14.264711656781559, 121.43983593880343),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
                map = new google.maps.Map(
                document.getElementById("gmap_canvas"), 
                myOptions);
                marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(14.264711656781559, 121.43983593880343)});
                infowindow = new google.maps.InfoWindow({content:"<b>PDAO Pagsanjan &nbsp; &nbsp;</b> <br/>Laguna<br/>Philippines <p></p>" });
                google.maps.event.addListener(marker, "click", function(){infowindow.open(map,marker);});
                infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);
    </script>

    
<script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>

<script>
$(document).ready(function() {

    $("#contactForm").submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'connections/send.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                if(response == "empty"){
                    alert('Please fill out all the fields');
                }
                else if (response == 'ok') {
                    alert('Thank you for contacting us, your message has been sent successfully.');
                    $('#contactForm')[0].reset();
                } else {
                    alert('An error has occured. Try messaging us again');
                }
            }
        });
    });
});
</script>

<?php include 'includes/footer.php' ?>