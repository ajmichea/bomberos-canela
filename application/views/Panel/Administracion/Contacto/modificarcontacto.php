<script type="text/javascript">
     
    var bPreguntar = true;
     
    window.onbeforeunload = preguntarAntesDeSalir;
     
    function preguntarAntesDeSalir()
    {
	    if (bPreguntar)
			return "Recuerde pulsar 'Guardar' para conservar los cambios realizados.";        
    }

    function activar(){
    	var a = 0;
    	while(a < 3){
    		if (document.getElementById('idfono'+a)) {
    			document.getElementById('idfono'+a).disabled = false;
    		};
    		if (document.getElementById('idmail'+a)) {
    			document.getElementById('idmail'+a).disabled = false;
    		};
    		a++;
    	}
    	document.getElementById('iddireccion').disabled = false;
    	bPreguntar = false;
    }

	function validar(){
		document.getElementById('btn').disabled = false;
	}

	function Modificar_direc(){
		document.getElementById('iddireccion').disabled = false;
	}
	function Eliminar_direc(){
		document.getElementById('iddireccion').value = '';
		document.getElementById('iddireccion').disabled = true;
		validar();
	}
	function Modificar_fono(d){
		document.getElementById('idfono'+d).disabled = false;
	}
	function Eliminar_fono(d){
		document.getElementById('idfono'+d).value = '';
		document.getElementById('idfono'+d).disabled = true;
		validar();
	}
	function Modificar_mail(d){
		document.getElementById('idmail'+d).disabled = false;
	}
	function Eliminar_mail(d){
		document.getElementById('idmail'+d).value = '';
		document.getElementById('idmail'+d).disabled = true;
		validar();
	}
</script>

<div class="container">
	<div class="row">
		<div class="span12">
			<div class="widget">
				<div class="widget-header"><i class="icon-pencil"></i>
					<h3>Modificar Datos de Contacto</h3>
				</div>
			</div>
				<?php echo validation_errors('<div class="alert alert-danger"><strong>','</strong></div>') ?>
				<?php
				$formulario = array('name'=>'formulario1','id'=>'formulario1','class'=>'form-horizontal'); 	?>

				<?php echo form_open('Panel/guardarmodificarcontacto',$formulario) ?>
				<div class="row">
					<div class="span4">
						<div class="widget">
							<div class="widget-header"><i class="icon-group"></i>
								<h3>Dirección</h3>
							</div>
							<div class="widget-content">										
								<table class="table table-striped table-bordered">
					                <tbody>
					                	<?php
					                	if (isset($datos_direccion)) {
					                		foreach ($datos_direccion as $d_d) {  
					                			$direccion = array('name'=>'direccion','placeholder'=>$d_d->DIRECCION.' , ha sido eliminada.','value'=>$d_d->DIRECCION,'type'=>'text','class'=>'span3','disabled'=>'','id'=>'iddireccion','onblur'=>'validar();'); ?>
					                			<tr>
								                    <td> <?php echo form_input($direccion); ?></td>
								                    <td class="td-actions"><a onclick="Modificar_direc();" class="btn btn-small btn-success"><i class="btn-icon-only icon-pencil"> </i></a><a onclick="Eliminar_direc();" class="btn btn-danger btn-small"><i class="btn-icon-only icon-remove"> </i></a></td>
								                </tr>
					                	<?php 
					                		}
					                	}
					                	?>								                
					                </tbody>
					            </table>
							</div>		
						</div>
					</div>
					<div class="span4">
						<div class="widget">
							<div class="widget-header"><i class="icon-phone-sign"></i>
								<h3>Telefono</h3>
							</div>
							<div class="widget-content">										
								<table class="table table-striped table-bordered">
					                <tbody>
					                	<?php
					                	if (isset($datos_fono)) {
					                		$d=0;
					                		foreach ($datos_fono as $d_f) {  
					                			$fono = array('name'=>'fono'.$d,'placeholder'=>$d_f->NUMERO_TELEFONO.' , ha sido eliminado.','value'=>$d_f->NUMERO_TELEFONO,'type'=>'text','class'=>'span3','disabled'=>'','id'=>'idfono'.$d,'onblur'=>'validar();'); ?>
					                			<tr>
								                    <td> <?php echo form_input($fono); ?></td>
								                    <input type="hidden" name="id_fono<?php echo $d; ?>" value="<?php echo $d_f->ID_TELEFONO; ?>">
								                    <td class="td-actions"><a onclick='Modificar_fono(<?php echo $d;?>)' class="btn btn-small btn-success"><i class="btn-icon-only icon-pencil"> </i></a><a onclick='Eliminar_fono(<?php echo $d;?>)' class="btn btn-danger btn-small"><i class="btn-icon-only icon-remove"> </i></a></td>
								                </tr>
					                	<?php 
					                		$d++;
					                		}
					                	}
					                	?>								                
					                </tbody>
					            </table>
							</div>		
						</div>
					</div>
					<div class="span4">
						<div class="widget">
							<div class="widget-header"><i class="icon-envelope-alt"></i>
								<h3>Correo</h3>
							</div>
							<div class="widget-content">										
								<table class="table table-striped table-bordered">
					                <tbody>
					                	<?php
					                	if (isset($datos_mail)) {
					                		$d = 0;
					                		foreach ($datos_mail as $d_m) {  
					                			$mail = array('name'=>'n_mail'.$d,'placeholder'=>$d_m->E_MAIL.' , ha sido eliminado.','value'=>$d_m->E_MAIL,'type'=>'text','class'=>'span3','disabled'=>'','id'=>'idmail'.$d,'onblur'=>'validar();'); ?>
					                			<tr>
								                    <td> <?php echo form_input($mail); ?></td>
								                    <input type="hidden" name="id_mail<?php echo $d; ?>" value="<?php echo $d_m->ID_MAIL; ?>">
								                    <td class="td-actions"><a onclick='Modificar_mail(<?php echo $d;?>)' class="btn btn-small btn-success"><i class="btn-icon-only icon-pencil"> </i></a><a onclick='Eliminar_mail(<?php echo $d;?>)' class="btn btn-danger btn-small"><i class="btn-icon-only icon-remove"> </i></a></td>
								                </tr>
					                	<?php 
					                		$d++;
					                		}
					                	}
					                	?>								                
					                </tbody>
					            </table>
							</div>		
						</div>
					</div>
				</div>
				<center>
					<button type="submit" class="btn btn-primary" id="btn" onclick="activar();" disabled>Guardar</button> 
					<button type="button" class="btn" onClick="location.href='<?php echo base_url(); ?>Panel'">Cancelar</button>
				</center>						
				<?php echo form_close() ?>
		</div>
	</div>
</div>