<div class="main-panel">
	<div class="content-wrapper">
		<!-- Page Title Header Starts-->
		<?php echo showPageHeader(); ?>
		<!-- Page Title Header Ends-->
		<form action="<?php echo base_url('berita-acara/create'); ?>" class="form-sample" method="POST"
			  enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-6 grid-margin stretch-card">
					<div class="card">
						<div class="card-header header-sm d-flex justify-content-between align-items-center">
							<h4 class="card-title">Form Tambah Berita Acara Perkuliahan</h4>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Jadwal</label>
										<div class="col-sm-8">
											<select name="id_jadwal" required class="form-control select2">
												<option disabled selected>-- Pilih Jadwal --</option>
												<?php foreach ($jadwal as $jadwal): ?>
													<option <?php echo (set_value('id_jadwal') === $jadwal->id_jadwal) ? "selected" : ""; ?>
															value="<?php echo $jadwal->id_jadwal; ?>">
														<?php echo $jadwal->hari . " - " . showJamKuliah($jadwal->jam_mulai, $jadwal->jam_selesai) . " - " . $jadwal->nama_mata_kuliah . " - " . $jadwal->kelas ." - " . namaDosen($jadwal->nama_lengkap, $jadwal->gelar); ?>
													</option>
												<?php endforeach; ?>
											</select>
											<?php echo form_error('id_jadwal'); ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Tanggal Realisasi</label>
										<div class="col-sm-8">
											<input type="text" name="tanggal" class="form-control" required
												   value="<?php echo set_value('tanggal'); ?>">
											<?php echo form_error('tanggal'); ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Waktu</label>
										<div class="col-sm-4">
											<input type="text" name="jam_mulai" class="form-control" required placeholder="Jam Mulai"
												  autocomplete="off" value="<?php echo set_value('jam_mulai'); ?>">
											<?php echo form_error('jam_mulai'); ?>
										</div>
										<div class="col-sm-4">
											<input type="text" name="jam_selesai" class="form-control" required placeholder="Jam Selesai"
												  autocomplete="off" value="<?php echo set_value('jam_selesai'); ?>">
											<?php echo form_error('jam_selesai'); ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Jumlah kehadiran</label>
										<div class="col-sm-3">
											<input type="number" min="1" name="jumlah_hadir" class="form-control" autocomplete="off"
												   placeholder="Jumlah Hadir" value="<?php echo set_value('jumlah_hadir'); ?>">
											<?php echo form_error('jumlah_hadir'); ?>
										</div>
										<label class="col-sm-2 col-form-label">Dari</label>
										<div class="col-sm-3">
											<input type="number" min="1" name="total_mahasiswa" class="form-control" autocomplete="off"
												   placeholder="Total Mahasiswa" value="<?php echo set_value('total_mahasiswa'); ?>">
											<?php echo form_error('total_mahasiswa'); ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Pertemuan ke</label>
										<div class="col-sm-4">
											<input type="number" name="pertemuan_ke" min="1" max="14" minlength="1"
												   maxlength="2" class="form-control" required
												   placeholder="Pertemuan ke: .." value="<?php echo set_value('pertemuan_ke'); ?>">
											<?php echo form_error('pertemuan_ke'); ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 grid-margin stretch-card">
					<div class="card">
						<div class="card-header header-sm d-flex justify-content-between align-items-center">
							<h4 class="card-title">Bentuk materi dan Penugasan</h4>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Aplikasi Daring</label>
										<div class="col-sm-9">
											<div class="row">
												<?php foreach (daringApps() as $appCode => $appName):?>
												<div class="col-sm-4">
													<div class="form-check form-check-flat mt-1">
														<label class="form-check-label">
															<input <?php echo (set_value('jenis_aplikasi') !== '' && in_array(strtolower($appCode), set_value('jenis_aplikasi'))) ? "checked" : ""; ?>
																	value="<?php echo strtolower($appCode); ?>"
																	name="jenis_aplikasi[]"
																	type="checkbox"
																	class="form-check-input"
																	<?php echo ($appCode === 'LAINNYA') ? "onclick='toggleOtherApp(this)'" : ""; ?>
																	data-checked="false"
															>
															<?php echo ucwords($appName); ?>
														</label>
													</div>
												</div>
												<?php endforeach; ?>
											</div>
											<?php echo form_error('jenis_aplikasi'); ?>
										</div>
										<div class="col-sm-8 offset-3" id="otherAppName"></div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Bentuk Materi</label>
										<div class="col-sm-9">
											<div class="row">
												<?php foreach (materialType() as $materialCode => $materialName):?>
												<div class="col-sm-4">
													<div class="form-check form-check-flat mt-1">
														<label class="form-check-label">
															<input <?php echo (set_value('bentuk_materi') !== '' && in_array(strtolower($materialCode), set_value('bentuk_materi'))) ? "checked" : ""; ?> value="<?php echo strtolower($materialCode); ?>" name="bentuk_materi[]" type="checkbox" class="form-check-input">
															<?php echo ucwords($materialName); ?>
														</label>
													</div>
												</div>
												<?php endforeach; ?>
											</div>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Pemberian tugas</label>
										<div class="col-sm-4">
											<div class="form-radio">
												<label class="form-check-label">
													<input type="radio" class="form-check-input" name="penugasan"
														   id="penugasan" value="1" <?php echo (set_value('penugasan') == 1 ? "checked" : ""); ?> >
													Ya <i class="input-helper"></i>
												</label>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-radio">
												<label class="form-check-label">
													<input type="radio" class="form-check-input" name="penugasan"
														   id="penugasan" value="0" <?php echo (set_value('penugasan') == 0 ? "checked" : ""); ?> >
													Tidak <i class="input-helper"></i>
												</label>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12 grid-margin stretch-card">
					<div class="card">
						<div class="card-header header-sm d-flex justify-content-between align-items-center">
							<h4 class="card-title">Verifikasi Mahasiswa dan Uraian Materi</h4>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Pokok Bahasan</label>
										<div class="col-sm-10">
											<input type="text" name="pokok_bahasan" placeholder="Pokok bahasan materi"
												   class="form-control" value="<?php echo set_value('pokok_bahasan'); ?>" autocomplete="off">
											<?php echo form_error('pokok_bahasan'); ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Uraian Materi</label>
										<div class="col-sm-10">
											<textarea name="uraian_materi" id="uraian_materi" required><?php echo set_value('uraian_materi'); ?></textarea>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Bukti Kegiatan</label>
										<div class="col-sm-10">
											<input type="file" name="bukti_kegiatan[]" id="bukti_kegiatan" multiple
												   maxlength="3" onchange="readURL(this)" required
												   class="form-control"/>
											<?php if (isset($error) && $error !== ''): ?>
												<div class="mt-2">
													<span class="error text-danger"><?php echo $error; ?></span>
												</div>
											<?php endif; ?>

											<div class="alert alert-info mt-2" style="border-radius: 0px;">
												<b>Perhatian : </b> <br>
												<ul>
													<li><u>File ukuran foto adalah <b>maksimal 2Mb</b></u></li>
													<li><u>Resolusi foto yang upload adalah <b>maksimal 1280x768 pixel</b></u></li>
													<li><u>Jenis format foto yang diizinkan adalah <b>JPG, JPEG, dan PNG.</b></u></li>
												</ul>
											</div>
											<div id="preview" class="row mt-2"></div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12 text-center">
											<button type="submit" name="submit" class="btn btn-primary btn-lg">
												<span>SIMPAN DATA</span>
											</button>
											<a href="<?php echo base_url('berita-acara'); ?>" class="btn btn-secondary btn-lg">
												<span>KEMBALI</span>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	<!-- content-wrapper ends -->
