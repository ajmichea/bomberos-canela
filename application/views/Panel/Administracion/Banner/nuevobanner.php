<script type="text/javascript">
	function ver(){
		if (document.getElementById('checkbox').checked) {
			document.getElementById('seleccion').className = 'control-group'
		}else{
			document.getElementById('seleccion').className = 'control-group hide'
		};
	}
</script>

<div class="container">
	<div class="row">
		<div class="span12">
			<div class="widget">
				<div class="widget-header"><i class="icon-facetime-video"></i>
					<h3>Nuevo Banner</h3>
				</div>
				<div class="widget-content">
				<?php if(isset($error)){ ?>
					<div class="alert alert-danger"><strong><?php echo $error;?></strong></div>
				<?php } ?>
				<?php echo validation_errors('<div class="alert alert-danger"><strong>','</strong></div>') ?>
				<?php
				
				$formulario = array('name'=>'formulario1','class'=>'form-horizontal'); 

				$titulo=array('name'=>'titulobanner','type'=>'text','placeholder'=>'Máximo 45 caracteres...','maxlength'=>'45');
				$desc=array('name'=>'descbanner','type'=>'text','placeholder'=>'Máximo 150 caracteres...','maxlength'=>'150');
				?>
				<?php echo form_open_multipart('Panel/Cargarbanner',$formulario) ?>
				
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
									<label class="control-label">Cargar Imagen</label>
	                                <div class="controls">
	    								<?php echo form_upload('userfile') ?>
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
						<button type="submit" class="btn btn-primary" id="btn">Guardar</button> 
						<button type="button" class="btn" onClick="location.href='<?php echo base_url(); ?>Panel'">Cancelar</button>
					</center>	
				</div>
			</div>
								
				<?php echo form_close() ?>
		</div>
	</div>
</div>