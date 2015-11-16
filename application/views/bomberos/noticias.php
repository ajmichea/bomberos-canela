<section>
    <div class="container">
		<div class="row">
			<div class="col-md-9">
				<?php
				if (isset($noticia)) {
					$i=0;	?>
					<div class="fondo_item fondo_contenido ">
						<p class="historia" >
					<?php
					foreach ($noticia as $nt) {
						$idnoticia = $nt->ID_PUBLICACION;
						if ($i == 0) {	?>
							<br>
							<img class="img-responsive img-rounded m_l pull-left img-noticia" src="<?php echo $nt->FOTO_PUBLICACIONINICIAL;?>"><h3 class="t_himno"><?php echo $nt->NOMBRE_PUBLICACION; ?></h3>
							<p class="m_r">
								<?php echo $nt->CONTENIDO; ?>
							</p>
						<?php
						}else{	?>
							<p class="m_r">
								<?php echo $nt->CONTENIDO; ?>
							</p>
						<?php
						}
					    $i++;
					}	?>
						</p>
					</div>
					<?php					
				}else{
					if (isset($noticiasFull)) {
						$noticiasFull2 = $noticiasFull;
						$i=0;	?>
						<div class="fondo_item fondo_contenido ">
							<p class="historia" >
						<?php
						foreach ($noticiasFull2 as $nf2) {
							if ($i == 0) {	?>
								<br>
								<img class="img-responsive img-rounded m_l pull-left img-noticia" src="<?php echo $nf2->FOTO_PUBLICACIONINICIAL;?>"><h3 class="t_himno"><?php echo $nf2->NOMBRE_PUBLICACION; ?></h3>
								<p class="m_r">
									<?php echo $nf2->CONTENIDO; ?>
								</p>
							<?php
								$idnoticia = $nf2->ID_PUBLICACION;
								$i++;
							}
							if (isset($idnoticia)) {
								if ($idnoticia == $nf2->ID_PUBLICACION) {	?>
									<p class="m_r">
										<?php echo $nf2->CONTENIDO; ?>
									</p>
								<?php
								}
							}				
						}	?>
							</p>
						</div>
						<?php					
					}
				}
				?>
						
			</div>
			<div class="col-md-3">
				<?php include("application/views/Aside/asideSup.php"); ?><a name="prevencion" id="prevencion"></a>
			</div>				
		</div> 
		
		<div class="row">
			<div class="col-md-9">
				<?php
				if (isset($noticiasFull)) {
					$i=0;	?>
					<div class="fondo_item fondo_contenido ">
						<p class="historia" >
					<?php
					foreach ($noticiasFull as $nf) {
						if ($i == 0 && $idnoticia != $nf->ID_PUBLICACION) {	?>
							<br>
							<img class="img-responsive img-rounded m_l pull-left img-noticia" src="<?php echo $nf->FOTO_PUBLICACIONINICIAL;?>"><h3 class="t_himno"><?php echo $nf->NOMBRE_PUBLICACION; ?></h3>
							<p class="m_r">
								<?php echo $nf->CONTENIDO; ?>
							</p>
						<?php
							$idnoticia2 = $nf->ID_PUBLICACION;
							$i++;
						}
						if (isset($idnoticia2)) {
							if ($idnoticia2 == $nf->ID_PUBLICACION) {	?>
								<p class="m_r">
									<?php echo $nf->CONTENIDO; ?>
								</p>
							<?php
							}
						}				
					}	?>
						</p>
					</div>
					<?php					
				}
				?>	
			</div>							
			<div class="col-md-3">
				<?php include("application/views/Aside/asideInf.php"); ?>
			</div>				
		</div>

			<?php
			if (isset($noticias)) {
				$i = 0;
				$i2 = 0;
				?>
				<div class="row">
				<?php
				foreach ($noticias as $n) {
					if ($i2 < 4 && $n->ID_PUBLICACION != $idnoticia && $n->ID_PUBLICACION != $idnoticia2) {	?>
						<div class="col-md-3">
							<div class="fondo_item">
								<img class="img-circle fondo_item" src="<?php echo $n->FOTO_PUBLICACIONINICIAL; ?>" alt="Generic placeholder image" width="140" height="140">
					      		<h2 class="fondo_item"><?php echo $n->NOMBRE_PUBLICACION; ?></h2>
					      		<p class="fondo_item"><?php echo $n->DESCRIPCION_PUBLICACION; ?></p>
					      		<p class="fondo_item"><a class="btn btn-default fondo_item" href="<?php echo base_url();?>Home/Noticias/<?php echo $n->ID_PUBLICACION; ?>" role="button">ver más... »</a></p>
							</div>
						</div>
					<?php
					}else{
						$i2--;
					}
					if (!array_key_exists($i+1, $noticias)) {
						echo "</div>";
					}
					if ($i2 == 3) {
						echo "</div>";
						if(array_key_exists($i+1,$noticias)){
							echo "<div class='row'-->";
							$i2= 0-1;
						}
					}
					$i++;
					$i2++;
				}
			}
			?>					
		</div>
	</div>
</section>