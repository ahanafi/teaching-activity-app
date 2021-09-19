<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
	<ul class="nav">
		<li class="nav-item nav-profile m-0 py-2 bg-green-gradient">
			<a href="<?php echo base_url('user/profile'); ?>" class="nav-link">
				<div class="profile-image">
					<img class="img-xs rounded-circle" src="<?php echo assets('images/faces/face8.jpg'); ?>"
						 alt="profile image">
					<div class="dot-indicator bg-success"></div>
				</div>
				<div class="text-wrapper">
					<p class="profile-name">
						<?php
						$namaLengkap = getUser('nama_lengkap');
						$arrNama = explode(" ", $namaLengkap);
						if (count($arrNama) > 2) {
							$namaLengkap = $arrNama[0] . " " . $arrNama[1];
						}
						echo $namaLengkap;
						?>
					</p>
					<p class="designation">( <?php echo showUserLevel(getUser('level'), true); ?> )</p>
				</div>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="<?php echo base_url('dashboard'); ?>">
				<i class="menu-icon typcn typcn-document-text"></i>
				<span class="menu-title">Dashboard</span>
			</a>
		</li>
		<?php if (showOnlyTo('SUPER_USER')): ?>
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
							<a class="nav-link" href="<?php echo base_url('mahasiswa') ?>">Data Mahasiswa</a>
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

		<?php if (!showOnlyTo('MAHASISWA')): ?>
			<!-- DOSEN -->
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
			<!-- END DOSEN -->
		<?php endif; ?>

		<?php if (showOnlyTo('MAHASISWA')): ?>
			<!-- MAHASISWA -->
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('jadwal-kuliah'); ?>">
					<i class="menu-icon typcn typcn-shopping-bag"></i>
					<span class="menu-title">Jadwal Perkuliahan</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('verifikasi-bap'); ?>">
					<i class="menu-icon typcn typcn-th-large-outline"></i>
					<span class="menu-title">Verifikasi BAP</span>
				</a>
			</li>
			<!-- END MAHASISWA -->
		<?php endif; ?>

		<?php if (showOnlyTo('SUPER_USER|KAPRODI')): ?>
			<?php if (showOnlyTo('KAPRODI')): ?>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo base_url('verifikasi-bap'); ?>">
						<i class="menu-icon typcn typcn-th-large-outline"></i>
						<span class="menu-title">Verifikasi BAP</span>
					</a>
				</li>
			<?php endif; ?>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('laporan'); ?>">
					<i class="menu-icon typcn typcn-bell"></i>
					<span class="menu-title">Laporan</span>
				</a>
			</li>
		<?php endif; ?>
		<?php if (showOnlyTo('SUPER_USER')): ?>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('user'); ?>">
					<i class="menu-icon typcn typcn-user-outline"></i>
					<span class="menu-title">Manajemen Pengguna</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url('tahun-akademik'); ?>">
					<i class="menu-icon typcn typcn-user-outline"></i>
					<span class="menu-title">Tahun Akademik</span>
				</a>
			</li>
		<?php endif; ?>
		<li class="nav-item">
			<a class="nav-link" onclick="confirmLogout()" href="#">
				<i class="menu-icon typcn typcn-user-outline"></i>
				<span class="menu-title">Logout</span>
			</a>
		</li>
	</ul>
</nav>
<!-- partial -->
