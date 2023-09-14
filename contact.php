<?php
	session_start();
	require_once("includes/head.php");
	require("includes/header.php");
?>
<!--header-->	
<?php
    require_once("includes/header.php");
?>
<!---->
<div class="contact">
	  <div class="container">
		 <ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li class="active">Contact</li>
		 </ol>
			<!--start contact-->
			<h3>Contact Us</h3>
		  <div class="section group">				
				<div class="col-md-6 span_1_of_3">
					<div class="contact_info">
			    	 	<h4>Find Us Here</h4>
			    	 		<div class="map">
					   			<iframe src="https://maps.google.co.in/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Lighthouse+Point,+FL,+United+States&amp;aq=4&amp;oq=light&amp;sll=26.275636,-80.087265&amp;sspn=0.04941,0.104628&amp;ie=UTF8&amp;hq=&amp;hnear=Lighthouse+Point,+Broward,+Florida,+United+States&amp;t=m&amp;z=14&amp;ll=26.275636,-80.087265&amp;output=embed"></iframe>
					   		</div>
      				</div>
      			<div class="company_address">
				     	<h4>Company Information :</h4>
						    	<p>500 Freen Street,</p>
						   		<p>22-56-2-9 Sit Amet, Lorem,</p>
						   		<p>USA</p>
				   		<p>Phone:(00) 222 666 444</p>
				   		<p>Fax: (000) 000 00 00 0</p>
				 	 	<p>Email: <a href="mailto:info@example.com">info@mycompany.com</a></p>
				   		<p>Follow on: <a href="https://facebook.com/">Facebook</a>, <a href="https://twitter.com/">Twitter</a></p>
				   </div>
				</div>				
				<div class="col-md-6 span_2_of_3">
				  <div class="contact-form">
					    <form>
					    	<div>
						    	<span><label>NAME</label></span>
						    	<span><input id="name" name="userName" type="text" class="textbox" class="placeHolder"></span>
						    </div>
						    <div>
						    	<span><label>E-MAIL</label></span>
						    	<span><input id="email" name="userEmail" type="text" class="textbox"></span>
						    </div>
						    <div>
						     	<span><label>MOBILE</label></span>
						    	<span><input id="mobile" name="userPhone" type="text" class="textbox"></span>
						    </div>
						    <div>
						    	<span><label>SUBJECT</label></span>
						    	<span><textarea id="subject"name="userMsg"> </textarea></span>
						    </div>
						   <div>
						   		<span><input type="submit" id="submitContact" class="mybutton" value="Submit"></span>
						  </div>
					    </form>
						<div class="alert alert-success" id="succ" role="alert">
							<strong>Message is sent!</strong> We will contact you as soon is possible.
			   			</div>

				    </div>
  				</div>				
		  </div>
	  </div>
 </div>
<!---->
<?php
    require_once("includes/footer.php");
?>
<!---->
</body>
<script type="text/javascript" src="js/contact.js"></script>
</html>