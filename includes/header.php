<?php
	//require("models/login.php");
	require("models/menu.php");
	//$upit="SELECT * FROM menu WHERE display=1";
	//$menu=$conn->query($upit)->fetchAll();
?>

<div class="header-top">
	 <div class="header-bottom">			
				<div class="logo">
					<h1><a href="index.php">ALNET</a></h1>					
				</div>
			 <!---->		 
			 <div class="top-nav">
			 	<ul class="memenu skyblue">
				<?php            
					foreach($menu as $m):
				?>
					<li class="active">
						<a href="<?=$m->path_m?>"><?=$m->name_menu?></a>
					</li>
				<?php
					endforeach;
					?>
				</ul>		
			 </div>
			 <!---->
			 <div class="cart box_1">
				 <a href="checkout.php">
					<div class="total">
					<span class="simpleCart_total"></span> (<span id="simpleCart_quantity" class="simpleCart_quantity"></span>)</div>
					<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
				</a>
				<p><a href="javascript:;" class="simpleCart_empty">Empty Cart</a></p>
			 	<div class="clearfix"> </div>
			 </div>
			 <div class="clearfix"> </div>
			 <!---->			 
			 </div>
			<div class="clearfix"> </div>
</div>