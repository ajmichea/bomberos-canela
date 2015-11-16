<div class="prevencion">
    <h4 class="titulo_prevencion">PREVENCIÓN Y SEGURIDAD</h4>
	<ul class="nav nav-tabs pestañas" role="tablist">
        <li id="pest1" class="active"><a onclick="consejo('1');">Hogar</a></li>
        <li id="pest2"><a onclick="consejo('2');">Trabajo</a></li>
        <li id="pest3"><a onclick="consejo('3');">Comunidad</a></li>
    </ul>
	<div class="borde" id="consejoCasa">
		<?php 
		$i=0;
		if (isset($conhogar)) {
			$tipo = 'Hogar_';
			foreach ($conhogar as $ch) {
				if ($i<3) {
					if (array_key_exists($i+1, $conhogar)) {
						echo '<div class="consejo">';
					}else{
						echo '<div class="consejo2">';
					}
					?>
						<a href="<?php echo base_url();?>Home/Prevencion/<?php echo $tipo.$ch->ID_CONSEJO; ?>" class="link_cons">
							<img class="img-consejos img-responsive"src="<?php echo $ch->IMAGEN_UBICACION; ?>" alt="imagen prevencion y seguridad">	
							<div class="bloque">
								<h3 class="consejo"><?php echo $ch->NOMBRE_CONSEJO; ?></h3>
								<p><?php echo $ch->DESC_CONSEJO; ?></p>                    	
							</div>
						</a>
					</div>
					<?php
					$i++;
				}
			}
		}
		?>					
	</div>
	<div class="borde hide" id="consejoTrabajo">
		<?php 
		$i=0;
		if (isset($contrabajo)) {
			$tipo = 'Trabajo_';
			foreach ($contrabajo as $ct) {
				if ($i<3) {
					if (array_key_exists($i+1, $contrabajo)) {
						echo '<div class="consejo">';
					}else{
						echo '<div class="consejo2">';
					}
					?>
						<a href="<?php echo base_url();?>Home/Prevencion/<?php echo $tipo.$ct->ID_CONSEJO; ?>" class="link_cons">
							<img class="img-consejos img-responsive"src="<?php echo $ct->IMAGEN_UBICACION; ?>" alt="imagen prevencion y seguridad">	
							<div class="bloque">
								<h3 class="consejo"><?php echo $ct->NOMBRE_CONSEJO; ?></h3>
								<p><?php echo $ct->DESC_CONSEJO; ?></p>                    	
							</div>
						</a>
					</div>
					<?php
					$i++;
				}
			}
		}
		?>						
	</div>
	<div class="borde hide" id="consejoComunidad">
		<?php 
		$i=0;
		if (isset($concomunidad)) {
			$tipo = 'Comunidad_';
			foreach ($concomunidad as $cc) {
				if ($i<3) {
					if (array_key_exists($i+1, $concomunidad)) {
						echo '<div class="consejo">';
					}else{
						echo '<div class="consejo2">';
					}
					?>
						<a href="<?php echo base_url();?>Home/Prevencion/<?php echo $tipo.$cc->ID_CONSEJO; ?>" class="link_cons">
							<img class="img-consejos img-responsive"src="<?php echo $cc->IMAGEN_UBICACION; ?>" alt="imagen prevencion y seguridad">	
							<div class="bloque">
								<h3 class="consejo"><?php echo $cc->NOMBRE_CONSEJO; ?></h3>
								<p><?php echo $cc->DESC_CONSEJO; ?></p>                    	
							</div>
						</a>
					</div>
					<?php
					$i++;
				}
			}
		}
		?>			
	</div>    
	<br>   
</div>