<div class="main-panel">
	<div class="content-wrapper">
		<!-- Page Title Header Starts -->
		<?php echo showPageHeader(); ?>
		<!-- Page Title Header Ends -->
		<div class="row">
			<div class="col-md-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-header header-sm d-flex justify-content-between align-items-center">
						<h4 class="card-title">Berita Acara Perkuliahan</h4>
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
									<th>No.</th>
									<th>Hari</th>
									<th>Dosen</th>
									<th>Mata Kuliah</th>
									<th>SKS</th>
									<th>Waktu</th>
									<th>Temu Ke</th>
									<th>Jumlah Hadir</th>
									<th>Actions</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($berita_acara as $bap): ?>
									<tr>
										<td><?php echo $nomor++; ?></td>
										<td><?php echo $bap->hari; ?></td>
										<td>
											<a href="<?php echo base_url('dosen/detail/' . $bap->id_dosen); ?>"><?php echo namaDosen($bap->dosen, $bap->gelar); ?></a>
										</td>
										<td><?php echo $bap->mata_kuliah; ?></td>
										<td class="text-center"><?php echo $bap->sks; ?></td>
										<td>
											<?php echo showJamKuliah($bap->jam_mulai, $bap->jam_selesai); ?>
										</td>
										<td class="text-center"><?php echo $bap->pertemuan_ke; ?></td>
										<td class="text-center"><?php echo $bap->jumlah_hadir; ?></td>
										<td>
											<a href="<?php echo base_url('berita-acara/edit/' . $bap->id_berita_acara); ?>"
											   class="btn btn-success text-white">Edit</a>
											<a href="<?php echo base_url('berita-acara/detail/' . $bap->id_berita_acara); ?>"
											   class="btn btn-info text-white">Detail</a>
											<a href="#" onclick="showConfirmDelete('berita-acara', <?php echo $bap->id_berita_acara; ?>)" class="btn btn-danger">Hapus</a>
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
