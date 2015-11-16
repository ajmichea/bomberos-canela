<script type="text/javascript">
	var n_parrafo = 0;
	function agregar_parrafo(){
		n_parrafo++;
		if (n_parrafo <= 5) {
			document.getElementById('parrafo'+n_parrafo).className = 'parrafo';
			document.getElementById('br'+n_parrafo).className = '';
			document.getElementById('br_'+n_parrafo).className = '';
		};
	}
</script>
<div class="container">
	<div class="row">
		<div class="span12">
			<div class="widget">
				<div class="widget-header"><i class="icon-bookmark"></i>
					<h3>Nueva Publicación</h3>
				</div>
				<div class="widget-content">
					<?php if(isset($error)){ ?>
						<div class="alert alert-danger"><strong><?php echo $error;?></strong></div>
					<?php } ?>
					<?php echo validation_errors('<div class="alert alert-danger"><strong>','</strong></div>') ?>
					<?php
						$titulo = array('name'=>'titulo','placeholder'=>'Máximo 45 caracteres...','maxlength'=>'45');
					?>
					<?php $atributos_form = array('class' => 'form-horizontal', 'name' => 'formulario_mod', 'id' => 'formulario_mod'); ?>
					<?php echo form_open_multipart('Panel/Cargarpublicacion', $atributos_form) ?>
						<div class="row">
							<div class="span5">		
								<div class="control-group">											
									<label class="control-label">Titulo de Publicación:</label>
									<div class="controls">
										<?php echo form_input($titulo) ?>
									</div> 
								</div>                             
	                            <div class="control-group">											
									<label class="control-label">Cargar Imagen</label>
	                                <div class="controls">
	    								<?php echo form_upload('userfile') ?>
	                                </div>			
								</div>
							</div>
							<div class="span6">
								<div class="alert alert-success">
									<strong><center>Ingresar contenido introductorio de la publicación</center></strong>
								</div>
								<textarea name="parrafo_introduccion" placeholder="Máximo 255 caracteres..." maxlength="255" rows="4" class="parrafo"></textarea>
								<br>
								<br>
								<div class="alert alert-success">
									<strong><center>Ingresar contenido de la publicación</center></strong>
								</div>
								<textarea name="parrafo" placeholder="Máximo 65.500 caracteres..." maxlength="65500" rows="4" class="parrafo"></textarea>
								<br class="hide" id="br1"><br class="hide" id="br_1">
								<textarea name="parrafo1" placeholder="Máximo 65.500 caracteres..." maxlength="65500" rows="4" class="parrafo hide" id="parrafo1"></textarea>
								<br class="hide" id="br2"><br class="hide" id="br_2">
								<textarea name="parrafo2" placeholder="Máximo 65.500 caracteres..." maxlength="65500" rows="4" class="parrafo hide" id="parrafo2"></textarea>
								<br class="hide" id="br3"><br class="hide" id="br_3">
								<textarea name="parrafo3" placeholder="Máximo 65.500 caracteres..." maxlength="65500" rows="4" class="parrafo hide" id="parrafo3"></textarea>
								<br class="hide" id="br4"><br class="hide" id="br_4">
								<textarea name="parrafo4" placeholder="Máximo 65.500 caracteres..." maxlength="65500" rows="4" class="parrafo hide" id="parrafo4"></textarea>
								<br class="hide" id="br5"><br class="hide" id="br_5">
								<textarea name="parrafo5" placeholder="Máximo 65.500 caracteres..." maxlength="65500" rows="4" class="parrafo hide" id="parrafo5"></textarea>
								<br>
	                            <a class="btn btn-mini" onClick="agregar_parrafo();"><i class="icon-plus"></i> </a>
	                        </div>								
						</div>						
							<br>
							<div>
								<center>
									<button type="submit" class="btn btn-primary">Guardar</button> 
									<button type="button" class="btn" onClick="location.href='<?php echo base_url(); ?>Panel'">Cancelar</button>
								</center>
							</div>
					<?php echo form_close() ?>
				</div>
			</div>
		</div>
	</div>
</div>