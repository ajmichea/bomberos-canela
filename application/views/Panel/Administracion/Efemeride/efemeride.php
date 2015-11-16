<div class="container">
	<div class="row">
		<div class="span12">
			<div class="widget">
				<div class="widget-header"><i class="icon-large icon-calendar"></i>
					<h3>Administrar Efemérides</h3><a class="volver" href="<?php echo base_url();?>Panel/">Volver<i class="icon-large icon-home"></i></a>
				</div>
				<div class="widget-content">
					<?php if (isset($aviso)) { ?>
						<div class="alert alert-info"><strong><?php echo $aviso ?></strong></div>
					<?php } ?>
					<?php if (isset($error)) { ?>
						<div class="alert alert-danger"><strong><?php echo $error ?></strong></div>
					<?php } ?>
					<div class="shortcuts">
		                <a href="<?php echo base_url() ?>Panel/NuevaEfemeride" class="shortcut"><i class="shortcut-icon icon-calendar"></i>
		                  <span class="shortcut-label">Nueva Efeméride</span> 
		                </a>
		                <a href="<?php echo base_url() ?>Panel/ModificarEfemeride" class="shortcut"><i class="shortcut-icon icon-cogs"></i>
		                  <span class="shortcut-label">Modificar Efeméride</span> 
		                </a>
		            </div>
				</div>
			</div>
		</div>
	</div>
</div>