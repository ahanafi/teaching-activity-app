<div class="main-panel">
	<div class="content-wrapper">
		<!-- Page Title Header Starts-->
		<?php echo showPageHeader(); ?>
		<!-- Page Title Header Ends-->
		<div class="row">
			<div class="col-md-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-header header-sm d-flex justify-content-between align-items-center">
						<h4 class="card-title">Data Jadwal</h4>
						<a href="<?php echo base_url(uriSegment(1) . '/create'); ?>"
						   class="ml-auto btn btn-primary btn-fw">
							<i class="fa fa-plus"></i>
							<span>Tambah Data</span>
						</a>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="order-listing" class="table table-striped">
								<thead>
								<tr>
									<th>Nomor</th>
									<th>Hari</th>
									<th>Jam</th>
									<th>Kelas</th>
									<th>Mata Kuliah</th>
									<th>Dosen Pengampu</th>
									<th>Ruangan</th>
									<th>Actions</th>
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
										<td><?php echo namaDosen($jadwal->dosen, $jadwal->gelar); ?></td>
										<td><?php echo $jadwal->kode_ruangan; ?></td>
										<td>
											<?php if (getUser('level') == "SUPER_USER" || getUser('id_dosen') == $jadwal->id_dosen): ?>
												<a href="<?php echo base_url('jadwal/edit/' . $jadwal->id_jadwal); ?>"
												   class="btn btn-success text-white">Edit</a>
												<?php if (getUser('level') == "SUPER_USER"): ?>
													<a href="#"
													   onclick="showConfirmDelete('jadwal', <?php echo $jadwal->id_jadwal; ?>)"
													   class="btn btn-danger">Hapus</a>
												<?php endif; ?>
											<?php endif; ?>
										</td>
									</tr>
								<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- content-wrapper ends -->
