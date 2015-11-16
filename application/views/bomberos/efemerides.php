<script type="text/javascript">
	function ver(s){
		if (document.getElementById('span'+s).className == 'glyphicon glyphicon-plus') {
			document.getElementById('span'+s).className = 'glyphicon glyphicon-minus';
			document.getElementById('div'+s).className = '';
		}else{
			document.getElementById('span'+s).className = 'glyphicon glyphicon-plus';
			document.getElementById('div'+s).className = 'hide';
		}
	}

	function mostrar(s){
		if (document.getElementById(s).className == 'glyphicon glyphicon-triangle-bottom') {
			document.getElementById(s).className = 'glyphicon glyphicon-triangle-top'
			document.getElementById('cuerpo'+s).className = 'panel-body';
		}else{
			document.getElementById(s).className = 'glyphicon glyphicon-triangle-bottom'
			document.getElementById('cuerpo'+s).className = 'panel-body hide';
		}
	}
</script>
<section>
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<div class="fondo_item fondo_contenido">
					<div class="panel panel-success">
						<div class="panel-heading">
							<center><strong class="titulo_paneles">Efemerides</strong></center>
						</div>
					</div>
					<?php
					if (isset($efemeride1)) {	?>
						<div class="panel panel-info">
							<div class="panel-heading">
								<h3 class="panel-title">Enero <button class="derecha btn btn-xs" onclick="mostrar('ene');"><span class="glyphicon glyphicon-triangle-bottom" id="ene"></span></button></h3>
							</div>
							<div class="panel-body hide" id="cuerpoene">
								<ul class="list-group">
								<?php
								$i =0;
								foreach ($efemeride1 as $e1) {  ?>
									<li class="list-group-item list-group-item-warning" >
										<?php
										$fecha = new DateTime($e1->FECHA_EFEMERIDE);
										echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
										echo $fecha->format('d-m-Y');
										echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
										echo $e1->NOMBRE_EFEMERIDE;
										?>
										<button class="btn btn-xs badge" id="btn01<?php echo $i; ?>" onclick="ver('01<?php echo $i; ?>');"><span class="glyphicon glyphicon-plus" id="span01<?php echo $i; ?>"></span></button>
										<div class="hide" id="div01<?php echo $i; ?>">
											<br>
											<p class="efemeride m_r m_l">
												<?php echo $e1->DESCRIPCION_EFEMERIDE; ?>
											</p>
										</div>
											
									</li>
									<?php
									$i++;
								}
								?>									
								</ul>								
							</div>
						</div>
					<?php	
					}else{
						?>
						<div class="panel panel-info">
							<div class="panel-heading">
								<h3 class="panel-title">Enero<button class="derecha btn btn-xs" disabled><span class="glyphicon glyphicon-triangle-bottom"></span></button></h3>
							</div>
						</div>
						<?php
					}
					if (isset($efemeride2)) {	?>
						<div class="panel panel-info">
							<div class="panel-heading">
								<h3 class="panel-title">Febrero<button class="derecha btn btn-xs" onclick="mostrar('feb');"><span class="glyphicon glyphicon-triangle-bottom" id="feb"></span></button></h3>
							</div>
							<div class="panel-body hide" id="cuerpofeb">
								<ul class="list-group">
								<?php
								$i =0;
								foreach ($efemeride2 as $e2) {  ?>
									<li class="list-group-item list-group-item-warning" >
										<?php
										$fecha = new DateTime($e2->FECHA_EFEMERIDE);
										echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
										echo $fecha->format('d-m-Y');
										echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
										echo $e2->NOMBRE_EFEMERIDE;
										?>
										<button class="btn btn-xs badge" id="btn02<?php echo $i; ?>" onclick="ver('02<?php echo $i; ?>');"><span class="glyphicon glyphicon-plus" id="span02<?php echo $i; ?>"></span></button>
										<div class="hide" id="div02<?php echo $i; ?>">
											<br>
											<p class="efemeride m_r m_l">
												<?php echo $e2->DESCRIPCION_EFEMERIDE; ?>
											</p>
										</div>
											
									</li>
									<?php
									$i++;
								}
								?>									
								</ul>								
							</div>
						</div>
					<?php	
					}else {?>
						<div class="panel panel-info">
							<div class="panel-heading">
								<h3 class="panel-title">Febrero<button class="derecha btn btn-xs" disabled><span class="glyphicon glyphicon-triangle-bottom"></span></button></h3>
							</div>
						</div>
					<?php
					}
					if (isset($efemeride3)) {	?>
						<div class="panel panel-info">
							<div class="panel-heading">
								<h3 class="panel-title">Marzo<button class="derecha btn btn-xs" onclick="mostrar('mar');"><span class="glyphicon glyphicon-triangle-bottom" id="mar"></span></button></h3>
							</div>
							<div class="panel-body hide" id="cuerpomar">
								<ul class="list-group">
								<?php
								$i =0;
								foreach ($efemeride3 as $e3) {  ?>
									<li class="list-group-item list-group-item-warning" >
										<?php
										$fecha = new DateTime($e3->FECHA_EFEMERIDE);
										echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
										echo $fecha->format('d-m-Y');
										echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
										echo $e3->NOMBRE_EFEMERIDE;
										?>
										<button class="btn btn-xs badge" id="btn03<?php echo $i; ?>" onclick="ver('03<?php echo $i; ?>');"><span class="glyphicon glyphicon-plus" id="span03<?php echo $i; ?>"></span></button>
										<div class="hide" id="div03<?php echo $i; ?>">
											<br>
											<p class="efemeride m_r m_l">
												<?php echo $e3->DESCRIPCION_EFEMERIDE; ?>
											</p>
										</div>
											
									</li>
									<?php
									$i++;
								}
								?>									
								</ul>								
							</div>
						</div>
					<?php	
					}else {?>
						<div class="panel panel-info">
							<div class="panel-heading">
								<h3 class="panel-title">Marzo<button class="derecha btn btn-xs" disabled><span class="glyphicon glyphicon-triangle-bottom"></span></button></h3>
							</div>
						</div>
					<?php
					}					
					if (isset($efemeride4)) {	?>
						<div class="panel panel-info">
							<div class="panel-heading">
								<h3 class="panel-title">Abril<button class="derecha btn btn-xs" onclick="mostrar('abr');"><span class="glyphicon glyphicon-triangle-bottom" id="abr"></span></button></h3>
							</div>
							<div class="panel-body hide" id="cuerpoabr">
								<ul class="list-group">
								<?php
								$i =0;
								foreach ($efemeride4 as $e4) {  ?>
									<li class="list-group-item list-group-item-warning" >
										<?php
										$fecha = new DateTime($e4->FECHA_EFEMERIDE);
										echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
										echo $fecha->format('d-m-Y');
										echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
										echo $e4->NOMBRE_EFEMERIDE;
										?>
										<button class="btn btn-xs badge" id="btn04<?php echo $i; ?>" onclick="ver('04<?php echo $i; ?>');"><span class="glyphicon glyphicon-plus" id="span04<?php echo $i; ?>"></span></button>
										<div class="hide" id="div04<?php echo $i; ?>">
											<br>
											<p class="efemeride m_r m_l">
												<?php echo $e4->DESCRIPCION_EFEMERIDE; ?>
											</p>
										</div>
											
									</li>
									<?php
									$i++;
								}
								?>									
								</ul>								
							</div>
						</div>
					<?php	
					}else {?>
						<div class="panel panel-info">
							<div class="panel-heading">
								<h3 class="panel-title">Abril<button class="derecha btn btn-xs" disabled><span class="glyphicon glyphicon-triangle-bottom"></span></button></h3>
							</div>
						</div>
					<?php
					}
					if (isset($efemeride5)) {	?>
						<div class="panel panel-info">
							<div class="panel-heading">
								<h3 class="panel-title">Mayo<button class="derecha btn btn-xs" onclick="mostrar('may');"><span class="glyphicon glyphicon-triangle-bottom" id="may"></span></button></h3>
							</div>
							<div class="panel-body hide" id="cuerpomay">
								<ul class="list-group">
								<?php
								$i =0;
								foreach ($efemeride5 as $e5) {  ?>
									<li class="list-group-item list-group-item-warning" >
										<?php
										$fecha = new DateTime($e5->FECHA_EFEMERIDE);
										echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
										echo $fecha->format('d-m-Y');
										echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
										echo $e5->NOMBRE_EFEMERIDE;
										?>
										<button class="btn btn-xs badge" id="btn05<?php echo $i; ?>" onclick="ver('05<?php echo $i; ?>');"><span class="glyphicon glyphicon-plus" id="span05<?php echo $i; ?>"></span></button>
										<div class="hide" id="div05<?php echo $i; ?>">
											<br>
											<p class="efemeride m_r m_l">
												<?php echo $e5->DESCRIPCION_EFEMERIDE; ?>
											</p>
										</div>
											
									</li>
									<?php
									$i++;
								}
								?>									
								</ul>								
							</div>
						</div>
					<?php	
					}else {?>
						<div class="panel panel-info">
							<div class="panel-heading">
								<h3 class="panel-title">Mayo<button class="derecha btn btn-xs" disabled><span class="glyphicon glyphicon-triangle-bottom"></span></button></h3>
							</div>
						</div>
					<?php
					}
					if (isset($efemeride6)) {	?>
						<div class="panel panel-info">
							<div class="panel-heading">
								<h3 class="panel-title">Junio<button class="derecha btn btn-xs" onclick="mostrar('jun');"><span class="glyphicon glyphicon-triangle-bottom" id="jun"></span></button></h3>
							</div>
							<div class="panel-body hide" id="cuerpojun">
								<ul class="list-group">
								<?php
								$i =0;
								foreach ($efemeride6 as $e6) {  ?>
									<li class="list-group-item list-group-item-warning" >
										<?php
										$fecha = new DateTime($e6->FECHA_EFEMERIDE);
										echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
										echo $fecha->format('d-m-Y');
										echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
										echo $e6->NOMBRE_EFEMERIDE;
										?>
										<button class="btn btn-xs badge" id="btn06<?php echo $i; ?>" onclick="ver('06<?php echo $i; ?>');"><span class="glyphicon glyphicon-plus" id="span06<?php echo $i; ?>"></span></button>
										<div class="hide" id="div06<?php echo $i; ?>">
											<br>
											<p class="efemeride m_r m_l">
												<?php echo $e6->DESCRIPCION_EFEMERIDE; ?>
											</p>
										</div>
											
									</li>
									<?php
									$i++;
								}
								?>									
								</ul>								
							</div>
						</div>
					<?php	
					}else {?>
						<div class="panel panel-info">
							<div class="panel-heading">
								<h3 class="panel-title">Junio<button class="derecha btn btn-xs" disabled><span class="glyphicon glyphicon-triangle-bottom"></span></button></h3>
							</div>
						</div>
					<?php
					}
					if (isset($efemeride7)) {	?>
						<div class="panel panel-info">
							<div class="panel-heading">
								<h3 class="panel-title">Julio<button class="derecha btn btn-xs" onclick="mostrar('jul');"><span class="glyphicon glyphicon-triangle-bottom" id="jul"></span></button></h3>
							</div>
							<div class="panel-body hide" id="cuerpojul">
								<ul class="list-group">
								<?php
								$i =0;
								foreach ($efemeride7 as $e7) {  ?>
									<li class="list-group-item list-group-item-warning" >
										<?php
										$fecha = new DateTime($e7->FECHA_EFEMERIDE);
										echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
										echo $fecha->format('d-m-Y');
										echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
										echo $e7->NOMBRE_EFEMERIDE;
										?>
										<button class="btn btn-xs badge" id="btn07<?php echo $i; ?>" onclick="ver('07<?php echo $i; ?>');"><span class="glyphicon glyphicon-plus" id="span07<?php echo $i; ?>"></span></button>
										<div class="hide" id="div07<?php echo $i; ?>">
											<br>
											<p class="efemeride m_r m_l">
												<?php echo $e7->DESCRIPCION_EFEMERIDE; ?>
											</p>
										</div>
											
									</li>
									<?php
									$i++;
								}
								?>									
								</ul>								
							</div>
						</div>
					<?php	
					}else {?>
						<div class="panel panel-info">
							<div class="panel-heading">
								<h3 class="panel-title">Julio<button class="derecha btn btn-xs" disabled><span class="glyphicon glyphicon-triangle-bottom"></span></button></h3>
							</div>
						</div>
					<?php
					}
					if (isset($efemeride8)) {	?>
						<div class="panel panel-info">
							<div class="panel-heading">
								<h3 class="panel-title">Agosto<button class="derecha btn btn-xs" onclick="mostrar('ago');"><span class="glyphicon glyphicon-triangle-bottom" id="ago"></span></button></h3>
							</div>
							<div class="panel-body hide" id="cuerpoago">
								<ul class="list-group">
								<?php
								$i =0;
								foreach ($efemeride8 as $e8) {  ?>
									<li class="list-group-item list-group-item-warning" >
										<?php
										$fecha = new DateTime($e8->FECHA_EFEMERIDE);
										echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
										echo $fecha->format('d-m-Y');
										echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
										echo $e8->NOMBRE_EFEMERIDE;
										?>
										<button class="btn btn-xs badge" id="btn08<?php echo $i; ?>" onclick="ver('08<?php echo $i; ?>');"><span class="glyphicon glyphicon-plus" id="span08<?php echo $i; ?>"></span></button>
										<div class="hide" id="div08<?php echo $i; ?>">
											<br>
											<p class="efemeride m_r m_l">
												<?php echo $e8->DESCRIPCION_EFEMERIDE; ?>
											</p>
										</div>
											
									</li>
									<?php
									$i++;
								}
								?>									
								</ul>								
							</div>
						</div>
					<?php	
					}else {?>
						<div class="panel panel-info">
							<div class="panel-heading">
								<h3 class="panel-title">Agosto<button class="derecha btn btn-xs" disabled><span class="glyphicon glyphicon-triangle-bottom"></span></button></h3>
							</div>
						</div>
					<?php
					}
					if (isset($efemeride9)) {	?>
						<div class="panel panel-info">
							<div class="panel-heading">
								<h3 class="panel-title">Septiembre<button class="derecha btn btn-xs" onclick="mostrar('sep');"><span class="glyphicon glyphicon-triangle-bottom" id="sep"></span></button></h3>
							</div>
							<div class="panel-body hide" id="cuerposep">
								<ul class="list-group">
								<?php
								$i =0;
								foreach ($efemeride9 as $e9) {  ?>
									<li class="list-group-item list-group-item-warning" >
										<?php
										$fecha = new DateTime($e9->FECHA_EFEMERIDE);
										echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
										echo $fecha->format('d-m-Y');
										echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
										echo $e9->NOMBRE_EFEMERIDE;
										?>
										<button class="btn btn-xs badge" id="btn09<?php echo $i; ?>" onclick="ver('09<?php echo $i; ?>');"><span class="glyphicon glyphicon-plus" id="span09<?php echo $i; ?>"></span></button>
										<div class="hide" id="div09<?php echo $i; ?>">
											<br>
											<p class="efemeride m_r m_l">
												<?php echo $e9->DESCRIPCION_EFEMERIDE; ?>
											</p>
										</div>
											
									</li>
									<?php
									$i++;
								}
								?>									
								</ul>								
							</div>
						</div>
					<?php	
					}else {?>
						<div class="panel panel-info">
							<div class="panel-heading">
								<h3 class="panel-title">Septiembre<button class="derecha btn btn-xs" disabled><span class="glyphicon glyphicon-triangle-bottom"></span></button></h3>
							</div>
						</div>
					<?php
					}
					if (isset($efemeride10)) {	?>
						<div class="panel panel-info">
							<div class="panel-heading">
								<h3 class="panel-title">Octubre<button class="derecha btn btn-xs" onclick="mostrar('oct');"><span class="glyphicon glyphicon-triangle-bottom" id="oct"></span></button></h3>
							</div>
							<div class="panel-body hide" id="cuerpooct">
								<ul class="list-group">
								<?php
								$i =0;
								foreach ($efemeride10 as $e10) {  ?>
									<li class="list-group-item list-group-item-warning" >
										<?php
										$fecha = new DateTime($e10->FECHA_EFEMERIDE);
										echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
										echo $fecha->format('d-m-Y');
										echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
										echo $e10->NOMBRE_EFEMERIDE;
										?>
										<button class="btn btn-xs badge" id="btn010<?php echo $i; ?>" onclick="ver('010<?php echo $i; ?>');"><span class="glyphicon glyphicon-plus" id="span010<?php echo $i; ?>"></span></button>
										<div class="hide" id="div010<?php echo $i; ?>">
											<br>
											<p class="efemeride m_r m_l">
												<?php echo $e10->DESCRIPCION_EFEMERIDE; ?>
											</p>
										</div>
											
									</li>
									<?php
									$i++;
								}
								?>									
								</ul>								
							</div>
						</div>
					<?php	
					}else {?>
						<div class="panel panel-info">
							<div class="panel-heading">
								<h3 class="panel-title">Octubre<button class="derecha btn btn-xs" disabled><span class="glyphicon glyphicon-triangle-bottom"></span></button></h3>
							</div>
						</div>
					<?php
					}
					if (isset($efemeride11)) {	?>
						<div class="panel panel-info">
							<div class="panel-heading">
								<h3 class="panel-title">Noviembre<button class="derecha btn btn-xs" onclick="mostrar('nov');"><span class="glyphicon glyphicon-triangle-bottom" id="nov"></span></button></h3>
							</div>
							<div class="panel-body hide" id="cuerponov">
								<ul class="list-group">
								<?php
								$i =0;
								foreach ($efemeride11 as $e11) {  ?>
									<li class="list-group-item list-group-item-warning" >
										<?php
										$fecha = new DateTime($e11->FECHA_EFEMERIDE);
										echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
										echo $fecha->format('d-m-Y');
										echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
										echo $e11->NOMBRE_EFEMERIDE;
										?>
										<button class="btn btn-xs badge" id="btn11<?php echo $i; ?>" onclick="ver('11<?php echo $i; ?>');"><span class="glyphicon glyphicon-plus" id="span11<?php echo $i; ?>"></span></button>
										<div class="hide" id="div11<?php echo $i; ?>">
											<br>
											<p class="efemeride m_r m_l">
												<?php echo $e11->DESCRIPCION_EFEMERIDE; ?>
											</p>
										</div>
											
									</li>
									<?php
									$i++;
								}
								?>									
								</ul>								
							</div>
						</div>
					<?php	
					}else {?>
						<div class="panel panel-info">
							<div class="panel-heading">
								<h3 class="panel-title">Noviembre<button class="derecha btn btn-xs" disabled><span class="glyphicon glyphicon-triangle-bottom"></span></button></h3>
							</div>
						</div>
					<?php
					}
					if (isset($efemeride12)) {	?>
						<div class="panel panel-info">
							<div class="panel-heading">
								<h3 class="panel-title">Diciembre<button class="derecha btn btn-xs" onclick="mostrar('dic');"><span class="glyphicon glyphicon-triangle-bottom" id="dic"></span></button></h3>
							</div>
							<div class="panel-body hide" id="cuerpodic">
								<ul class="list-group">
								<?php
								$i =0;
								foreach ($efemeride12 as $e12) {  ?>
									<li class="list-group-item list-group-item-warning" >
										<?php
										$fecha = new DateTime($e12->FECHA_EFEMERIDE);
										echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
										echo $fecha->format('d-m-Y');
										echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
										echo $e12->NOMBRE_EFEMERIDE;
										?>
										<button class="btn btn-xs badge" id="btn12<?php echo $i; ?>" onclick="ver('12<?php echo $i; ?>');"><span class="glyphicon glyphicon-plus" id="span12<?php echo $i; ?>"></span></button>
										<div class="hide" id="div12<?php echo $i; ?>">
											<br>
											<p class="efemeride m_r m_l">
												<?php echo $e12->DESCRIPCION_EFEMERIDE; ?>
											</p>
										</div>
											
									</li>
									<?php
									$i++;
								}
								?>									
								</ul>								
							</div>
						</div>
					<?php	
					}else {?>
						<div class="panel panel-info">
							<div class="panel-heading">
								<h3 class="panel-title">Diciembre<button class="derecha btn btn-xs" disabled><span class="glyphicon glyphicon-triangle-bottom"></span></button></h3>
							</div>
						</div>
					<?php
					}
					?>							
				</div>		
			</div>

			<div class="col-md-3">
				<?php include("application/views/Aside/asideSup.php");?>
				<?php include("application/views/Aside/asideInf.php");?>
			</div>	
		</div>	
	</div>				
</section>