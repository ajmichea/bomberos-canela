<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	 <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $titulo ?> - Proyecto pueba</title>
	<link href="<?php echo base_url(); ?>style/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>style/css/personal.css" rel="stylesheet">
	<script type="text/javascript" src="<?php echo base_url(); ?>style/js/highslide-with-gallery.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>style/css/highslide.css" />
	<?php include("funciones/funciones.php");?>
	<?php include("funciones/Imagenes.php");?>
</head>
<body style="background: url(<?php echo base_url(); ?>Imagenes/fondo2.jpg) no-repeat center center fixed;background-size: cover;-moz-background-size: cover;-webkit-background-size: cover;-o-background-size: cover">
	<header>
		<div class="navbar-wrapper slider-principal">
			<div class="container">
				<div class="row">
				<div class="col-md-12">
					<nav class="navbar navbar2 navbar-default navbar-static-top">
						<div class="container container2">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#cabezera" aria-expanded="false" aria-controls="navbar">
									<span class="sr-only">Toggle navigation</span>
					                <span class="icon-bar"></span>
					                <span class="icon-bar"></span>
					                <span class="icon-bar"></span>
								</button>				
							</div>
							<div id="cabezera" class="navbar-collapse collapse">
				              	<ul class="nav navbar-nav">
					                <li class="active"><a href="<?php echo base_url(); ?>">Home</a></li>
					                <li class="dropdown">
					                  	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Bomberos <span class="caret"></span></a>
					                  	<ul class="dropdown-menu">
						                    <li><a href="<?php echo base_url(); ?>Home/Efemerides">Efemérides</a></li>
						                    <li><a href="<?php echo base_url(); ?>Home/Noticias/Destacadas">Noticias</a></li>
						                    <li><a href="<?php echo base_url(); ?>Home/Prevencion/Destacadas">Prevención y Seguridad</a></li>
					                  	</ul>
				                	</li>
					                <li><a href="<?php echo base_url(); ?>Home/Historia">Historia</a></li>
					                <li><a href="<?php echo base_url(); ?>Home/Galeria">Galería</a></li>
					                <li><a href="<?php echo base_url(); ?>Home/Himno">Himno</a></li>
					                <li><a href="<?php echo base_url(); ?>Home/Contacto">Contacto</a></li>
				              	</ul>
				            </div>
						</div>
					</nav>
				</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<img class="img-responsive img-banner" src="<?php echo base_url();?>Imagenes/banner.jpg">
				</div>				
			</div>
		</div>
    </header>            