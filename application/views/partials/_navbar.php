<!-- partial:partials/_navbar.html -->
<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
	<div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-start">
		<a class="navbar-brand brand-logo pt-0" href="<?php echo base_url('dashboard'); ?>">
			<img src="<?php echo assets('images/ucic-yellow.png'); ?>" alt="logo"/> </a>
		<a class="navbar-brand brand-logo-mini pt-0" href="<?php echo base_url('dashboard'); ?>">
			<img src="<?php echo assets('images/ucic-simple.png'); ?>" alt="logo"/> </a>
	</div>
	<div class="navbar-menu-wrapper d-flex align-items-center">
		<ul class="navbar-nav">
			<li class="nav-item font-weight-semibold d-none d-lg-block">
				User :
				<?php echo getUser('nama_lengkap'); ?>
				<b>(<?php echo getUser('level'); ?>)</b> login at <?php echo $_SESSION['logged_in_at']; ?>
			</li>
		</ul>
		<ul class="navbar-nav ml-auto">
			<li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
				<a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown"
				   aria-expanded="false">
					<img class="img-xs rounded-circle" src="<?php echo assets('images/faces/face8.jpg'); ?>"
						 alt="Profile image">
					<span class="ml-2"><?php echo getUser('nama_lengkap'); ?></span>
				</a>
				<div class="dropdown-menu dropdown-menu-right navbar-dropdown user-dropdown-menu" aria-labelledby="UserDropdown">
					<div class="dropdown-header text-center">
						<img class="img-md rounded-circle" src="<?php echo assets('images/faces/face8.jpg'); ?>"
							 alt="Profile image">
						<p class="mb-1 mt-3 font-weight-semibold"><?php echo getUser('nama_lengkap'); ?></p>
						<p class="font-weight-light text-muted mb-0"><?php echo getUser('level'); ?></p>
					</div>
					<a href="<?php echo base_url('user/profile'); ?>" class="dropdown-item">
						Profil Saya
						<i class="dropdown-item-icon ti-dashboard"></i>
					</a>
					<?php if(!showOnlyTo('MAHASISWA')):?>
					<a href="<?php echo base_url('user/change-password'); ?>" class="dropdown-item">
						Ubah Kata Sandi
						<i class="dropdown-item-icon ti-comment-alt"></i>
					</a>
					<?php endif; ?>
					<a onclick="confirmLogout()" href="#" class="dropdown-item">
						Keluar
						<i class="dropdown-item-icon ti-power-off"></i>
					</a>
				</div>
			</li>
		</ul>
		<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
				data-toggle="offcanvas">
			<span class="mdi mdi-menu"></span>
		</button>
	</div>
</nav>
<!-- partial -->
<div class="container-fluid page-body-wrapper">
