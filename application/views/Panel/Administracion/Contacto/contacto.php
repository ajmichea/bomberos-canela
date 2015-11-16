<div class="container">
	<div class="row">
		<div class="span12">
			<div class="widget">
				<div class="widget-header"><i class="icon-large icon-file"></i>
					<h3>Administrar Contactos</h3><a class="volver" href="<?php echo base_url();?>Panel/">Volver<i class="icon-large icon-home"></i></a>
				</div>
				<div class="widget-content">
					<?php if (isset($avisoD)) { ?>
						<div class="alert alert-info"><strong><?php echo $avisoD ?></strong></div>
					<?php } ?>
					<?php if (isset($avisoF)) { ?>
						<div class="alert alert-info"><strong><?php echo $avisoF ?></strong></div>
					<?php } ?>
					<?php if (isset($avisoM)) { ?>
						<div class="alert alert-info"><strong><?php echo $avisoM ?></strong></div>
					<?php } ?>
					<?php if (isset($error)) { ?>
						<div class="alert alert-danger"><strong><?php echo $error ?></strong></div>
					<?php } ?>
					<div class="shortcuts">
		                <a href="<?php echo base_url() ?>Panel/NuevoContacto" class="shortcut"><i class="shortcut-icon  icon-pencil"></i>
		                  <span class="shortcut-label">Nuevo Contacto</span> 
		                </a>
		                <a href="<?php echo base_url() ?>Panel/ModificarContacto" class="shortcut"><i class="shortcut-icon icon-cogs"></i>
		                  <span class="shortcut-label">Modificar Contacto</span> 
		                </a>
		            </div>
				</div>
			</div>
		</div>
	</div>
</div>