<script type="text/javascript">
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
</script>

<div class="container">
	<div class="row">
		<div class="span12">
			<div class="widget">
				<div class="widget-header"><i class="icon-camera"></i>
					<h3>Nueva Galeria</h3>
				</div>
				<div class="widget-content">
					<?php if(isset($error)){ ?>
						<div class="alert alert-danger"><strong><?php echo $error;?></strong></div>
					<?php } ?>
					<?php echo validation_errors('<div class="alert alert-danger"><strong>','</strong></div>') ?>

					<?php   
							if (isset($input_usuario)) {
							    $value = $input_usuario;
						   	}else{
						   		$value = '';
						   	}
							$galeria = array('name' => 'galeria' ,
											'placeholder' => 'Galeria',
											'type' => 'text',
											'class' => 'span4',
											'value' => $value); ?>
					<?php echo form_open_multipart('Panel/Cargargaleria" class="form-horizontal"') ?>
						<fieldset>							
							<div class="control-group">											
								<label class="control-label" for="firstname">Nombre de Galeria</label>
								<div class="controls">
									<?php echo form_input($galeria) ?>
								</div> 
							</div>                             
                            <div class="control-group">											
								<label class="control-label" for="radiobtns">Cargar Fotografía</label>
                                <div class="controls">
    								<?php echo form_upload('userfile') ?>
                                </div>			
							</div>
							<div class="control-group hide" id="imagen1"></div>
							<div class="control-group hide" id="imagen2"></div>
							<div class="control-group hide" id="imagen3"></div>
							<div class="control-group hide" id="imagen4"></div>
							<div class="control-group hide" id="imagen5"></div>
							<div class="control-group hide" id="imagen6"></div>
                            <div class="control-group">					
                                <div class="controls">
                                    <a class="btn btn-mini" onClick="agregarcargaImg();"><i class="icon-plus"></i> </a>
                                  </div>			
							</div> 
							 <br>
							<div class="form-actions">
								<center>
									<button type="submit" class="btn btn-primary">Guardar</button> 
									<button type="button" class="btn" onClick="location.href='<?php echo base_url(); ?>Panel'">Cancelar</button>
							</center>
							</div> 
						</fieldset>
						<input type="hidden" name="cont" value="0" id="cont">
					<?php echo form_close() ?>
				</div>
			</div>
		</div>
	</div>
</div>