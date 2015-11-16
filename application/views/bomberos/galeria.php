<section>
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<div class="fondo_item fondo_contenido">
					<div class="panel panel-success">
						<div class="panel-heading">
							<center><strong class="titulo_paneles">Galerias</strong></center>
						</div>
					</div>
					<?php
					$i=0;
					$galeriaBase = '';
					if (isset($galeria)) {
					 	foreach ($galeria as $g) {
					 		if ($galeriaBase <> $g->ID_GALERIA) {
					 			$galeriaBase = $g->ID_GALERIA; 
					 			?>
					 			<div class="panel panel-info">
									<div class="panel-heading">
										<h3 class="panel-title"><?php echo $g->NOMBRE_GALERIA; ?></h3>
									</div>
									<div class="panel-body">
					 					<div class="highslide-gallery">
					 			<?php
					 		}

				 			if ($galeriaBase == $g->ID_GALERIA) {?>					 			
				 					<a href="<?php echo $g->UBICACION_FOTO; ?>" class="highslide link_imagen" onclick="return hs.expand(this)">
										<img class="img-rounded img-responsive imagen" src="<?php echo  $g->UBICACION_FOTO; ?>" alt="Foto galeria"
											title="Click to enlarge" />
									</a>
									<div class="highslide-caption">
										<?php echo $g->NOM_FOTO; ?>
									</div>
				 			<?php
				 			}
				 			if (array_key_exists($i+1,$galeria)) {
				 				$r = $galeria[$i+1]->ID_GALERIA;
				 			}else{
				 				$r = 'fin';
				 			}
				 			
				 			if ( $r != $galeriaBase || $r == 'fin' ) { ?>
				 						</div>
				 					</div>
				 				</div>
							<?php 
				 			}
				 			$i++;
					 	}		
					 } 
					?>
				</div>		
			</div>

			<div class="col-md-3">
				<?php include("application/views/Aside/asideSup.php");?>
				<?php include("application/views/Aside/asideInf.php");?>
			</div>	
		</div>	
	</div>				
</section>