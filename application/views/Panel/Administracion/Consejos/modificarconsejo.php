<script type="text/javascript">
	var n_parrafo = 0;
	var pregunta = true;
	function agregar_parrafo(){
		n_parrafo++;
		if (n_parrafo <= 5) {
			document.getElementById('parrafo'+n_parrafo).className = 'parrafo';
			document.getElementById('br'+n_parrafo).className = '';
			document.getElementById('br_'+n_parrafo).className = '';
		};
	}

	function actualizar(b){
		if (b == '') {
			document.getElementById('formulario_mod').action = 'ModificarConsejo';
			document.getElementById('formulario_mod').submit();
		}else{
			document.getElementById('formulario_mod').action = 'Consejoselecionado';
			document.getElementById('formulario_mod').submit();
		};
	}

	function v_imagen(){
		if (document.getElementById('rdo_nueva').checked) {
			document.getElementById('img_nue').className = 'control-group';
		};
		if (document.getElementById('rdo_antigua').checked) {
			document.getElementById('img_nue').className = 'control-group hide';
		};
	}

	function num_parrafo(h){
		n_parrafo = h;				
	}

	function deshabilitar(a){
		if (a == 1) {
			a = 'deshabilitar';
			b = 'no';
		}else{
			a = 'habilitar';
			b = '';
		};
		if (confirm("Al realizar esta acción "+b+" se visualizara el Consejo. Si desea continuar presione ACEPTAR, si no presione CANCELAR")){
			document.getElementById('formulario_mod').action = a+"consejo";
			document.getElementById('formulario_mod').submit();
		};	
	} 

	function eliminar(){
		if (confirm("Al realizar esta acción eliminará de forma permanente el Consejo. Si desea continuar presione ACEPTAR, si no presione CANCELAR")){
			document.getElementById('formulario_mod').action = "eliminarconsejo";
			document.getElementById('formulario_mod').submit();
		};	
	}
</script>
<div class="container">
	<div class="row">
		<div class="span12">
			<div class="widget">
				<div class="widget-header"><i class="icon-bookmark"></i>
					<h3>Modificar Consejos</h3>
				</div>
				<div class="widget-content">
					<?php if(isset($error)){ ?>
						<div class="alert alert-danger"><strong><?php echo $error;?></strong></div>
					<?php } ?>
					<?php echo validation_errors('<div class="alert alert-danger"><strong>','</strong></div>');
					if (isset($datos_parrafo)) {
						$dpi = $datos_parrafo;
						foreach ($dpi as $e) {
							$dp=$e;
						}
					}
					 ?>
					
					<?php $atributos_form = array('class' => 'form-horizontal', 'name' => 'formulario_mod', 'id' => 'formulario_mod'); ?>
					<?php echo form_open_multipart('Panel/Actualizarconsejo', $atributos_form) ?>
						<div class="row">
							<div class="span5">
								<div class="control-group">
								<?php
								if (isset($consejos)) {		?>											
									<label class="control-label">Titulo de Consejo:</label>
									<div class="controls">
										<select name="consejos" onChange="actualizar(this.options[this.selectedIndex].value);">
											<?php
											if (isset($datos_parrafo)) {		?>
												<option value=''>Seleccionar</option>
												<?php
												foreach ($consejos as $c) {			?>
													<option value="<?php echo $c->ID_CONSEJO; ?>" <?php if($c->ID_CONSEJO == $idconsejo){ echo "selected";} ?>><?php echo $c->NOMBRE_CONSEJO; ?></option>
												<?php
												}
											}else{ ?>
												<option value='' selected>Selecccionar</option>
											<?php
												foreach ($consejos as $c) {		?>
													<option value="<?php echo $c->ID_CONSEJO; ?>"><?php echo $c->NOMBRE_CONSEJO; ?></option>
											<?php	
												}
											}
											?>											
										</select>
									</div> 
								<?php
								}else{ ?>
									<div class="alert">
                                      	<strong>No existen consejos.</strong>
                                    </div>
								<?php	
								}  
								?>	
								</div>
								<?php
								if (isset($datos_parrafo)) {	?>

								<div class="control-group">
									<label class="control-label">Tipo de Consejo: &nbsp;</label>
									<div class="controls">
										<label class="radio inline">
											<input type="radio" name="tp_consejo" value="Hogar" <?php if($dp->ID_TIPOCONSEJO == 1){ echo "checked";} ?>> Hogar
										</label>
										<label class="radio inline">
											<input type="radio" name="tp_consejo" value="Trabajo" <?php if($dp->ID_TIPOCONSEJO == 2){ echo "checked";} ?>> Trabajo
										</label>
										<label class="radio inline">
											<input type="radio" name="tp_consejo" value="Comunidad" <?php if($dp->ID_TIPOCONSEJO == 3){ echo "checked";} ?>> Comunidad
										</label>
									</div>
								</div>		
								<div class="control-group">											
									<label class="control-label">Modificar Titulo :</label>
									<div class="controls">
										<?php
											$titulo = array('name'=>'titulo','placeholder'=>'Máximo 45 caracteres...','maxlength'=>'45','value'=>$dp->NOMBRE_CONSEJO );
										?>
										<?php echo form_input($titulo); ?>
									</div> 
								</div>
								<div class="control-group">
									<label class="control-label">Imagen Actual</label>
									<div class="controls">
										<img class="edicion" src="<?php echo $dp->IMAGEN_UBICACION; ?>">
										<input type="hidden" name="img_crg" value="<?php echo $dp->IMAGEN_UBICACION; ?>">
										<label class="radio inline">
											<input type="radio" name="imagen" value="nueva" onchange="v_imagen();" id='rdo_nueva'> Nueva
										</label>
										<label class="radio inline">
											<input type="radio" name="imagen" value="antigua" onchange="v_imagen();" id='rdo_antigua' checked> Mantener
										</label>								
									</div>
								</div>                             
	                            <div class="control-group hide" id="img_nue">											
									<label class="control-label">Cargar Imagen</label>
	                                <div class="controls">
	    								<?php echo form_upload('userfile'); ?>
	                                </div>			
								</div>
								<?php
								}
								?>
							</div>
							<div class="span6">
								<?php
								if (isset($datos_parrafo)) {	?>
								<div class="alert alert-success">
									<strong><center>Ingresar contenido introductorio del consejo</center></strong>
								</div>
								<textarea name="parrafo_introduccion" placeholder="Máximo 100 caracteres..." maxlength="100" rows="3" class="parrafo"><?php echo $dp->DESC_CONSEJO; ?></textarea>
								<br>
								<br>
								<div class="alert alert-success">
									<strong><center>Contenido del consejo</center></strong>
								</div>
								<?php
								$i = 0;
								foreach ($datos_parrafo as $dat) {	
									if ($i == 0) {
											$name = 'parrafo'; 
										}else{
											$name = 'parrafo'.$i;
										}	?>
									<textarea name="<?php echo $name;?>" placeholder="Máximo 65.500 caracteres..." maxlength="65500" rows="4" class="parrafo"><?php echo $dat->CONTENIDO_PARRAFO; ?></textarea>
									<input type="hidden" name="id<?php echo $name; ?>" value="<?php echo $dat->ID_PARRAFO; ?>">
									<?php 
									if (array_key_exists($i+1, $datos_parrafo)) {  ?>
										<br><br>
										<?php	
									}else{ 		?>
										<br>
	                            		<a class="btn btn-mini" onClick="agregar_parrafo();" <?php if($i==5){ echo 'disabled';} ?> ><i class="icon-plus"></i> </a>
							<?php	}
								$i++;
								}
								if ($i<5) { 
									$i2 = $i;
									while ($i2 < 5) {			?>
											<textarea name="parrafo<?php echo $i2; ?>" id="parrafo<?php echo $i2; ?>" placeholder="Máximo 65.500 caracteres..." maxlength="65500" rows="4" class="parrafo hide"></textarea>
											<br class="hide" id="br<?php echo $i2; ?>"><br class="hide" id="br_<?php echo $i2; ?>">
											<?php
											$i2++;
										}
								}
								$i = $i - 1;
								echo '<script type="text/javascript"> num_parrafo('.$i.');</script>';
	                        }
	                        	?>
	                        </div>								
						</div>						
							<br>
							<?php
								if (isset($datos_parrafo)) {	?>
							<div>
								<center>
									<button type="submit" class="btn btn-primary">Guardar</button> 
									<button type="button" class="btn btn-warning"
									<?php if ($dp->ESTADO_CONSEJO == '0') {
											echo "onclick='deshabilitar(0);'>Habilitar";
									}else{
											echo "onclick='deshabilitar(1);'>Deshabilitar";
									} ?></button>
									<button type="button" class="btn btn-danger" onclick="eliminar();">Eliminar</button> 
									<button type="button" class="btn" onClick="location.href='<?php echo base_url(); ?>Panel'">Cancelar</button>
								</center>
							</div> 
							<?php
							}
							?>
					<?php echo form_close() ?>
				</div>
			</div>
		</div>
	</div>
</div>