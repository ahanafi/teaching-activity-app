<div class="main-panel">
	<div class="content-wrapper">
		<!-- Page Title Header Starts-->
		<?php echo showPageHeader(); ?>
		<!-- Page Title Header Ends-->
		<div class="row">
			<div class="col-md-5 grid-margin stretch-card">
				<div class="card">
					<div class="card-header header-sm d-flex justify-content-between align-items-center">
						<h4 class="card-title">Detail Data Dosen</h4>
					</div>
					<div class="card-body">
						<table class="table table-bordered table-striped">
							<tbody>
							<tr>
								<td>NIDN</td>
								<td>:</td>
								<td><?php echo $dosen->nidn; ?></td>
							</tr>
							<tr>
								<td>Nama Lengkap</td>
								<td>:</td>
								<td><?php echo $dosen->nama_lengkap; ?></td>
							</tr>
							<tr>
								<td>Gelar</td>
								<td>:</td>
								<td><?php echo $dosen->gelar; ?></td>
							</tr>
							<tr>
								<td>Jenis Kelamin</td>
								<td>:</td>
								<td><?php echo ($dosen->jenis_kelamin == "L") ? "Laki-laki" : "Perempuan"; ?></td>
							</tr>
							<tr>
								<td>Program Studi</td>
								<td>:</td>
								<td>
									<a href="<?php echo base_url('program-studi/detail/' . $dosen->id_program_studi) ?>"
									   class="btn-link">
										<?php echo $dosen->prodi; ?>
									</a>
								</td>
							</tr>
							</tbody>
						</table>
						<br>
						<a href="<?php echo base_url('dosen'); ?>" class="btn btn-secondary">KEMBALI</a>
					</div>
				</div>
			</div>
			<div class="col-md-7 grid-margin stretch-card">
				<div class="card">
					<div class="card-header header-sm d-flex justify-content-between align-items-center">
						<h4 class="card-title">Jadwal Kuliah : <b><?php echo $dosen->nama_lengkap; ?></b></h4>
					</div>
					<div class="card-body">
						<table class="table table-striped table-bordered">
							<thead>
							<tr>
								<th>No</th>
								<th>Hari</th>
								<th>Jam</th>
								<th>Kelas</th>
								<th>Mata Kuliah</th>
								<th>Ruangan</th>
							</tr>
							</thead>
							<tbody>
							<?php foreach ($jadwal as $jadwal): ?>
								<tr>
									<td><?php echo $nomor++; ?></td>
									<td><?php echo $jadwal->hari; ?></td>
									<td>
										<?php echo showJamKuliah($jadwal->jam_mulai, $jadwal->jam_selesai); ?>
									</td>
									<td><?php echo $jadwal->nama_kelas . "/" . $jadwal->semester; ?></td>
									<td><?php echo $jadwal->nama_mata_kuliah; ?></td>
									<td><?php echo $jadwal->kode_ruangan; ?></td>
								</tr>
							<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- content-wrapper ends -->
