<?php
	session_start();
	require_once("includes/head.php");
	require_once("includes/header.php");
	require("models/functions.php");
	$products = getProducts();
	$categories = getCategories();
	$brands = getBrands();
	$numPerPage = 9;
	$totalNum = count($products);
	//var_dump($totalNum);
	$totalPages = ceil($totalNum / $numPerPage);
	//var_dump($totalPages);

	if(isset($_GET["page"]))
	{
		$page = $_GET["page"];
	}
	else
	{
		$page = 1;
	}

	$startFrom = ($page - 1) * $numPerPage;
	$sql = "SELECT * FROM product p JOIN price pr ON p.id_price = pr.id_price
	JOIN picture pi ON pi.id_picture = p.id_picture LIMIT $startFrom,$numPerPage"; 
	$products = $conn->query($sql);

?>
<div class="product-model">	 
	 <div class="container">
			<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li class="active">Products</li>
		 </ol>
			<h2>Our Products</h2>			
		 <div class="col-md-9 product-model-sec productss">
				<?php
				$i = 2;
					foreach($products as $p):
						//var_dump($p->name);
				?>
					 <a href="single.php"><div class="product-grid">
						<div class="more-product"><span> </span></div>						
						<div class="product-img b-link-stripe b-animate-go  thickbox productL" >
							<img src="<?=$p->path?>" class="img-responsive" alt="<?=$p->alt?>">
							<div class="b-wrapper">
							<h4 class="b-animate b-from-left  b-delay03">							
							<button class="quickView" data-id="<?= $p->id_product ?>"><span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span>Quick View</button>
							</h4>
							</div>
						</div></a>						
						<div class="product-info simpleCart_shelfItem">
							<div class="product-info-cust prt_name" >
								<h4><?=$p->name?></h4>								
								<span class="item_price"><?=$p->price?>$</span>
								<!--
								<div class="ofr">
								  <p class="pric1"><del>Rs 280</del></p>
						          <p class="disc">[12% Off]</p>
								</div>
								-->
								<input type="text" class="item_quantity" value="1" />
								<input type="button" class="item_add items" value="ADD" id="buttonAdd" data-id="<?= $p->id_product ?>" />
								<div class="clearfix"> </div>
							</div>												
							
						</div>
					</div>	
					<?php
					$i++;
                            endforeach;
                    ?>

				<div class="pagenatin">
					<div class="col-md-6 paging">
					  <nav>
					  <ul class="pagination pagination-lg">
						<li><a href="product.php?page=1" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
						<?php
							for($i=1;$i<=$totalPages;$i++)
							{
								echo("<li><a href='product.php?page=".$i."'>".$i."</a></li>");
							}
						?>
						<li><a href="product.php?page=<?php echo($totalPages)?>" aria-label="Next"><span aria-hidden="true">»</span></a></li>
					  </ul>
					  </nav>
					</div>
				</div>

			</div>
			
			<section  class="sky-form">
			<div class="col-12 input-group rounded tm-welcome-section">
				<input type="search" id="search" class="form-control rounded border-bottom" placeholder="Search products" aria-label="Search"
				  aria-describedby="search-addon" />
				<span class="input-group-text border-0" id="search-addon">
			  </div>
						</br></br>
						<h4><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>Categories</h4>
							<div class="row row1 scroll-pane">
								<?php
									foreach($categories as $c):
										//var_dump($p->name);
								?>
								<div class="col col-4">
									<label class="checkbox"><input type="checkbox" class="cat" id="cat" name="checkbox" value="<?=$c->id_category?>" /><i></i><?= $c->name_category ?></label>
								</div>
								<?php
                            		endforeach;
                    			?>
							</div>
				   </section>	
				   <section  class="sky-form">
						<h4><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>Brand</h4>
							<div class="row row1 scroll-pane">
							<?php
									foreach($brands as $b):
							?>
								<div class="col col-4">								
									<label class="checkbox"><input type="checkbox" name="checkbox" value="<?=$b->id_brand?>"><i></i><?= $b->brand_name ?></label>
								</div>
								<?php
                            		endforeach;
                    			?>
							</div>
				   </section>							

			<div class="rsidebar span_1_of_left">

						  <!--script-->
						<script>
							$(document).ready(function(){
								$(".tab1 .single-bottom").hide();
								$(".tab2 .single-bottom").hide();
								$(".tab3 .single-bottom").hide();
								$(".tab4 .single-bottom").hide();
								$(".tab5 .single-bottom").hide();
								
								$(".tab1 ul").click(function(){
									$(".tab1 .single-bottom").slideToggle(300);
									$(".tab2 .single-bottom").hide();
									$(".tab3 .single-bottom").hide();
									$(".tab4 .single-bottom").hide();
									$(".tab5 .single-bottom").hide();
								})
								$(".tab2 ul").click(function(){
									$(".tab2 .single-bottom").slideToggle(300);
									$(".tab1 .single-bottom").hide();
									$(".tab3 .single-bottom").hide();
									$(".tab4 .single-bottom").hide();
									$(".tab5 .single-bottom").hide();
								})
								$(".tab3 ul").click(function(){
									$(".tab3 .single-bottom").slideToggle(300);
									$(".tab4 .single-bottom").hide();
									$(".tab5 .single-bottom").hide();
									$(".tab2 .single-bottom").hide();
									$(".tab1 .single-bottom").hide();
								})
								$(".tab4 ul").click(function(){
									$(".tab4 .single-bottom").slideToggle(300);
									$(".tab5 .single-bottom").hide();
									$(".tab3 .single-bottom").hide();
									$(".tab2 .single-bottom").hide();
									$(".tab1 .single-bottom").hide();
								})	
								$(".tab5 ul").click(function(){
									$(".tab5 .single-bottom").slideToggle(300);
									$(".tab4 .single-bottom").hide();
									$(".tab3 .single-bottom").hide();
									$(".tab2 .single-bottom").hide();
									$(".tab1 .single-bottom").hide();
								})	
							});
						</script>
						<!-- script -->					 
				   <!---->
					 <script type="text/javascript" src="js/jquery-ui.min.js"></script>
					 <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
					<script type='text/javascript'>//<![CDATA[ 
					$(window).load(function(){
					 $( "#slider-range" ).slider({
								range: true,
								min: 0,
								max: 100000,
								values: [ 500, 100000 ],
								slide: function( event, ui ) {  $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
								}
					 });
					$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) + " - $" + $( "#slider-range" ).slider( "values", 1 ) );

					});//]]> 
					</script>
					 <!---->
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
</html>