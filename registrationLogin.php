<!DOCTYPE html>
<html>
<head>
<title>Lighting A Ecommerce Category Flat Bootstarp Resposive Website Template | Account :: w3layouts</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<!-- Custom Theme files -->
<!--theme-style-->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />	
<script src="js/jquery.min.js"></script>

<!--//theme style-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Wedding Store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- start menu -->
<script src="js/simpleCart.min.js"> </script>
<!-- start menu -->
<link href="css/memenu.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="js/memenu.js"></script>
<script>$(document).ready(function(){$(".memenu").memenu();});</script>	
<!-- /start menu -->
</head>
<body> 
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

<?php
    require_once("includes/header.php");
?>

<div class="container">
	  <ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li class="active">Account</li>
		 </ol>
	 <div class="registration">
		 <div class="registration_left">
			 <h2>new user? <span> create an account </span></h2>

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
						<input type="button" value="create an account" id="register-submit" name="btnn">
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
			 <h2>existing user</h2>
			 <div class="registration_form">
			 <!-- Form -->
				<form>
					<div>
						<label>
							<input placeholder="email" type="email" tabindex="3" required>
						</label>
					</div>
					<div>
						<label>
							<input placeholder="password" type="password" tabindex="4" required>
						</label>
					</div>						
					<div>
						<input type="submit" value="sign in">
					</div>
					<div class="forget">
						<a href="#">forgot your password</a>
					</div>
				</form>
			 <!-- /Form -->
			 </div>
		 </div>
		 <div class="clearfix"></div>
	 </div>
</div>




<?php
    require_once("includes/footer.php");
?>

<script type="text/javascript" src="js/main.js"></script>
</body>
</html>