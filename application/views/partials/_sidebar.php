		<!-- partial:partials/_sidebar.html -->
		<nav class="sidebar sidebar-offcanvas" id="sidebar">
			<ul class="nav">
				<li class="nav-item nav-profile">
					<a href="#" class="nav-link">
						<div class="profile-image">
							<img class="img-xs rounded-circle" src="<?php echo assets('images/faces/face8.jpg'); ?>" alt="profile image">
							<div class="dot-indicator bg-success"></div>
						</div>
						<div class="text-wrapper">
							<p class="profile-name"><?php echo getUser('nama_lengkap');?></p>
							<p class="designation"><?php echo str_replace("_", " ", getUser('level'));?></p>
						</div>
					</a>
				</li>
				<li class="nav-item nav-category">Main Menu</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo base_url('dashboard'); ?>">
						<i class="menu-icon typcn typcn-document-text"></i>
						<span class="menu-title">Dashboard</span>
					</a>
				</li>
				<?php if(showOnlyTo('SUPER_USER')):?>
				<li class="nav-item">
					<a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
					   aria-controls="ui-basic">
						<i class="menu-icon typcn typcn-coffee"></i>
						<span class="menu-title">Data Master</span>
						<i class="menu-arrow"></i>
					</a>
					<div class="collapse" id="ui-basic">
						<ul class="nav flex-column sub-menu">
							<li class="nav-item">
								<a class="nav-link" href="<?php echo base_url('fakultas') ?>">Data Fakultas</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="<?php echo base_url('program-studi') ?>">Data Program Studi</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="<?php echo base_url('dosen') ?>">Data Dosen</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="<?php echo base_url('kelas') ?>">Data Kelas</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="<?php echo base_url('mata-kuliah') ?>">Data Mata Kuliah</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="<?php echo base_url('ruangan') ?>">Data Ruang Kelas</a>
							</li>
						</ul>
					</div>
				</li>
				<?php endif; ?>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo base_url('jadwal-kuliah'); ?>">
						<i class="menu-icon typcn typcn-shopping-bag"></i>
						<span class="menu-title">Jadwal Perkuliahan</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo base_url('berita-acara'); ?>">
						<i class="menu-icon typcn typcn-th-large-outline"></i>
						<span class="menu-title">Berita Acara Perkuliahan</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo base_url('laporan'); ?>">
						<i class="menu-icon typcn typcn-bell"></i>
						<span class="menu-title">Laporan</span>
					</a>
				</li>
				<?php if(showOnlyTo('SUPER_USER')):?>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo base_url('user'); ?>">
						<i class="menu-icon typcn typcn-user-outline"></i>
						<span class="menu-title">Manajemen Pengguna</span>
					</a>
				</li>
				<?php endif; ?>
			</ul>
		</nav>
		<!-- partial -->
