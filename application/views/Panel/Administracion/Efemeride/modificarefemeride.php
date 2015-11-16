<script type="text/javascript">
	
	function actualizar(b){
		if (b == '') {
			document.getElementById('formulario_mod').action = 'ModificarEfemeride';
			document.getElementById('formulario_mod').submit();
		}else{
			document.getElementById('formulario_mod').action = 'Efemerideselecionada';
			document.getElementById('formulario_mod').submit();
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
		if (confirm("Al realizar esta acción "+b+" se visualizara la Efeméride. Si desea continuar presione ACEPTAR, si no presione CANCELAR")){
			document.getElementById('formulario_mod').action = a+"efemeride";
			document.getElementById('formulario_mod').submit();
		};	
	} 

	function eliminar(){
		if (confirm("Al realizar esta acción eliminará de forma permanente de la Efeméride. Si desea continuar presione ACEPTAR, si no presione CANCELAR")){
			document.getElementById('formulario_mod').action = "eliminarefemeride";
			document.getElementById('formulario_mod').submit();
		};	
	}
</script>
<div class="container">
	<div class="row">
		<div class="span12">
			<div class="widget">
				<div class="widget-header"><i class="icon-bookmark"></i>
					<h3>Modificar Efeméride</h3>
				</div>
				<div class="widget-content">
					<?php if(isset($error)){ ?>
						<div class="alert alert-danger"><strong><?php echo $error;?></strong></div>
					<?php } ?>
					<?php echo validation_errors('<div class="alert alert-danger"><strong>','</strong></div>');
					if (isset($datos_efemeride)) {
						$dpi = $datos_efemeride;
						foreach ($dpi as $e) {
							$dp=$e;
						}
						list($ano,$mes,$dia)=explode("-",$dp->FECHA_EFEMERIDE);
					}
					?>
					
					<?php $atributos_form = array('class' => 'form-horizontal', 'name' => 'formulario_mod', 'id' => 'formulario_mod'); ?>
					<?php echo form_open('Panel/Actualizarefemeride', $atributos_form) ?>
						<div class="row">
							<div class="span5">
								<div class="control-group">
								<?php
								if (isset($efemerides)) {		?>											
									<label class="control-label">Titulo de Efeméride:</label>
									<div class="controls">
										<select name="efemerides" onChange="actualizar(this.options[this.selectedIndex].value);">
											<?php
											if (isset($datos_efemeride)) {		?>
												<option value=''>Seleccionar</option>
												<?php
												foreach ($efemerides as $c) {			?>
													<option value="<?php echo $c->ID_EFEMERIDE; ?>" <?php if($c->ID_EFEMERIDE == $idefemeride){ echo "selected";} ?>><?php echo $c->NOMBRE_EFEMERIDE; ?></option>
												<?php
												}
											}else{ ?>
												<option value='' selected>Selecccionar</option>
											<?php
												foreach ($efemerides as $c) {		?>
													<option value="<?php echo $c->ID_EFEMERIDE; ?>"><?php echo $c->NOMBRE_EFEMERIDE; ?></option>
											<?php	
												}
											}
											?>											
										</select>
									</div> 
								<?php
								}else{ ?>
									<div class="alert">
                                      	<strong>No existen efemérides.</strong>
                                    </div>
								<?php	
								} 
								?>	
								</div>
								<?php
								if (isset($datos_efemeride)) {	?>

								<div class="control-group">											
									<label class="control-label">Modificar Titulo :</label>
									<div class="controls">
										<?php
											$titulo = array('name'=>'nom_efemeride','placeholder'=>'Máximo 45 caracteres...','maxlength'=>'45','value'=>$dp->NOMBRE_EFEMERIDE );
										?>
										<?php echo form_input($titulo); ?>
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
												if ($dia == $i) {
													echo "<option value='".$i."' selected> ".$i." </option>";
												}else{
													echo "<option value='".$i."'> ".$i." </option>";
												}												
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
												if ($mes == $i) {
													echo "<option value='".$i."' selected> ".$i." </option>";
												}else{
													echo "<option value='".$i."'> ".$i." </option>";
												}												
												$i++;
											}
											?>
										</select>
									</div> 
								</div> 
								<div class="control-group">											
									<label class="control-label"> Año:</label>
									<div class="controls">
										<?php
										$ano = array('name'=>'ano','placeholder'=>'Máx. 4 caracteres...','maxlength'=>'4','value'=>$ano);
										echo form_input($ano) ?>
									</div> 
								</div> 
								                            
	                            
								<?php
								}
								?>
							</div>
							<div class="span6">
								<?php
								if (isset($datos_efemeride)) {	?>
								<div class="alert alert-success">
									<strong><center>Descripción de la efeméride</center></strong>
								</div>
								<textarea name="desc_efemeride" placeholder="Máximo 255 caracteres..." maxlength="255" rows="4" class="parrafo"><?php echo $dp->DESCRIPCION_EFEMERIDE; ?></textarea>
								
								<?php
	                        	}
	                        	?>
	                        </div>								
						</div>						
							<br>
							<?php
								if (isset($datos_efemeride)) {	?>
							<div>
								<center>
									<button type="submit" class="btn btn-primary">Guardar</button> 
									<button type="button" class="btn btn-warning"
									<?php if ($dp->ESTADO_EFEMERIDE == '0') {
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