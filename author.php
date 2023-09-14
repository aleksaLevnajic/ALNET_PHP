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
      	auto: true,
      	nav: true,
      	speed: 500,
        namespace: "callbacks",
        pager: false,
      });
    });
  </script>
<!-- INCLUDE FOR HEADER, MENU AND CART -->  
<?php
    require_once("includes/header.php");
?>

<div class="container">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li class="active">Author</li>
		 </ol>
         <div class="author">
		    <div class="author_left">
                <div class="tm-container-inner tm-history">
                    <div class="row">
                        <div class="col-12">
                            <div class="tm-history-inner">
                                <img src="images/autor.jpeg" alt="author" id="slikaAutor" class="img-fluid tm-history-img slikaAutor" />
                            </div>	
                        </div>
                    </div>
                </div>
            </div>
            <div class="author_right">
                <div class="tm-history-text"> 
                    <h4 class="tm-history-title">Author of the page</h4>
                        <p class="tm-mb-p">Hello, my name is Aleksa and I am student of ICT Collage in Belgrade. I am very interasted in software and web development. You can contact me by sending email on <a href="https://mail.google.com/mail/">aleksa.levnajic.106.19&#64;ict.edu.rs</a> or message me on my social-media accounts.</p>
                </div>
            </div>
        </div>    
</div>         

<?php
    require_once("includes/footer.php");
?>
<!---->
</body>
</html>
