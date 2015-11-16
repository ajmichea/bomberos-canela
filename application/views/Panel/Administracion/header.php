<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<link href="<?php echo base_url(); ?>style/css/bootstrap.min2.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>style/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>style/css/personal_panel.css" rel="stylesheet" type="text/css" />
	<script src="<?php echo base_url();?>style/js/jquery-1.7.2.min.js"></script>
	<script src="<?php echo base_url();?>style/js/mask.js"></script>

	<link href="<?php echo base_url(); ?>style/css/font-awesome.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">

    
	<link href="<?php echo base_url(); ?>style/css/style.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>style/css/pages/signin.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>style/css/pages/dashboard.css" rel="stylesheet" type="text/css">
</head>
<body>
	<header>
		<div class="navbar navbar-fixed-top">
		  	<div class="navbar-inner">
		    	<div class="container"> 
		    		<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
			    		<span class="icon-bar"></span><span class="icon-bar"></span>
			    		<span class="icon-bar"></span> 
			    	</a>
			    	<a class="brand" href="<?php echo base_url() ?>Panel">Administrador Cuerpo de Bomberos de Canela</a>
			      	<div class="nav-collapse">
			        	<ul class="nav pull-right">
			          		<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
			                            class="icon-cog"></i> Account <b class="caret"></b></a>
			            		<ul class="dropdown-menu">
			              			<li><a href="javascript:;">Settings</a></li>
			              			<li><a href="<?php echo base_url()?>Panel/logout">Log out</a></li>
			            		</ul>
			          		</li>
			        	</ul>
			      	</div> 
		    	</div>
		  	</div>
		</div>
	</header>
	<section>
