<div class="main-panel">
	<div class="content-wrapper">
		<!-- Page Title Header Starts-->
		<?php echo showPageHeader(); ?>
		<!-- Page Title Header Ends-->
		<div class="row">
			<div class="col-md-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Detail BAP</h4>
					</div>
					<div class="card-body">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="jadwal-tab" data-toggle="tab" href="#jadwal" role="tab"
								   aria-controls="jadwal" aria-selected="true">Jadwal</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="materi-tab" data-toggle="tab" href="#materi" role="tab"
								   aria-controls="materi" aria-selected="false">Bentuk dan Uraian Materi</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="bukti-tab" data-toggle="tab" href="#bukti" role="tab"
								   aria-controls="bukti" aria-selected="false">Bukti kegiatan</a>
							</li>
							<li class="nav-item">
								<a class="nav-link bg-primary text-white" id="verifikasi-tab" data-toggle="tab"
								   href="#verifikasi" role="tab"
								   aria-controls="verifikasi" aria-selected="false">Verifikasi</a>
							</li>
						</ul>
						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade " id="jadwal" role="tabpanel"
								 aria-labelledby="jadwal-tab">
								<div class="row">
									<div class="col-md-6">
										<h4 class="card-title">Jadwal Perkuliahan</h4>
										<table class="table table-bordered table-striped">
											<tr>
												<td>Hari</td>
												<td style="width: 10px;">:</td>
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
									</div>
									<div class="col-md-6">
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
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="materi" role="tabpanel" aria-labelledby="materi-tab">
								<h4 class="card-title">Bentuk Materi</h4>
								<table class="table table-bordered table-striped">
									<tr>
										<td style="vertical-align: top;">Aplikasi Daring</td>
										<td style="vertical-align: top;width:10px;">:</td>
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
								<br>
								<h4 class="card-title">Uraian Materi</h4>
								<div class="uraian-materi" style="border:1px solid #f1f1f1;padding:10px;">
									<?php echo($bap->uraian_materi); ?>
								</div>
							</div>
							<div class="tab-pane fade" id="bukti" role="tabpanel" aria-labelledby="bukti-tab">
								<h4 class="card-title">Foto Bukti Dokumentasi Perkuliahan</h4>
								<div class="row">
									<?php foreach ($dokumentasi as $dok): ?>
										<div class="col-md-4">
											<img src="<?php echo base_url($dok->lokasi); ?>" alt=""
												 class="img-fluid mb-2">
										</div>
									<?php endforeach; ?>
								</div>
							</div>
							<div class="tab-pane fade show active" id="verifikasi" role="tabpanel"
								 aria-labelledby="verifikasi-tab">
								<form action="<?php echo base_url('verifikasi-bap/verify/' . $bap->id_berita_acara); ?>"
									  class="form-sample form-verifikasi"
									  method="POST">
									<div class="row">
										<div class="col-md-12">
											<div class="alert alert-warning border-2x">
												<b>Perhatian :</b>
												Pastikan Anda telah mengunggah tanda tangan digital Anda pada aplikasi ini.
												Anda tidak dapat menyimpan verifikasi BAP sebelum Anda menggunggah tanda tangan digital Anda.
											</div>

											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Nomor Induk Mahasiswa</label>
												<div class="col-sm-4">
													<input type="text" class="form-control" name="nim"
														   value="<?php echo getUser('username'); ?>" readonly>
													<input type="hidden" name="verifikator" value="mahasiswa">
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Nama Mahasiswa</label>
												<div class="col-sm-4">
													<input type="text" name="nama_lengkap" class="form-control"
														   value="<?php echo getUser('nama_lengkap'); ?>" readonly>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Apakah Sesuai dengan <a
															target="_blank"
															href="https://duckduckgo.com/?q=apa+itu+rps+perkuliahan&atb=v288-5&ia=web">RPS</a>
													(?)</label>
												<div class="col-sm-2">
													<div class="icheck-primary icheck-inline">
														<input type="radio"
															   checked
															   name="sesuai_rps"
															   value="1" id="yes-multi">
														<label class="mt-1" for="yes-multi">YA</label>
													</div>
													<?php echo form_error('sesuai_rps'); ?>
												</div>
												<div class="col-sm-2">
													<div class="icheck-primary icheck-inline">
														<input type="radio"
															   name="sesuai_rps" value="0" id="no-multi">
														<label class="mt-1" for="no-multi">TIDAK</label>
													</div>
												</div>
												<input type="hidden" id="is-multi-class" name="is_multi_class" value="0"
													   required>
											</div>
											<div class="form-group row">
												<label class="col-sm-3 col-form-label">Catatan (Opsional)</label>
												<div class="col-sm-6">
													<textarea name="catatan" rows="5" placeholder="Catatan"
															  class="form-control"></textarea>
												</div>
											</div>
											<div class="form-group row">
												<div class="col-sm-6 offset-3">
													<button class="btn btn-success" type="submit" name="verify">SIMPAN</button>
													<a href="<?php echo base_url('jadwal-kuliah'); ?>"
													   class="btn btn-secondary">KEMBALI</a>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

