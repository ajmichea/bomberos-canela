<div class="container">
	<div class="row">
		<div class="span12">
			<div class="widget">
				<div class="widget-header"><i class="icon-large icon-file"></i>
					<h3>Administrar Consejos</h3><a class="volver" href="<?php echo base_url();?>Panel/">Volver<i class="icon-large icon-home"></i></a>
				</div>
				<div class="widget-content">
					<?php if (isset($aviso)) { ?>
						<div class="alert alert-info"><strong><?php echo $aviso ?></strong></div>
					<?php } ?>
					<?php if (isset($error)) { ?>
						<div class="alert alert-danger"><strong><?php echo $error ?></strong></div>
					<?php } ?>
					<div class="shortcuts">
		                <a href="<?php echo base_url() ?>Panel/NuevoConsejo" class="shortcut"><i class="shortcut-icon  icon-comment"></i>
		                  <span class="shortcut-label">Nuevo Consejo</span> 
		                </a>
		                <a href="<?php echo base_url() ?>Panel/ModificarConsejo" class="shortcut"><i class="shortcut-icon icon-cogs"></i>
		                  <span class="shortcut-label">Modificar Consejo</span> 
		                </a>
		            </div>
				</div>
			</div>
		</div>
	</div>
</div>