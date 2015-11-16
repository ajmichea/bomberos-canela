<script type="text/javascript">
	var idg = <?php if(isset($id_galeria)){ echo $id_galeria; }else{ echo '0';} ?>;
	function actualizar(idgaleria,estgaleria){

		if (idgaleria == '') {
			document.getElementById('seleccionradio').className = 'control-group hide';
			document.getElementById('cargarImagen').className = 'control-group hide';
			document.getElementById('btncargar').className = 'control-group hide';
			document.getElementById('seleccionImagen').className = 'control-group hide';
			document.getElementById('seleccionImagenDs').className = 'control-group hide';
			document.getElementById('enviar').className = 'form-actions hide';
			idg = idgaleria;
			document.getElementById('id_g').value = idg;
		}else{
			<?php
			if (isset($id_galeria)) {
				if ($est_galeria == '1') {
					echo "document.getElementById('rdoDG').checked = false;\n";
				}else{
					echo "document.getElementById('rdoAG').checked = false;\n";
				};
				echo "document.getElementById('rdoBG').checked = false;\n";
				echo "document.getElementById('rdoNI').checked = false;\n";
				echo "document.getElementById('rdoDI').checked = false;\n";
				echo "document.getElementById('rdoBI').checked = false;\n";
				echo "document.getElementById('rdoAI').checked = false;\n";
			};
			?>
			document.getElementById('estgaleria').value = estgaleria;
			idg = idgaleria;
			document.getElementById('formulario_mod').action = '<?php echo base_url();?>Panel/cargardivImg';
			document.getElementById('formulario_mod').submit();
		};
	}

	function activarbtn(){
		document.getElementById('btnenviar').disabled = false;
		document.getElementById('cargarImagen').className = 'control-group hide';
		document.getElementById('btncargar').className = 'control-group hide';
		document.getElementById('seleccionImagenDs').className = 'control-group hide';
		document.getElementById('seleccionImagen').className = 'control-group hide';
	}

	function activarbtn2(){
		document.getElementById('btnenviar').disabled = false;
	}

	function desactivarbtn(){
		document.getElementById('btnenviar').disabled = true;
	}

	function formulario(){
		document.getElementById('cargarImagen').className = 'control-group';
		document.getElementById('btncargar').className = 'control-group';
		document.getElementById('seleccionImagenDs').className = 'control-group hide';
		document.getElementById('seleccionImagen').className = 'control-group hide';
	}

	function cimagenes(){
		document.getElementById('cargarImagen').className = 'control-group hide';
		document.getElementById('btncargar').className = 'control-group hide';
		document.getElementById('seleccionImagenDs').className = 'control-group hide';
		document.getElementById('seleccionImagen').className = 'control-group';
	}

	function cimagenesDs(){
		document.getElementById('cargarImagen').className = 'control-group hide';
		document.getElementById('btncargar').className = 'control-group hide';
		document.getElementById('titulo2').className = 'alert alert-success';
		document.getElementById('seleccionImagen').className = 'control-group hide';
		document.getElementById('seleccionImagenDs').className = 'control-group';
	}

	function bimagenes(){
		document.getElementById('cargarImagen').className = 'control-group hide';
		document.getElementById('btncargar').className = 'control-group hide';
		document.getElementById('titulo2').className = 'alert alert-success hide';
		document.getElementById('seleccionImagenDs').className = 'control-group';
		document.getElementById('seleccionImagen').className = 'control-group';
	}

	var num=1;

	function agregarcargaImg(){

		if (num<=6) {
			
			document.getElementById('imagen'+num).className = 'control-group';
			
			var nuevo = document.getElementById('imagen'+num)
			
			var contenidolabel = document.createElement('label');
			contenidolabel.className = 'control-label';
			contenidolabel.innerHTML = 'Cargar Fotografía';

			var contenidodiv = document.createElement('div');
			contenidodiv.className = 'controls';

			var archivo = document.createElement('input');
			archivo.type = 'file';
			archivo.name = 'userfile'+num;

			contenidodiv.appendChild(archivo);
			nuevo.appendChild(contenidolabel);
			nuevo.appendChild(contenidodiv);
			document.getElementById('cont').value = num;
			num++			
		};
	}

	function enviarmensaje(b){
		
		if (b == 1) {
			var nuevo = document.getElementById('mensaje1');
		}else{
			var nuevo = document.getElementById('mensaje2');
		};		

		var contdiv = document.createElement('div');
		contdiv.className = 'alert alert-danger';

		var negrita = document.createElement('strong');
		var centro = document.createElement('center');
		if (b == 1) {
			centro.innerHTML = 'No existen imágenes habilitadas en la galería seleccionada.';
		}else{
			centro.innerHTML = 'No existen imágenes deshabilitadas en la galería seleccionada.';
		};

		negrita.appendChild(centro);
		contdiv.appendChild(negrita);
		nuevo.appendChild(contdiv);
	}
</script>
<div class="container">
	<div class="row">
		<div class="span12">
			<div class="widget">
				<div class="widget-header"><i class="icon-camera"></i>
					<h3>Actualización de Galeria</h3>
				</div>
				<div class="widget-content">
					<?php
					if (isset($error)) { ?>
						<div class="alert alert-danger">
							<strong><?php echo $error; ?></strong>
						</div>
					<?php }	
					if (isset($exito)) { ?>
						<div class="alert alert-success">
							<strong><?php echo $exito; ?></strong>
						</div>
					<?php }
					?>
					<?php echo validation_errors('<div class="alert alert-danger"><strong>','</strong></div>') ?>
					<?php $atributos_form = array('class' => 'form-horizontal', 'name' => 'formulario_mod', 'id' => 'formulario_mod'); ?>
					<?php echo form_open_multipart('Panel/cargardivImg', $atributos_form) ?>
						<div class="row">
							<div class="span4">							
								<div class="control-group">											
									<label class="control-label" for="firstname">Seleccione Galeria</label>
									<div class="controls">
										<select name="galerias" onChange="actualizar(this.options[this.selectedIndex].value,this.options[this.selectedIndex].id);">
											<?php if (isset($id_galeria)) { ?>
												<option value='' <?php if ($id_galeria == '') { echo "selected";} ?>>Seleccionar</option>
												<?php
													foreach ($combo as $c) {
														?><option value="<?php echo $c->ID_GALERIA; ?>" id="<?php echo $c->ESTADO_GALERIA; ?>" <?php if ($id_galeria == $c->ID_GALERIA) { echo "selected";} ?>><?php echo $c->NOMBRE_GALERIA ?></option>
													<?php } 
												}else{ ?>
													<option value='' selected>Seleccionar</option>
													<?php
													foreach ($combo as $c) {
														?><option value="<?php echo $c->ID_GALERIA;?>" id="<?php echo $c->ESTADO_GALERIA; ?>"><?php echo $c->NOMBRE_GALERIA ?></option>
												<?php }} ?>
										</select>
									</div> 
								</div>

								<div class="control-group <?php if(!isset($id_galeria)){ ?> hide <?php } ?>" id="seleccionradio">											
									<label class="control-label">Seleccione Acción</label>
								    <div class="controls">
									    <?php
									    if (isset($est_galeria)) {
									    	if ($est_galeria == '1') {   ?>
										    	<label class="radio">
			                                        <input type="radio" name="radiobtns" id="rdoDG" value="rdoDG" onclick="activarbtn();"> Desabilitar Galeria
			                                    </label>
			                                <?php
										    }else{
										    ?>
										    	<label class="radio">
			                                        <input type="radio" name="radiobtns" id="rdoAG" value="rdoAG" onclick="activarbtn();"> Habilitar Galeria
			                                    </label>
			                                <?php
										    }
									    }										    
									    ?>
										<label class="radio">
	                                        <input type="radio" name="radiobtns" id="rdoBG" value="rdoBG" onclick="activarbtn();"> Borrar Galeria
	                                    </label>
	                                    <label class="radio">
	                                        <input type="radio" name="radiobtns" id="rdoNI" value="rdoNI" onclick="desactivarbtn(); formulario();"> Nueva Imagen
	                                    </label>        
	                                    <label class="radio">
	                                        <input type="radio" name="radiobtns" id="rdoDI" value="rdoDI" onclick="desactivarbtn(); cimagenes();"> Desabilitar Imagen
	                                    </label>
	                                    <label class="radio">
	                                        <input type="radio" name="radiobtns" id="rdoAI" value="rdoAI" onclick="desactivarbtn(); cimagenesDs();"> Habilitar Imagen
	                                    </label>
	                                    <label class="radio">
	                                        <input type="radio" name="radiobtns" id="rdoBI" value="rdoBI" onclick="desactivarbtn(); bimagenes();"> Borrar Imagen
	                                    </label>
		                            </div>			
								</div>
							</div>
							<div class="span7">
									<div class="control-group hide" id="seleccionImagen">
										<div class="alert alert-success">
									        <strong><center>Seleccione Imagenes</center></strong>
									     </div>
									     <div id="mensaje1"></div>
										<div class="shortcuts">
											<?php
											$alerta1=0;
											$cb = 1;
											$imagenesDs = $imagenes;
											foreach ($imagenes as $i) { 
												if ($i->ESTADO_FOTO == '1') {
													$alerta1++;  ?>
													<div class="shortcut">
														<img class="edicion" src="<?php echo $i->UBICACION_FOTO ?>"  >
														<label class="lbl"><?php echo $i->NOM_FOTO ?>&nbsp;&nbsp;<input type="checkbox" name="box<?php echo $cb; ?>" Value="<?php echo $i->ID_FOTO ?>" onchange="activarbtn2();"></label>	
													</div>
													<input type="hidden" name="fotobox<?php echo $cb; ?>" value="<?php echo $i->UBICACION_FOTO ?>">
											<?php	
												}	
											 $cb++; 
											} ?>													 
										</div>
									</div>
									<div class="control-group hide" id="seleccionImagenDs">
										<div class="alert alert-success" id="titulo2">
									        <strong><center>Seleccione Imagenes</center></strong>
									     </div>
									     <div id="mensaje2"></div>
										<div class="shortcuts">
											<?php
											$alerta2 = 0;
											$cbDs = 1;
											foreach ($imagenesDs as $iDs) { 
											    if ($iDs->ESTADO_FOTO == '0') { 
											    	$alerta2++; ?>
											    	<div class="shortcut">
														<img class="edicion" src="<?php echo $iDs->UBICACION_FOTO ?>"  >
														<label class="lbl"><?php echo $iDs->NOM_FOTO ?>&nbsp;&nbsp;<input type="checkbox" name="boxDs<?php echo $cbDs; ?>" Value="<?php echo $iDs->ID_FOTO ?>" onchange="activarbtn2();"></label>	
													</div>
													<input type="hidden" name="fotoboxDs<?php echo $cbDs; ?>" value="<?php echo $iDs->UBICACION_FOTO ?>">
											<?php	
												}														
											 $cbDs++;											 
											} ?>													 
										</div>
									</div>

									<div class="control-group hide" id="cargarImagen">											
										<label class="control-label" for="radiobtns">Cargar Fotografía</label>
		                                <div class="controls">
		    								<?php echo form_upload('userfile" onchange="activarbtn2()') ?>
		                                </div>			
									</div>
									<div class="control-group hide" id="imagen1"></div>
									<div class="control-group hide" id="imagen2"></div>
									<div class="control-group hide" id="imagen3"></div>
									<div class="control-group hide" id="imagen4"></div>
									<div class="control-group hide" id="imagen5"></div>
									<div class="control-group hide" id="imagen6"></div>
		                            <div class="control-group hide" id="btncargar">					
		                                <div class="controls">
		                                    <a class="btn btn-mini" onClick="agregarcargaImg();"><i class="icon-plus"></i> </a>
		                                </div>			
									</div> 
									<br>
							</div>
						</div>	
						<div class="form-actions <?php if(!isset($id_galeria)){ ?> hide <?php } ?>" id="enviar">
							<center>
								<button type="submit" class="btn btn-primary" id="btnenviar" disabled>Guardar</button> 
								<button type="button" class="btn" onClick="location.href='<?php echo base_url(); ?>Panel'">Cancelar</button>
							</center>
						</div> 	
						<input type="hidden" name="idgaleria" id="id_g" <?php if(isset($id_galeria)){ echo 'value="'.$id_galeria.'"'; } ?>;>
						<input type="hidden" name="estgaleria" <?php if(isset($id_galeria)){ echo 'value="'.$est_galeria.'"'; } ?>; id="estgaleria">
						<input type="hidden" name="totalbox" value="<?php echo $cb; ?>">
						<input type="hidden" name="totalboxDs" value="<?php echo $cbDs; ?>">
						<input type="hidden" name="cont" value="0" id="cont">
					<?php echo form_close() ?>
					<?php
					if ($alerta1 == 0) { 
						echo '<script type="text/javascript">enviarmensaje("1");</script>';
					}
					if ($alerta2 == 0) { 
						echo '<script type="text/javascript">enviarmensaje("2");</script>';
					} ?>
				</div>
			</div>
		</div>
	</div>
</div>