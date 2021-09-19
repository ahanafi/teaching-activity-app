<div class="main-panel">
	<div class="content-wrapper">
		<!-- Page Title Header Starts-->
		<?php echo showPageHeader(); ?>
		<!-- Page Title Header Ends-->
		<div class="row">
			<div class="col-md-12 grid-margin mb-3">
				<div class="card">
					<div class="card-body no-gutter">
						<div class="d-flex align-items-center border-bottom py-3 px-4">
							<div class="d-flex align-items-end">
								<h4 class="font-weight-medium mb-0 ml-0 ml-md-3">
									Detail Berita Acara Perkuliahan
								</h4>
							</div>
							<a target="_blank"
							   href="<?php echo base_url('cetak/berita-acara/' . $bap->id_berita_acara); ?>"
							   class="ml-auto btn btn-primary btn-fw">
								<i class="fa fa-file-pdf-o"></i>
								<span>Cetak PDF</span>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 grid-margin stretch-card">
				<div class="card">
					<div class="card-header header-sm d-flex justify-content-between align-items-center">
						<h4 class="card-title">Berita Acara Perkuliahan</h4>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<h4 class="card-title">Jadwal Perkuliahan</h4>
								<table class="table table-bordered table-striped">
									<tr>
										<td>Hari</td>
										<td>:</td>
										<td><?php echo $bap->hari; ?></td>
									</tr>
									<tr>
										<td>Waktu</td>
										<td>:</td>
										<td><?php echo showJamKuliah($bap->jam_mulai, $bap->jam_selesai); ?></td>
									</tr>
									<tr>
										<td>Mata Kuliah</td>
										<td>:</td>
										<td><?php echo $bap->nama_mata_kuliah; ?></td>
									</tr>
									<tr>
										<td>Kelas</td>
										<td>:</td>
										<td><?php echo $bap->kelas; ?></td>
									</tr>
								</table>
								<br>
								<h4 class="card-title">Realisasi Kegiatan</h4>
								<table class="table table-bordered table-striped">
									<tr>
										<td>Tanggal</td>
										<td>:</td>
										<td><?php echo $bap->tanggal_realisasi; ?></td>
									</tr>
									<tr>
										<td>Waktu</td>
										<td>:</td>
										<td>
											<?php echo $bap->jam_mulai . "~" . $bap->jam_selesai; ?>
										</td>
									</tr>
									<tr>
										<td>Jumlah kehadiran</td>
										<td>:</td>
										<td>
											<b><?php echo $bap->jumlah_hadir; ?></b> dari
											<b><?php echo $bap->total_mahasiswa; ?></b> Mahasiswa
										</td>
									</tr>
									<tr>
										<td>Pertemuan ke</td>
										<td>:</td>
										<td><?php echo $bap->pertemuan_ke; ?></td>
									</tr>
								</table>
								<br>
								<h4 class="card-title">Bentuk Materi</h4>
								<table class="table table-bordered table-striped">
									<tr>
										<td style="vertical-align: top;">Aplikasi Daring</td>
										<td style="vertical-align: top;">:</td>
										<td>
											<?php foreach (explode(",", $bap->jenis_aplikasi) as $appCode): ?>
												<?php echo (trim($appCode) !== '') ? ucwords(daringApps(strtoupper(trim($appCode)))) : ""; ?>,
											<?php endforeach; ?>
										</td>
									</tr>
									<tr>
										<td>Bentuk Materi</td>
										<td>:</td>
										<td>
											<?php foreach (explode(",", $bap->bentuk_materi) as $materialCode): ?>
												<?php echo ucwords(materialType(strtoupper(trim($materialCode)))); ?>,
											<?php endforeach; ?>
										</td>
									</tr>
									<tr>
										<td>Pemberian tugas</td>
										<td>:</td>
										<td><?php echo($bap->ada_tugas === 1 ? "Ya" : "Tidak"); ?></td>
									</tr>
									<tr>
										<td>Pokok Bahasan</td>
										<td>:</td>
										<td><?php echo $bap->pokok_bahasan; ?></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 grid-margin stretch-card">
				<div class="card">
					<div class="card-header header-sm d-flex justify-content-between align-items-center">
						<h4 class="card-title">Bentuk materi dan Verifikasi Mahasiswa</h4>
					</div>
					<div class="card-body">
						<h4 class="card-title">Verifikasi Mahasiswa</h4>
						<table class="table table-bordered table-striped">
							<tr>
								<td style="width: 200px;">NIM</td>
								<td style="width: 10px;">:</td>
								<td>
									<?php echo ($verifikasi->nim) ?? '-'; ?>
								</td>
							</tr>
							<tr>
								<td>Nama Mahasiswa</td>
								<td>:</td>
								<td><?php echo ($verifikasi->nama_mahasiswa) ?? '-'; ?></td>
							</tr>
							<tr>
								<td>Tanda Tangan</td>
								<td>:</td>
								<td>
									<?php if (isset($verifikasi->nim) && $verifikasi->paraf_mahasiswa !== '' && file_exists(FCPATH . $verifikasi->paraf_mahasiswa)): ?>
										<img src="<?php echo base_url($verifikasi->paraf_mahasiswa); ?>"
											 alt="Paraf Mahasiswa" class="img-fluid img-signature">
									<?php else: echo "-"; endif; ?>
								</td>
							</tr>
							<tr>
								<td>Kesesuaian RPS</td>
								<td>:</td>
								<td>
									<?php echo isset($verifikasi) ? ($verifikasi->sesuai_rps_mahasiswa !== 0 ? 'SESUAI' : 'TIDAK') : '-'; ?>
								</td>
							</tr>
							<tr>
								<td>Catatan</td>
								<td>:</td>
								<td>
									<?php echo isset($verifikasi) ? $verifikasi->catatan_mahasiswa : '-'; ?>
								</td>
							</tr>
						</table>
						<br>
						<h4 class="card-title">Verifikasi Ketua Program Studi</h4>
						<table class="table table-bordered table-striped">
							<tr>
								<td style="width: 200px;">Tanggal Periksa</td>
								<td style="width: 10px;">:</td>
								<td>
									<?php echo ($verifikasi->tanggal_periksa) ?? '-'; ?>
								</td>
							</tr>
							<tr>
								<td>Nama Pemeriksa</td>
								<td>:</td>
								<td><?php echo isset($verifikasi) ? namaDosen($verifikasi->nama_dosen, $verifikasi->gelar) : '-'; ?></td>
							</tr>
							<tr>
								<td>Tanda Tangan</td>
								<td>:</td>
								<td>
									<?php if (isset($verifikasi->nidn_verifikator) && $verifikasi->paraf_dosen !== '' && file_exists(FCPATH . $verifikasi->paraf_dosen)): ?>
										<img src="<?php echo base_url($verifikasi->paraf_dosen); ?>"
											 alt="Paraf Pemeriksa" class="img-fluid img-signature">
									<?php else: echo "-"; endif; ?>
								</td>
							</tr>
							<tr>
								<td>Kesesuaian RPS</td>
								<td>:</td>
								<td>
									<?php echo isset($verifikasi) ? ($verifikasi->sesuai_rps_kaprodi !== 0 ? 'SESUAI' : 'TIDAK') : '-'; ?>
								</td>
							</tr>
							<tr>
								<td>Catatan</td>
								<td>:</td>
								<td>
									<?php echo isset($verifikasi) ? $verifikasi->catatan_kaprodi : '-'; ?>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="col-md-6 grid-margin">
				<div class="card">
					<div class="card-header header-sm d-flex justify-content-between align-items-center">
						<h4 class="card-title">Uraian Materi</h4>
					</div>
					<div class="card-body uraian-materi">
						<?php echo($bap->uraian_materi); ?>
					</div>
				</div>
			</div>
			<div class="col-md-6 grid-margin stretch-card">
				<div class="card">
					<div class="card-header header-sm d-flex justify-content-between align-items-center">
						<h4 class="card-title">Foto Dokumentasi Perkuliahan</h4>
					</div>
					<div class="card-body">
						<?php foreach ($dokumentasi as $dok): ?>
							<img src="<?php echo base_url($dok->lokasi); ?>" alt="" class="img-fluid mb-2">
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- content-wrapper ends -->
