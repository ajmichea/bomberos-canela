<section>
    <div class="container">
		<div class="row">
			<div class="col-md-9">
				<div id="myCarousel" class="carousel slide" data-ride="carousel">
		  			<ol class="carousel-indicators">
		  				<?php
		  				if (isset($banners)) {
		  				 	$i=0;
		  				 	foreach ($banners as $k) {
		  				 		$i++;
		  				 	}
		  				 }

		  				 for ($m=0; $m < $i; $m++) {  
		  				 	if($m <6){	?>
		  				  		<li data-target="#myCarousel" data-slide-to="<?php echo $m; ?>" <?php if($m == 0){ echo 'class="active"';} ?>></li>
		  				  	<?php
		  				  	}
		  				  } 
		  				?>
				    </ol>
				    <div class="carousel-inner" role="listbox">
				    	<?php
				    	if (isset($banners)) {
				    	 	if (isset($bannerspublicaciones)) {
				    	 		$link = $bannerspublicaciones;	
				    	 	}else{
				    	 		$link = false;
				    	 	}
				    	 	$i = 0;
				    	 	foreach ($banners as $b) {
				    	 		if ($i<6) {  ?>
				    	 		<div class="item <?php if($i == 0) { echo 'active'; } ?>">
						            <img class="img-responsive imagen-slider" src="<?php echo $b->IMAGEN_BANNER; ?>" <?php if($i == 0) { echo 'alt="First slide"'; }else{ echo 'alt="Second slide"';} ?> >
						            <div class="container">
						            	<div class="carousel-caption">
						            		<?php
						            		if ($link) {
						            			$validalink = false;
						            			$j=0;
						            			foreach ($link as $l) {
						            				if ($l->id_banner == $b->ID_BANNER) {	
						            					$validalink = true;
						            					$not = $l->id_publicacion;
						            				}
						            			}
						            			if ($validalink) {    ?>
							            			<h1><a href="<?php echo base_url();?>Home/Noticias/<?php echo $not; ?>"><?php echo $b->NOMBRE_BANNER; ?></a></h1>
					            				<?php
						            			}else{  ?>
					            					<h1><?php echo $b->NOMBRE_BANNER; ?></h1>
					            				<?php
						            			}
						            		}else{ ?>
						            			<h1><?php echo $b->NOMBRE_BANNER; ?></h1>
						            		<?php
						            		}	?>
						            		<p><?php echo $b->NOMBREIMAGENBANNER; ?></p>
						           	    </div>
				            		</div>
				            	</div>
				    	 		<?php	
				    	 		}
				    	 		$i++;
				    	 	}

				    	 } 
				    	?>
					    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
					        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					        <span class="sr-only">Previous</span>
					    </a>
					    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
					        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					        <span class="sr-only">Next</span>
					    </a>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<?php include("application/views/Aside/asideSup.php"); ?><a name="prevencion" id="prevencion"></a>
			</div>				
		</div> <!--homeSup-->
		
		<div class="row">
				<?php
				if (isset($noticias)) {
					$i = 0;
					foreach ($noticias as $n) {
						if ($i < 3) {	?>
							<div class="col-md-3">
								<div class="fondo_item">
									<img class="img-circle fondo_item" src="<?php echo $n->FOTO_PUBLICACIONINICIAL; ?>" alt="Generic placeholder image" width="140" height="140">
						      		<h2 class="fondo_item"><?php echo $n->NOMBRE_PUBLICACION; ?></h2>
						      		<p class="fondo_item"><?php echo $n->DESCRIPCION_PUBLICACION; ?></p>
						      		<p class="fondo_item"><a class="btn btn-default fondo_item" href="<?php echo base_url();?>Home/Noticias/<?php echo $n->ID_PUBLICACION; ?>" role="button">ver más... »</a></p>
								</div>
							</div>
						<?php
						}
						$i++;
					}
				}else{
					echo '<div class="col-md-9"></div>';
				}
				?>								
			<div class="col-md-3">
				<?php include("application/views/Aside/asideInf.php"); ?>
			</div>				
		</div><!--homeInf-->
	</div>
</section>
		
	