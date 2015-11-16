<script type="text/javascript">
	function actualizar(b){
		document.getElementById('formulario_mod').action = 'ModificarBanner';
		document.getElementById('formulario_mod').submit();
	}

	function ver(){
		if (document.getElementById('checkbox').checked) {
			document.getElementById('seleccion').className = 'control-group'
		}else{
			document.getElementById('seleccion').className = 'control-group hide'
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

	function deshabilitar(a){
		if (a == 1) {
			a = 'deshabilitar';
			b = 'no';
		}else{
			a = 'habilitar';
			b = '';
		};
		if (confirm("Al realizar esta acción "+b+" se visualizara el Banner. Si desea continuar presione ACEPTAR, si no presione CANCELAR")){
			document.getElementById('formulario_mod').action = a+"banner";
			document.getElementById('formulario_mod').submit();
		};	
	} 

	function eliminar(){
		if (confirm("Al realizar esta acción eliminará de forma permanente de el Banner. Si desea continuar presione ACEPTAR, si no presione CANCELAR")){
			document.getElementById('formulario_mod').action = "eliminarbanner";
			document.getElementById('formulario_mod').submit();
		};	
	}
</script>

<div class="container">
	<div class="row">
		<div class="span12">
			<div class="widget">
				<div class="widget-header"><i class="icon-facetime-video"></i>
					<h3>Modificar Banner</h3>
				</div>
				<div class="widget-content">
				<?php if(isset($error)){ ?>
					<div class="alert alert-danger"><strong><?php echo $error;?></strong></div>
				<?php } ?>
				<?php echo validation_errors('<div class="alert alert-danger"><strong>','</strong></div>') ?>
				<?php
				
				$formulario = array('name'=>'formulario1','class'=>'form-horizontal','id'=>'formulario_mod');

				if (isset($bannerseleccionado)) {
					foreach ($bannerseleccionado as $ds) {
						$nombrebanner = $ds->NOMBRE_BANNER;
						$descbanner = $ds->NOMBREIMAGENBANNER;
						$imagen = $ds->IMAGEN_BANNER;
						$est = $ds->ESTADO_BANNER;	
					}

				 	$titulo=array('name'=>'titulobanner','type'=>'text','placeholder'=>'Máximo 45 caracteres...','maxlength'=>'45','value'=>$nombrebanner);
					$desc=array('name'=>'descbanner','type'=>'text','placeholder'=>'Máximo 150 caracteres...','maxlength'=>'150','value'=>$descbanner);
					echo form_open_multipart('Panel/ActualizarBanner',$formulario);
				 }else{
				 	$titulo=array('name'=>'titulobanner','type'=>'text','placeholder'=>'Máximo 45 caracteres...','maxlength'=>'45');
					$desc=array('name'=>'descbanner','type'=>'text','placeholder'=>'Máximo 150 caracteres...','maxlength'=>'150');
					echo form_open_multipart('Panel/ActualizarBanner',$formulario);
				} 					

				if (!isset($idbanner)) { 	 ?>
					<div class="control-group">
                        <label class="control-label">Seleccione Banner:</label>
                        <div class="controls">
							<select name="idbanner" onChange="actualizar(this.options[this.selectedIndex].value);">
								<option value='' selected>Seleccionar</option>	
								<?php
								if (isset($banners)) {		
									foreach ($banners as $c) {	
										if ($c->ID_BANNER != 0) { ?>
											<option value="<?php echo $c->ID_BANNER; ?>"><?php echo $c->NOMBRE_BANNER; ?></option>
									<?php
										}	
									}
								}
								?>											
							</select>
						</div> 
					</div>
				<?php					
				}else{
				?>
					<div class="control-group" >
                        <label class="control-label">Seleccione Banner:</label>
                        <div class="controls">
							<select name="idbanner" onChange="actualizar(this.options[this.selectedIndex].value);">
								<option value=''>Seleccionar</option>	
								<?php
								if (isset($banners)) {		
									foreach ($banners as $c) {		
										if ($c->ID_BANNER != 0) { ?>
											<option value="<?php echo $c->ID_BANNER; ?>" <?php if($c->ID_BANNER == $idbanner){ echo "selected"; } ?> ><?php echo $c->NOMBRE_BANNER; ?></option>
									<?php
										}	
									}
								}
								?>											
							</select>
						</div> 
					</div>
				
					<div class="row">
						<div class="span6">
							<div class="widget">
								<div class="widget-header"><i class="icon-pencil"></i>
									<h3>Datos del Banner</h3>
								</div>
								<div class="widget-content">
									<div class="control-group">											
										<label class="control-label">Titulo Banner:</label>
										<div class="controls">
											<?php echo form_input($titulo) ?>
										</div> 
									</div>
									<div class="control-group">											
										<label class="control-label">Descripción Banner:</label>
										<div class="controls">
											<?php echo form_input($desc) ?>
											<p class="help-block">Descripción optativa.</p>
										</div> 
									</div>
									 <div class="control-group">
										<label class="control-label">Imagen Actual</label>
										<div class="controls">
											<img class="edicion" src="<?php echo $imagen; ?>">
											<input type="hidden" name="img_crg" value="<?php echo $imagen; ?>">
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
								</div>		
							</div>
						</div>
						<div class="span5">
							<div class="widget">
								<div class="widget-header"><i class="icon-qrcode"></i>
									<h3>Ligar a </h3>
								</div>
								<div class="widget-content">
									<div class="control-group">											
										<label class="control-label">Noticia:</label>
		                                <div class="controls">
		                                    <label class="checkbox inline">
		                                      	<input type="checkbox" name="checkbox" onclick="ver();" id="checkbox">
		                                    </label>
		                                </div>
		                            </div>
									<div class="control-group hide" id="seleccion">
		                                <label class="control-label">Seleccione Noticia:</label>
		                               <div class="controls">
											<select name="noticias">
												<option value='' selected>Seleccionar</option>	
												<?php
												if (isset($publicacion)) {		
													foreach ($publicacion as $c) {		?>
														<option value="<?php echo $c->ID_PUBLICACION; ?>"><?php echo $c->NOMBRE_PUBLICACION; ?></option>
												<?php	
													}
												}
												?>											
											</select>
										</div> 
									</div>
								</div>		
							</div>
						</div>
					</div>
					<center>
						<button type="submit" class="btn btn-primary">Guardar</button> 
						<button type="button" class="btn btn-warning"
						<?php if ($est == '0') {
								echo "onclick='deshabilitar(0);'>Habilitar";
						}else{
								echo "onclick='deshabilitar(1);'>Deshabilitar";
						} ?></button> 
						<button type="button" class="btn btn-danger" onclick="eliminar();">Eliminar</button> 
						<button type="button" class="btn" onClick="location.href='<?php echo base_url(); ?>Panel'">Cancelar</button>
					</center>	
				</div>
			</div>
								
			<?php }
			echo form_close();    ?>
		</div>
	</div>
</div>