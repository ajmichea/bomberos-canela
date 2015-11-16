<div class="container">
	<div class="row">
		<div class="span12">
			<div class="widget">
				<div class="widget-header"><i class="icon-picture"></i>
					<h3>Administrar Galerias</h3><a class="volver" href="<?php echo base_url();?>Panel/">Volver<i class="icon-large icon-home"></i></a>
				</div>
				<div class="widget-content">
					<?php if (isset($aviso)) { ?>
						<div class="alert alert-info"><strong><?php echo $aviso ?></strong></div>
					<?php } ?>
					<?php if (isset($error)) { ?>
						<div class="alert alert-danger"><strong><?php echo $error ?></strong></div>
					<?php } ?>
					<div class="shortcuts">
		                <a href="<?php echo base_url() ?>Panel/NuevaGaleria" class="shortcut"><i class="shortcut-icon icon-camera"></i>
		                  <span class="shortcut-label">Agregar Nueva</span> 
		                </a>
		                <a href="<?php echo base_url() ?>Panel/ModificarGaleria" class="shortcut"><i class="shortcut-icon icon-cogs"></i>
		                  <span class="shortcut-label">Modificar Galerias</span> 
		                </a>
		            </div>
				</div>
			</div>
		</div>
	</div>
</div>