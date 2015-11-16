<script type="text/javascript">
	function validar(){
		if (document.getElementById('iddireccion').value != '' || document.getElementById('idfono').value != '' || document.getElementById('idmail').value != '') {
			document.getElementById('btn').disabled = false;
		}else{
			document.getElementById('btn').disabled = true;
		};
	}
</script>

<div class="container">
	<div class="row">
		<div class="span12">
			<div class="widget">
				<div class="widget-header"><i class="icon-pencil"></i>
					<h3>Nuevos Datos de Contacto</h3>
				</div>
			</div>
				<?php if(isset($error)){ ?>
					<div class="alert alert-danger"><strong><?php echo $error;?></strong></div>
				<?php } ?>
				<?php echo validation_errors('<div class="alert alert-danger"><strong>','</strong></div>') ?>
				<?php
				if (isset($aviso_direccion)) {
				 	$bd = 'disabled';
				 }else{
				 	$bd = '';
				 }
				 if (isset($aviso_fono)) {
				 	$bf = 'disabled';
				 }else{
				 	$bf = '';
				 }
				 if (isset($aviso_mail)) {
				 	$bm = 'disabled';
				 }else{
				 	$bm = '';
				 }
				$formulario = array('name'=>'formulario1','class'=>'form-horizontal'); 
				$direccion = array('name'=>'direccion','placeholder'=>'Dirección','type'=>'text','class'=>'span3',$bd=>'','id'=>'iddireccion','onblur'=>'validar();');
				$fono = array('name'=>'fono','placeholder'=>'Numero Telefonico','type'=>'text','class'=>'span3' ,$bf=>'','id'=>'idfono','onblur'=>'validar();');
				$mail = array('name'=>'mail','placeholder'=>'Dirección E-mail','type'=>'text','class'=>'span3' ,$bm=>'','id'=>'idmail','onblur'=>'validar();');
				?>
				<?php echo form_open('Panel/Cargarcontacto',$formulario) ?>
				<div class="row">
					<div class="span4">
						<div class="widget">
							<div class="widget-header"><i class="icon-group"></i>
								<h3>Nueva dirección</h3>
							</div>
							<div class="widget-content">
							<?php
								if (isset($aviso_direccion)) {  ?>
								 	<div class="alert alert-danger">
								 		<strong><?php echo $aviso_direccion; ?></strong>
								 	</div>
							<?php } 
							?>											
								<label>Dirección:</label>
								<?php echo form_input($direccion); ?>
							</div>		
						</div>
					</div>
					<div class="span4">
						<div class="widget">
							<div class="widget-header"><i class="icon-phone-sign"></i>
								<h3>Nuevo Telefono</h3>
							</div>
							<div class="widget-content">
							<?php
								if (isset($aviso_fono)) {  ?>
								 	<div class="alert alert-danger">
								 		<strong><?php echo $aviso_fono; ?></strong>
								 	</div>
							<?php } 
							?>											
								<label>Numero:</label>
								<?php echo form_input($fono); ?>
							</div>		
						</div>
					</div>
					<div class="span4">
						<div class="widget">
							<div class="widget-header"><i class="icon-envelope-alt"></i>
								<h3>Nuevo Correo</h3>
							</div>
							<div class="widget-content">
							<?php
								if (isset($aviso_mail)) {  ?>
								 	<div class="alert alert-danger">
								 		<strong><?php echo $aviso_mail; ?></strong>
								 	</div>
							<?php } 
							?>											
								<label>E-mail:</label>
								<?php echo form_input($mail); ?>
							</div>		
						</div>
					</div>
				</div>
				<center>
					<button type="submit" class="btn btn-primary" id="btn" disabled>Guardar</button> 
					<button type="button" class="btn" onClick="location.href='<?php echo base_url(); ?>Panel'">Cancelar</button>
				</center>						
				<?php echo form_close() ?>
		</div>
	</div>
</div>