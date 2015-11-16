<div class="container">
	<div class="row">
		<div class="span12">
			<div class="widget">
				<div class="widget-header"><i class="icon-calendar"></i>
					<h3>Nueva Efeméride</h3>
				</div>
				<div class="widget-content">
					<?php if(isset($error)){ ?>
						<div class="alert alert-danger"><strong><?php echo $error;?></strong></div>
					<?php } ?>
					<?php echo validation_errors('<div class="alert alert-danger"><strong>','</strong></div>') ?>
					<?php
						$titulo_efemeride = array('name'=>'nom_efemeride','placeholder'=>'Máximo 45 caracteres...','maxlength'=>'45');
						$ano = array('name'=>'ano','placeholder'=>'Máx. 4 caracteres...','maxlength'=>'4');
					?>
					<?php $atributos_form = array('class' => 'form-horizontal', 'name' => 'formulario_mod', 'id' => 'formulario_mod'); ?>
					<?php echo form_open('Panel/Cargarefemeride', $atributos_form) ?>
						<div class="row">
							<div class="span5">		
								<div class="control-group">											
									<label class="control-label">Nombre Efeméride:</label>
									<div class="controls">
										<?php echo form_input($titulo_efemeride) ?>
									</div> 
								</div>                             
	                            <div class="control-group">											
									<label class="control-label">Día:</label>
									<div class="controls">
										<select name="dia">
											<option value=''> -- </option>
											<?php
											$i=1;
											while ($i <= 31) {
												echo "<option value='".$i."'> ".$i." </option>";
												$i++;
											}
											?>
										</select>
									</div> 
								</div> 
								<div class="control-group">											
									<label class="control-label"> Mes:</label>
									<div class="controls">
										<select name="mes">
											<option value=''> -- </option>
											<?php
											$i=1;
											while ($i <= 12) {
												echo "<option value='".$i."'> ".$i." </option>";
												$i++;
											}
											?>
										</select>
									</div> 
								</div> 
								<div class="control-group">											
									<label class="control-label"> Año:</label>
									<div class="controls">
										<?php echo form_input($ano) ?>
									</div> 
								</div>      
							</div>
							<div class="span6">
								<div class="alert alert-success">
									<strong><center>Ingresar descripción de la efeméride</center></strong>
								</div>
								<textarea name="desc_efemeride" placeholder="Máximo 255 caracteres..." maxlength="255" rows="4" class="parrafo"></textarea>
								<br>
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