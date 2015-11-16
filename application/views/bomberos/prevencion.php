
<section>
	<?php
	if (isset($peticion)) {
		$tipoSol = $peticion['tipo'];
		$aviso = $peticion['identificador'];
	}
	?>
    <div class="container">
		<div class="row">
			<div class="col-md-9">
				<div class="fondo_item fondo_contenido">
					<ul class="nav nav-tabs">
					  <li role="presentation" class="active"><a href="#Hogar" data-toggle="tab">Hogar</a></li>
					  <li role="presentation"><a href="#Trabajo"  data-toggle="tab">Trabajo</a></li>
					  <li role="presentation"><a href="#Comunidad" data-toggle="tab">Comunidad</a></li>
					</ul>
					<div class="tab-content prevencion_contenido">
						<div class="tab-pane <?php if (isset($peticion)) {
														if ($tipoSol == 'Hogar') {
															echo 'active';
														}
													}else{ ?>
														active <?php } ?>" id="Hogar">
							<?php
							if (isset($peticion)) {
								if ($tipoSol == 'Hogar') {
									$conhogarfull2 = $conhogarfull;
									$i = 0;
									$idconhogarfull2 = '';
								 	foreach ($conhogarfull2 as $chf2) {
								 		if ($aviso == $chf2->ID_CONSEJO) {
								 			if ($idconhogarfull2 <> $chf2->ID_CONSEJO) {	
									 			$idconhogarfull2 = $chf2->ID_CONSEJO;	?>
									 			<div class="prev_contenido" id="conHogar<?php echo $idconhogarfull2; ?>">
									 			<br>
												<h3 class="t_himno"><?php echo $chf2->NOMBRE_CONSEJO; ?></h3><img class="img-responsive img-rounded m_r m_l pull-right img-noticia" src="<?php echo $chf2->IMAGEN_UBICACION;?>">
									 		<?php
									 		}
									 		if ($idconhogarfull2 == $chf2->ID_CONSEJO) { ?>
									 			 <p class="m_r m_l">
													&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $chf2->CONTENIDO_PARRAFO; ?>
												</p>	
											<?php
									 		}
									 		if (array_key_exists($i+1, $conhogarfull2)) {
									 			if ($conhogarfull2[$i+1]->ID_CONSEJO != $idconhogarfull2) {
									 				echo "</div>";
									 			}
									 		}else{
									 			echo "</div>";
									 		}		

								 		}	
									    $i++;
									}
								}
								if (isset($conhogarfull)) {
									$i = 0;
									$idconhogarfull = '';
								 	foreach ($conhogarfull as $chf) {
								 		if ($aviso <> $chf->ID_CONSEJO) {		
									 		if ($idconhogarfull <> $chf->ID_CONSEJO) {	
									 			$idconhogarfull = $chf->ID_CONSEJO;	?>
									 			<div class="prev_contenido" id="conHogar<?php echo $idconhogarfull; ?>">
									 			<br>
												<h3 class="t_himno"><?php echo $chf->NOMBRE_CONSEJO; ?></h3><img class="img-responsive img-rounded m_r m_l pull-right img-noticia" src="<?php echo $chf->IMAGEN_UBICACION;?>">
									 		<?php
									 		}
									 		if ($idconhogarfull == $chf->ID_CONSEJO) { ?>
									 			 <p class="m_r m_l">
													&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $chf->CONTENIDO_PARRAFO; ?>
												</p>	
											<?php
									 		}
									 		if (array_key_exists($i+1, $conhogarfull)) {
									 			if ($conhogarfull[$i+1]->ID_CONSEJO != $idconhogarfull) {
									 				echo "</div>";
									 			}
									 		}else{
									 			echo "</div>";
									 		}

								 		}
								    	$i++;
									}	
								}
								
							}else{
								if (isset($conhogarfull)) {
									$i = 0;
									$idconhogarfull = '';
								 	foreach ($conhogarfull as $chf) {		
								 		if ($idconhogarfull <> $chf->ID_CONSEJO) {	
								 			$idconhogarfull = $chf->ID_CONSEJO;	?>
								 			<div class="prev_contenido" id="conHogar<?php echo $idconhogarfull; ?>">
								 			<br>
											<h3 class="t_himno"><?php echo $chf->NOMBRE_CONSEJO; ?></h3><img class="img-responsive img-rounded m_r m_l pull-right img-noticia" src="<?php echo $chf->IMAGEN_UBICACION;?>">
								 		<?php
								 		}
								 		if ($idconhogarfull == $chf->ID_CONSEJO) { ?>
								 			 <p class="m_r m_l">
												&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $chf->CONTENIDO_PARRAFO; ?>
											</p>	
										<?php
								 		}
								 		if (array_key_exists($i+1, $conhogarfull)) {
								 			if ($conhogarfull[$i+1]->ID_CONSEJO != $idconhogarfull) {
								 				echo "</div>";
								 			}
								 		}else{
								 			echo "</div>";
								 		}
								    	$i++;
									}	
								}
							} 
							?>
						</div>
						<div class="tab-pane <?php if (isset($peticion)) {
														if ($tipoSol == 'Trabajo') {
															echo 'active';
														}
													} ?>" id="Trabajo">
							<?php
							if (isset($peticion)) {
								if ($tipoSol == 'Trabajo') {
									$contrabajofull2 = $contrabajofull;
									$i = 0;
									$idcontrabajofull2 = '';
								 	foreach ($contrabajofull2 as $ctf2) {
								 		if ($aviso == $ctf2->ID_CONSEJO) {
								 			if ($idcontrabajofull2 <> $ctf2->ID_CONSEJO) {	
									 			$idcontrabajofull2 = $ctf2->ID_CONSEJO;	?>
									 			<div class="prev_contenido" id="conHogar<?php echo $idcontrabajofull2; ?>">
									 			<br>
												<h3 class="t_himno"><?php echo $ctf2->NOMBRE_CONSEJO; ?></h3><img class="img-responsive img-rounded m_r m_l pull-right img-noticia" src="<?php echo $ctf2->IMAGEN_UBICACION;?>">
									 		<?php
									 		}
									 		if ($idcontrabajofull2 == $ctf2->ID_CONSEJO) { ?>
									 			 <p class="m_r m_l">
													&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $ctf2->CONTENIDO_PARRAFO; ?>
												</p>	
											<?php
									 		}
									 		if (array_key_exists($i+1, $contrabajofull2)) {
									 			if ($contrabajofull2[$i+1]->ID_CONSEJO != $idcontrabajofull2) {
									 				echo "</div>";
									 			}
									 		}else{
									 			echo "</div>";
									 		}		

								 		}	
									    $i++;
									}
								}
								if (isset($contrabajofull)) {
									$i = 0;
									$idcontrabajofull = '';
								 	foreach ($contrabajofull as $ctf) {
								 		if ($aviso <> $ctf->ID_CONSEJO) {		
									 		if ($idcontrabajofull <> $ctf->ID_CONSEJO) {	
									 			$idcontrabajofull = $ctf->ID_CONSEJO;	?>
									 			<div class="prev_contenido" id="conHogar<?php echo $idcontrabajofull; ?>">
									 			<br>
												<h3 class="t_himno"><?php echo $ctf->NOMBRE_CONSEJO; ?></h3><img class="img-responsive img-rounded m_r m_l pull-right img-noticia" src="<?php echo $ctf->IMAGEN_UBICACION;?>">
									 		<?php
									 		}
									 		if ($idcontrabajofull == $ctf->ID_CONSEJO) { ?>
									 			 <p class="m_r m_l">
													&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $ctf->CONTENIDO_PARRAFO; ?>
												</p>	
											<?php
									 		}
									 		if (array_key_exists($i+1, $contrabajofull)) {
									 			if ($contrabajofull[$i+1]->ID_CONSEJO != $idcontrabajofull) {
									 				echo "</div>";
									 			}
									 		}else{
									 			echo "</div>";
									 		}

								 		}
								    	$i++;
									}	
								}
								
							}else{
								if (isset($contrabajofull)) {
								 	$i = 0;
									$idcontrabajofull = '';
								 	foreach ($contrabajofull as $ctf) {		
								 		if ($idcontrabajofull <> $ctf->ID_CONSEJO) {	
								 			$idcontrabajofull = $ctf->ID_CONSEJO;	?>
								 			<div class="prev_contenido" id="conTrabajo<?php echo $idcontrabajofull; ?>">
								 			<br>
											<h3 class="t_himno"><?php echo $ctf->NOMBRE_CONSEJO; ?></h3><img class="img-responsive img-rounded m_l pull-right img-noticia" src="<?php echo $ctf->IMAGEN_UBICACION;?>">
								 		<?php
								 		}
								 		if ($idcontrabajofull == $ctf->ID_CONSEJO) { ?>
								 			 <p class="m_r m_l">
												&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $ctf->CONTENIDO_PARRAFO; ?>
											</p>	
										<?php
								 		}
								 		if (array_key_exists($i+1, $contrabajofull)) {
								 			if ($contrabajofull[$i+1]->ID_CONSEJO != $idcontrabajofull) {
								 				echo "</div>";
								 			}
								 		}else{
								 			echo "</div>";
								 		}
								    	$i++;
									}
								}
							} 
							?>
						</div>
						<div class="tab-pane <?php if (isset($peticion)) {
														if ($tipoSol == 'Comunidad') {
															echo 'active';
														}
													} ?>" id="Comunidad">
							<?php
							if (isset($peticion)) {
								if ($tipoSol == 'Comunidad') {
									$concomunidadfull2 = $concomunidadfull;
									$i = 0;
									$idconcomunidadfull2 = '';
								 	foreach ($concomunidadfull2 as $ccf2) {
								 		if ($aviso == $ccf2->ID_CONSEJO) {
								 			if ($idconcomunidadfull2 <> $ccf2->ID_CONSEJO) {	
									 			$idconcomunidadfull2 = $ccf2->ID_CONSEJO;	?>
									 			<div class="prev_contenido" id="conHogar<?php echo $idconcomunidadfull2; ?>">
									 			<br>
												<h3 class="t_himno"><?php echo $ccf2->NOMBRE_CONSEJO; ?></h3><img class="img-responsive img-rounded m_r m_l pull-right img-noticia" src="<?php echo $ccf2->IMAGEN_UBICACION;?>">
									 		<?php
									 		}
									 		if ($idconcomunidadfull2 == $ccf2->ID_CONSEJO) { ?>
									 			 <p class="m_r m_l">
													&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $ccf2->CONTENIDO_PARRAFO; ?>
												</p>	
											<?php
									 		}
									 		if (array_key_exists($i+1, $concomunidadfull2)) {
									 			if ($concomunidadfull2[$i+1]->ID_CONSEJO != $idconcomunidadfull2) {
									 				echo "</div>";
									 			}
									 		}else{
									 			echo "</div>";
									 		}		

								 		}	
									    $i++;
									}
								}
								if (isset($concomunidadfull)) {
									$i = 0;
									$idconcomunidadfull = '';
								 	foreach ($concomunidadfull as $ccf) {
								 		if ($aviso <> $ccf->ID_CONSEJO) {		
									 		if ($idconcomunidadfull <> $ccf->ID_CONSEJO) {	
									 			$idconcomunidadfull = $ccf->ID_CONSEJO;	?>
									 			<div class="prev_contenido" id="conHogar<?php echo $idconcomunidadfull; ?>">
									 			<br>
												<h3 class="t_himno"><?php echo $ccf->NOMBRE_CONSEJO; ?></h3><img class="img-responsive img-rounded m_r m_l pull-right img-noticia" src="<?php echo $ccf->IMAGEN_UBICACION;?>">
									 		<?php
									 		}
									 		if ($idconcomunidadfull == $ccf->ID_CONSEJO) { ?>
									 			 <p class="m_r m_l">
													&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $ccf->CONTENIDO_PARRAFO; ?>
												</p>	
											<?php
									 		}
									 		if (array_key_exists($i+1, $concomunidadfull)) {
									 			if ($concomunidadfull[$i+1]->ID_CONSEJO != $idconcomunidadfull) {
									 				echo "</div>";
									 			}
									 		}else{
									 			echo "</div>";
									 		}

								 		}
								    	$i++;
									}	
								}
								
							}else{
								if (isset($concomunidadfull)) {
								 	$i = 0;
									$idconcomunidadfull = '';
								 	foreach ($concomunidadfull as $ccf) {		
								 		if ($idconcomunidadfull <> $ccf->ID_CONSEJO) {	
								 			$idconcomunidadfull = $ccf->ID_CONSEJO;	?>
								 			<div class="prev_contenido" id="conComunidad<?php echo $idconcomunidadfull; ?>">
								 			<br>
											<h3 class="t_himno"><?php echo $ccf->NOMBRE_CONSEJO; ?></h3><img class="img-responsive img-rounded m_l pull-right img-noticia" src="<?php echo $ccf->IMAGEN_UBICACION;?>">
								 		<?php
								 		}
								 		if ($idconcomunidadfull == $ccf->ID_CONSEJO) { ?>
								 			 <p class="m_r m_l">
												&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $ccf->CONTENIDO_PARRAFO; ?>
											</p>	
										<?php
								 		}
								 		if (array_key_exists($i+1, $concomunidadfull)) {
								 			if ($concomunidadfull[$i+1]->ID_CONSEJO != $idconcomunidadfull) {
								 				echo "</div>";
								 			}
								 		}else{
								 			echo "</div>";
								 		}
								    	$i++;
									}
								} 
							}
							?>
						</div>
					</div>
				</div>	
			</div>
			<div class="col-md-3">
				<?php include("application/views/Aside/asideSup.php"); ?><a name="prevencion" id="prevencion"></a>
				<?php include("application/views/Aside/asideInf.php"); ?>
			</div>				
		</div> 				
	</div>
</section>
