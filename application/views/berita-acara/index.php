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
						<?php if(!showOnlyTo('MAHASISWA')): ?>
						<a href="<?php echo base_url(uriSegment(1) . '/create'); ?>"
						   class="ml-auto btn btn-primary btn-fw">
							<i class="fa fa-plus"></i>
							<span>Tambah Data</span>
						</a>
						<?php endif; ?>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="order-listing" class="table table-striped table-bordered">
								<thead>
								<tr>
									<th rowspan="2" class="align-middle border-right">No.</th>
									<th colspan="4" class="text-center border-right">Jadwal</th>
									<th rowspan="2" class="align-middle border-right">Temu Ke</th>
									<th rowspan="2" class="align-middle border-right">Jml. Hadir</th>
									<th rowspan="2" class="border-right">Realisasi</th>
									<th class="border-right align-middle text-center" rowspan="2">Actions</th>
								</tr>
								<tr>
									<th class="border-right">Hari</th>
									<th class="border-right">Dosen</th>
									<th class="border-right">Mata Kuliah</th>
									<th class="border-right">SKS</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($berita_acara as $bap): ?>
									<tr>
										<td><?php echo $nomor++; ?></td>
										<td><?php echo ucfirst(strtolower($bap->hari)) . "<br>" . showJamKuliah($bap->jam_mulai, $bap->jam_selesai); ?></td>
										<td>
											<?php if (showOnlyTo('SUPER_USER')): ?>
												<a href="<?php echo base_url('dosen/detail/' . $bap->id_dosen); ?>"><?php echo namaDosen($bap->nama_dosen, $bap->gelar); ?></a>
											<?php else: echo namaDosen($bap->nama_dosen, $bap->gelar); endif; ?>
										</td>
										<td><?php echo $bap->nama_mata_kuliah; ?></td>
										<td class="text-center"><?php echo $bap->sks; ?></td>
										<td class="text-center"><?php echo $bap->pertemuan_ke; ?></td>
										<td class="text-center"><?php echo $bap->jumlah_hadir; ?></td>
										<td class="text-center"><?php echo Nim4n\SimpleDate::createFormat("dddd", $bap->tanggal_realisasi); ?></td>
										<td>
											<a href="<?php echo base_url('berita-acara/detail/' . $bap->id_berita_acara); ?>"
											   class="btn btn-info text-white">Detail</a>
											<?php if (showOnlyTo('SUPER_USER') || getUser('id_dosen') == $bap->id_dosen): ?>
												<a href="<?php echo base_url('berita-acara/edit/' . $bap->id_berita_acara); ?>"
												   class="btn btn-success text-white">Edit</a>
												<?php if (showOnlyTo("SUPER_USER")): ?>
													<a href="#"
													   onclick="showConfirmDelete('berita-acara', <?php echo $bap->id_berita_acara; ?>)"
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
