<?php
defined('BASEPATH') or exit('No direct script access allowed');
$uri1 = $this->uri->segment(1);
$uri2 = $this->uri->segment(2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Sistem Pencatatan Kegiatan Dosen</title>
	<!-- plugins:css -->
	<link rel="stylesheet" href="<?php echo assets('vendors/iconfonts/mdi/css/materialdesignicons.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo assets('vendors/iconfonts/ionicons/dist/css/ionicons.css'); ?>">
	<link rel="stylesheet" href="<?php echo assets('vendors/iconfonts/font-awesome/css/font-awesome.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo assets('vendors/css/vendor.bundle.base.css'); ?>">
	<link rel="stylesheet" href="<?php echo assets('vendors/css/vendor.bundle.addons.css'); ?>">
	<!-- endinject -->
	<!-- plugin css for this page -->
	<link rel="stylesheet" href="<?php echo assets('vendors/datatables.net-bs4/dataTables.bootstrap4.css'); ?>">
	<link rel="stylesheet" href="<?php echo assets('vendors/sweetalert2/sweetalert2.css'); ?>">
	<link rel="stylesheet" href="<?php echo assets('vendors/summernote/dist/summernote-bs4.css'); ?>">
	<link rel="stylesheet" href="<?php echo assets('vendors/select2/select2.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo assets('vendors/select2-bootstrap-theme/select2-bootstrap.min.css'); ?>">
	<?php if(($uri1 === "berita-acara" || $uri1 === "jadwal-kuliah") && ($uri2 === "create" || $uri2 === "edit")): ?>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.9/flatpickr.min.css" integrity="sha512-OtwMKauYE8gmoXusoKzA/wzQoh7WThXJcJVkA29fHP58hBF7osfY0WLCIZbwkeL9OgRCxtAfy17Pn3mndQ4PZQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<?php endif; ?>

	<?php if(($uri1 === "verifikasi-bap" && $uri2 === "detail") || ($uri1 === "jadwal-kuliah" && ($uri2 === "create" || $uri2 === "edit"))): ?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css" integrity="sha512-8vq2g5nHE062j3xor4XxPeZiPjmRDh6wlufQlfC6pdQ/9urJkU07NM0tEREeymP++NczacJ/Q59ul+/K2eYvcg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<?php endif; ?>

	<!-- End plugin css for this page -->
	<!-- inject:css -->
	<link rel="stylesheet" href="<?php echo assets('css/shared/style.css'); ?>">
	<link rel="stylesheet" href="<?php echo assets('css/my-style.css'); ?>">
	<!-- endinject -->
	<!-- Layout styles -->
	<link rel="stylesheet" href="<?php echo assets('css/demo/style.css'); ?>">
	<!-- End Layout styles -->
	<link rel="shortcut icon" href="<?php echo assets('images/ucic.png'); ?>"/>
</head>
<body class="sidebar-fixed">
<div class="container-scroller">
