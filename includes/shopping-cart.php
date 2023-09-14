<?php
	require("models/functions.php");
	$products = getProducts();
?>
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
			</div>