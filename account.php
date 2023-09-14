<?php
	session_start();
	require_once("includes/head.php");
	require("includes/header.php");
?>
<!--header-->	
<script src="js/responsiveslides.min.js"></script>
<script>  
    $(function () {
      $("#slider").responsiveSlides({
      	auto: false,
      	nav: true,
      	speed: 500,
        namespace: "callbacks",
        pager: false,
      });
    });
  </script>
  

<!---->	
<div class="container">
	  <ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li class="active">Log in/Register</li>
		 </ol>
	 <div class="registration">
		 <div class="registration_left">
			 <h2>new user? <span> create an account </span></h2>
			 <!-- [if IE] 
				< link rel='stylesheet' type='text/css' href='ie.css'/>  
			 [endif] -->  
			  
			 <!-- [if lt IE 7]>  
				< link rel='stylesheet' type='text/css' href='ie6.css'/>  
			 <! [endif] -->  
			 <script>
				(function() {
			
				// Create input element for testing
				var inputs = document.createElement('input');
				
				// Create the supports object
				var supports = {};
				
				supports.autofocus   = 'autofocus' in inputs;
				supports.required    = 'required' in inputs;
				supports.placeholder = 'placeholder' in inputs;
			
				// Fallback for autofocus attribute
				if(!supports.autofocus) {
					
				}
				
				// Fallback for required attribute
				if(!supports.required) {
					
				}
			
				// Fallback for placeholder attribute
				if(!supports.placeholder) {
					
				}
				
				// Change text inside send button on submit
				var send = document.getElementById('register-submit');
				if(send) {
					send.onclick = function () {
						this.innerHTML = '...Sending';
					}
				}
			
			 })();
			 </script>
			 <div class="registration_form">
			 <!-- Form -->
				<form>
					<div>
						<label>
							<input placeholder="first name" type="text" tabindex="1" id="first-Name" name="firstName">
						</label>
					</div>
					<div>
						<label>
							<input placeholder="last name" type="text" tabindex="2"id="last-Name" name="lastName">
						</label>
					</div>
					<div>
						<label>
							<input placeholder="email address" type="email" tabindex="3" id="emailAdd" name="email">
						</label>
					</div>						
					<div>
						<label>
							<input placeholder="password" type="password" tabindex="4" id="pass" name="password">
						</label>
					</div>						
					<div>
						<label>
							<input placeholder="retype password" type="password" tabindex="4" id="rePass" name="rePassword">
						</label>
					</div>	
					<div>
						<input type="submit" value="create an account" id="register" name="btnn">
					</div>
					<div class="alert alert-success" id="succ" role="alert">
						<strong>Well done!</strong> Your registration was successfull.
			   		</div>
					   <div id="success"class="green textcenter">
                        
						</div> 
				</form>
				<!-- /Form -->
			 </div>
		 </div>
		 <div class="registration_left">
			 <h2>existing user - <span> Log in here</span></h2></h2> 
			 <div class="registration_form">
			 <!-- Form -->
				<form>
					<div>
						<label>
							<input placeholder="email" type="email" tabindex="3" id="emailLog" required>
						</label>
					</div>
					<div>
						<label>
							<input placeholder="password" type="password" tabindex="4" id="passwordLog" required>
						</label>
					</div>						
					<div>
						<input type="submit" value="Log in" id="logIn">
					</div>
					<div class="alert alert-danger" id="err" role="alert">
						<strong>Something went wrong</strong> Please try again.
			   		</div>
				</form>
			 <!-- /Form -->
			 </div>
		 </div>
		 <div class="clearfix"></div>
	 </div>
</div>
<!---->
<?php
    require_once("includes/footer.php");
?>
<!---->

</body>
</html>