<?php
	session_start();
	require_once("includes/head.php");
	require("includes/header.php");
?>
<!-- header -->
<?php
    require_once("includes/header.php");
?>
<!-- check out -->
<div class="container">
	<div class="check-sec">	 
		<div class="col-md-3 cart-total">
			<a class="continue" href="product.php">Continue shopping</a>
			<div class="price-details">
				<h3>Price Details</h3>
				<span>Total:</span>
				<span class="total1 simpleCart_total"></span>
				<span>Discount:</span>
				<span class="total1">0%</span>
				<span>Delivery Charges:</span>
				<span class="total1">0$</span>
				<div class="clearfix"></div>				 
			</div>	
			<ul class="total_price">
			   <li class="last_price"> <h4>TOTAL</h4></li>	
			   <li class="last_price simpleCart_total"><span></span></li>			   
			</ul> 
			<div class="clearfix"></div>
			<div class="clearfix"></div>
			<a id="order" class="order" href="#">Place Order</a>
			<div class="total-item">
				<h3>OPTIONS</h3>
				<h4>COUPONS</h4>
				<a class="cpns" id="applyCupons" href="#">Apply Coupons</a>
			</div>
		</div>
		<div class="col-md-9 cart-items">
			<h1>My Shopping Bag (<span id="simpleCart_quantity" class="simpleCart_quantity"></span>)</h1>
			<?php
				//include_once("includes/shopping-cart.php");
			?>
			<?php
				require("models/functions.php");
				$products = getProducts();
			?>
			<input type="hidden" id="cartUser" value="<?=$_SESSION['user']->id_user?>">
			<script>$(document).ready(function(c) {
								$('.close1').on('click', function(c){
									$('.cart-header').fadeOut('slow', function(c){
										$('.cart-header').remove();
									});
									});	  
								});
						</script>
						<div class="cart-header">				
							<div id="cartWrite">
														
							</div>
							<div id="carterror">
														
							</div>
						</div>
							</br></br></br>
						<div class="total-item">
						<a class="cpns" id="clearCart" href="#">Clear cart</a>
						</div>
			 	
		</div>
		<div class="clearfix"> </div>
	</div>
</div>
<!-- //check out -->
<!---->
<?php
    require_once("includes/footer.php");
?>
<!---->
</body>
</html>