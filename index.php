<?php
	session_start();
	require_once("includes/head.php");
	require("includes/header.php");
	require("models/functions.php");
	require_once("includes/slider.php");
	$questionSurvey = surveyQuestion();
	$answersSurvey = surveyAnswer();
	$products = getProducts();
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

<!---->	

<!---->

<div class="items">
	 <div class="container">
		 <div class="items-sec">
			<?php
			$i=0;
				foreach($products as $p):					
					if($i == 4)
					{
						break;
					}
					$i++;
			?>
			 <div class="col-md-3 feature-grid">
				 <a href="product.php"><img src="<?=$p->path?>" alt="<?=$p->alt?>"/>	
					 <div class="arrival-info">
						 <h4><?=$p->name?></h4>
						 <p><?=$p->price?>$</p>
					 </div>
					 <div class="viw">
						<a href="product.php"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>View</a>
					 </div>
				  </a>
			 </div>
			 <?php
				endforeach;
			 ?>
			 <div class="clearfix"></div>
		 </div>
	 </div>
</div>



<div class="mx-0 mx-sm-auto sur">
  <div class="card">
  <input type="hidden" id="logedIn" value="<?=$_SESSION['user']->id_user?>">
		<?php
			if(isset($_SESSION['user'])):
		?>
    <div class="modal-body">
      <div class="text-center">
        <i class="far fa-file-alt fa-4x mb-3 text-primary"></i>
        <h4>In a mood for a little survey? Feel free to answer.</h4>
      </div>

      <hr />

      <form class="px-4 survey-from" action="">
	  	<?php		
			foreach($questionSurvey as $q):
		?>
        <p class="text-center"><strong><?= $q->question ?></strong></p>
			</br></br>

		<?php
			foreach($answersSurvey as $a):
				if($a->id_survey==$q->id_survey):
		?>
        <div class="form-check mb-2">
		<label class="form-check-label" for="radio3Example1">
            <?= $a->answer ?>
          </label>
          <input class="form-check-input survey" type="radio" name="survey?<?=$a->id_survey?>" id="radio3Example1" value="<?=$a->id_answer?>" data-id="<?=$a->id_survey?>"/>
          </div>
		  <?php
				endif;
				endforeach;
			?>
        

        
      </form>
    </div>
    <div class="card-footer text-end">
		<br/>
      <button type="button" class="btn btn-primary send" data-id="<?=$q->id_survey?>">Submit</button>
	  </br></br>
    </div>
	<?php
		endforeach;
		endif;
	?>
  </div>
</div>



<!--
<div class="container">
<input type="hidden" id="logedIn" value="<?=$_SESSION['user']->id_user?>">
		<?php
			if(isset($_SESSION['user'])):
		?>
			<div class="row tm-welcome-section">
				<div class="col-md-12 text-center">
			</br>
			</br>
			</br>
				<h4>In a mood for a little survey? Feel free to answer.</h4>
			</br>
			</br>
			</br>
			</div>
		</div>
		<div class="row col-5 surveyS">
			<h4 class="fw-bold text-center mt-3"></h4>
			 	<form class=" bg-white px-4 surveyFrom" action="">
				 <?php		
					foreach($questionSurvey as $q):
				 ?>
				 <div>
					<p class="fw-bold"><?= $q->question ?></p>
					</div>	
					 <?php
					 foreach($answersSurvey as $a):
						if($a->id_survey==$q->id_survey):
					 ?>
						<div class="form-check mb-2">
							<input class="form-check-input" type="radio" name="survey?<?=$a->id_survey?>" id="blankRadio1" value="<?=$a->id_answer?>" data-id="<?=$a->id_survey?>" />
								<label class="form-check-label" for="radioExample1">
									<?= $a->answer ?>
								</label>
						</div>
						<?php
							endif;
							endforeach;
						?>
				</form>
				<div class="text-end">
					<button type="button" class="btn btn-primary">Submit</button>
				</div>
				<?php
					endforeach;
				endif;
				?>
		</div>
</div>

</div>
			-->


<!--
<div class="offers">
	<div class="container">
	 <h3>End of Season Sale</h3>
	 <input type="hidden" id="logedIn" value="<?=$_SESSION['user']->id_user?>">
		<?php
			if(isset($_SESSION['user'])):
		?>
			<div class="row tm-welcome-section">
				<div class="col-md-12 text-center">
			</br>
			</br>
			</br>
				<h4>In a mood for a little survey? Feel free to answer.</h4>
			</br>
			</br>
			</br>
			</div>
		</div>
		<div class="row col-5">
			<h4 class="fw-bold text-center mt-3"></h4>
			 	<form class=" bg-white px-4" action="">
				 <?php		
					foreach($questionSurvey as $q):
				 ?>
				 <div>
					<p class="fw-bold"><?= $q->question ?></p>
					</div>	
					 <?php
					 foreach($answersSurvey as $a):
						if($a->id_survey==$q->id_survey):
					 ?>
						<div class="form-check mb-2">
							<input class="form-check-input" type="radio" name="survey?<?=$a->id_survey?>" id="blankRadio1" value="<?=$a->id_answer?>" data-id="<?=$a->id_survey?>" />
								<label class="form-check-label" for="radioExample1">
									<?= $a->answer ?>
								</label>
						</div>
						<?php
							endif;
							endforeach;
						?>
				</form>
				<div class="text-end">
					<button type="button" class="btn btn-primary">Submit</button>
				</div>
				<?php
					endforeach;
				endif;
				?>
		</div>


	</div>
</div>
-->			
	

<!---->

<!-- REQUIRE FOR FOOTER, NEWSLETER AND COPYRIGHT --> 
<?php
    require_once("includes/footer.php");
?>
<script src="js/bootstrap.js"> </script>
<!---->
</body>
</html>
