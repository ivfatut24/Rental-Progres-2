<!DOCTYPE html>
<html class="no-js" lang="zxx">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--=== Favicon ===-->
	<link rel="shortcut icon"  href="<?php echo base_url('assets/cardoor/img/favicon.ico') ?>"  type="image/x-icon" />

	<title>Ciliwung Camp</title>

	<!--=== Bootstrap CSS ===-->
	<link rel="stylesheet" href="<?php echo base_url('assets/cardoor/css/bootstrap.min.css') ?>">
	<!--=== Vegas Min CSS ===-->
	<link rel="stylesheet" href="<?php echo base_url('assets/cardoor/css/plugins/vegas.min.css') ?>">
	<!--=== Slicknav CSS ===-->
	<link rel="stylesheet" href="<?php echo base_url('assets/cardoor/css/plugins/slicknav.min.css') ?>">
	<!--=== Magnific Popup CSS ===-->
	<link rel="stylesheet" href="<?php echo base_url('assets/cardoor/css/plugins/magnific-popup.css') ?>">
	<!--=== Owl Carousel CSS ===-->
	<link rel="stylesheet" href="<?php echo base_url('assets/cardoor/css/plugins/owl.carousel.min.css') ?>">
	<!--=== Gijgo CSS ===-->
	<link rel="stylesheet" href="<?php echo base_url('assets/cardoor/css/plugins/gijgo.css') ?>">
	<!--=== FontAwesome CSS ===-->
	<link rel="stylesheet" href="<?php echo base_url('assets/cardoor/css/font-awesome.css') ?>">
	<!--=== Theme Reset CSS ===-->
	<link rel="stylesheet" href="<?php echo base_url('assets/cardoor/css/reset.css') ?>">
	<!--=== Main Style CSS ===-->
	<link rel="stylesheet" href="<?php echo base_url('assets/cardoor/style.css') ?>">
	<!--=== Responsive CSS ===-->
	<link rel="stylesheet" href="<?php echo base_url('assets/cardoor/css/responsive.css') ?>">
	<!-- Stylesheets -->
    <!-- <link rel="stylesheet" href="<?php //echo base_url() ?>assets4/css/bootstrap.min.css"/> -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets4/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets4/css/owl.carousel.css"/>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets4/css/style.css"/>
	<link rel="stylesheet" href="<?php echo base_url() ?>assets4/css/animate.css"/>
	<link rel="stylesheet" href="<?php echo base_url('assets/cardoor/util.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/cardoor/style_new.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/cardoor/css/responsive_new.css') ?>">
</head>
<body class="loader-active">
	<!--== Header Area Start ==-->
	<div class="bg-black fixed-top">
		<nav class="navbar navbar-expand-lg mx-auto width">
			<a class="navbar-brand" href="<?php echo base_url("customer") ?>">
				<img src="<?php echo base_url() ?>assets/cardoor/img/logo-v2-putih.png" alt="Logo">
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav ml-auto">
					<a class="nav-item nav-link <?=  ($this->uri->segment(2) == '') ? 'active' : '' ; ?>"  href='<?php echo base_url("customer"); ?>'>Home <span class="sr-only">(current)</span></a>
					<a class="nav-item nav-link <?=  ($this->uri->segment(2) == 'produk') ? 'active' : '' ; ?>" href='<?php echo base_url("customer/produk"); ?>'>Produk</a>
					<a class="nav-item nav-link <?=  ($this->uri->segment(2) == 'keranjang') ? 'active' : '' ; ?>" href='<?php echo base_url("customer/keranjang"); ?>'>Keranjang</a>
					<span class="nav-item nav-link">Hi, <i><?= $this->session->userdata('nama');?></i></span>
					<a class="nav-item nav-link" href="<?= base_url('logout')?>" class="btn btn-default btn-flat" onClick="return confirm ('Apakah Anda Akan Keluar.?');"> Logout </a>
				</div>
			</div>
		</nav>
	</div>
	<!--== Header Area End ==-->
