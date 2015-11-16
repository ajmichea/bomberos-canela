<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Document</title>

	<link href="<?php echo base_url(); ?>style/css/bootstrap.min2.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>style/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />

	<link href="<?php echo base_url(); ?>style/css/font-awesome.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
    
	<link href="<?php echo base_url(); ?>style/css/style.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>style/css/pages/signin.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="navbar navbar-fixed-top">
	
		<div class="navbar-inner">
			
			<div class="container">				
				<a class="brand" href="<?php echo base_url() ?>Panel">
					Administrador Cuerpo de Bomberos de Canela				
				</a>		
			</div> 
		</div> 
	</div>

	<div class="account-container">
		<div class="content clearfix">
			<?php echo form_open('Panel/ProcesaIngreso') ?>
			<?php $username = array(
				'name' => 'username',
			    'placeholder' => 'Username',
			    'class' => 'login username-field',
			    'type' => 'text');

			    $pass = array(
				'name' => 'password',
			    'placeholder' => 'Password',
			    'class' => 'login password-field',
			    'type' => 'password'); ?>

				<h1>Datos de Ingreso.</h1>					
				<div class="login-fields">
					<?php if(isset($datoError)){ ?>
						<div class="alert alert-danger"><strong><?php echo $datoError;?></strong></div>
					<?php } ?>
					<?php echo validation_errors('<div class="alert alert-danger"><strong>','</strong></div>') ?>
					<p>Complete los campos</p>
					<div class="field">
						<?php echo form_label('Username:','username')?>
						<?php echo form_input($username) ?>
					</div> 
					<div class="field">
						<?php echo form_label('Password:','password') ?>
						<?php echo form_input($pass) ?>
					</div> 
				</div> 

				<div class="login-actions">
					<span class="login-checkbox">
						<input id="Field" name="Field" type="checkbox" class="field login-checkbox" value="First Choice" tabindex="4" />
						<label class="choice" for="Field">Recordarme</label>
					</span>
					<?php echo form_submit('','Sign In','class="button btn btn-success btn-large"') ?>
				</div> 
			<?php echo form_close() ?>
		</div> 
	</div> 

	<div class="login-extra">
		<a href="#">Reset Password</a>
	</div> 

	<script src="<?php echo base_url();?>style/js/jquery-1.7.2.min.js"></script>
	<script src="<?php echo base_url();?>style/js/bootstrap.js"></script>

	<script src="<?php echo base_url();?>style/js/signin.js"></script>
</body>
</html>