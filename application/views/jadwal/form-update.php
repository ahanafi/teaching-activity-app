<div class="main-panel">
	<div class="content-wrapper">
		<!-- Page Title Header Starts-->
		<?php echo showPageHeader(); ?>
		<!-- Page Title Header Ends-->
		<div class="row">
			<div class="col-md-7 grid-margin stretch-card">
				<div class="card">
					<div class="card-header header-sm d-flex justify-content-between align-items-center">
						<h4 class="card-title">Form Edit Jadwal</h4>
					</div>
					<div class="card-body">
						<form action="<?php echo base_url('jadwal-kuliah/edit/' . $jadwal->id_jadwal); ?>"
							  class="form-sample" method="POST">
							<div class="row">
								<div class="col-md-12">
									<div class="alert alert-warning border-2x">
										<b>Informasi :</b>
										Silahkan centang <b>YA</b> pilihan <b>Multi Kelas</b> apabila jadwal perkuliahan
										digabungkan dengan kelas lain (banyak kelas).
									</div>

									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Hari</label>
										<div class="col-sm-8">
											<select name="hari" required class="form-control select2">
												<option disabled selected>-- Pilih Hari --</option>
												<?php foreach ($hari as $hari): ?>
													<option <?php echo ($jadwal->hari === $hari) ? "selected" : ""; ?>
															value="<?php echo $hari; ?>"><?php echo $hari; ?></option>
												<?php endforeach; ?>
											</select>
											<?php echo form_error('hari'); ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Jam</label>
										<div class="col-sm-4">
											<input type="text" name="jam_mulai" class="form-control" required
												   value="<?php echo showJam($jadwal->jam_mulai); ?>">
											<?php echo form_error('jam_mulai'); ?>
										</div>
										<div class="col-sm-4">
											<input type="text" name="jam_selesai" class="form-control" required
												   value="<?php echo showJam($jadwal->jam_selesai); ?>">
											<?php echo form_error('jam_selesai'); ?>
										</div>
									</div>

									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Multi Kelas (?)</label>
										<div class="col-sm-3">
											<div class="icheck-primary icheck-inline">
												<input onclick="setMultiClass(true)" <?php echo ($jadwal->multi_kelas === '1') ? 'checked' : ''; ?>
													   type="radio" name="multi_kelas"
													   value="1" id="yes-multi">
												<label class="mt-1" for="yes-multi">YA</label>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="icheck-primary icheck-inline">
												<input onclick="setMultiClass(false)" <?php echo ($jadwal->multi_kelas === '0') ? 'checked' : ''; ?>
													   type="radio"
													   name="multi_kelas" value="1" id="no-multi">
												<label class="mt-1" for="no-multi">TIDAK</label>
											</div>
										</div>
										<input type="hidden" id="is-multi-class" name="is_multi_class"
											   value="<?php echo $jadwal->multi_kelas; ?>"
											   required>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Kelas</label>
										<div class="col-sm-8">
											<select name="kelas[]" <?php echo ($jadwal->multi_kelas === '1') ? 'multiple' : ''; ?>
													required class="form-control select2">
												<option disabled>-- Pilih Kelas --</option>
												<?php foreach ($kelas as $kelas): ?>
													<option <?php echo (in_array($kelas->nama_kelas . '/' . $kelas->semester, explode(", ", trim($jadwal->kelas)), true)) ? "selected" : ""; ?>
															value="<?php echo $kelas->id_kelas; ?>"><?php echo $kelas->nama_kelas . '/' . $kelas->semester; ?></option>
												<?php endforeach; ?>
											</select>
											<?php echo form_error('kelas'); ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Mata Kuliah</label>
										<div class="col-sm-8">
											<select name="mata_kuliah" required class="form-control select2">
												<option disabled selected>-- Pilih Mata Kuliah --</option>
												<?php foreach ($mata_kuliah as $mk): ?>
													<option <?php echo ($jadwal->id_mata_kuliah === $mk->id_mata_kuliah) ? "selected" : ""; ?>
															value="<?php echo $mk->id_mata_kuliah; ?>"><?php echo $mk->nama_mata_kuliah; ?></option>
												<?php endforeach; ?>
											</select>
											<?php echo form_error('mata_kuliah'); ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Dosen Pengampu</label>
										<div class="col-sm-8">
											<?php if (getUser('level') === 'SUPER_USER'): ?>
												<select name="dosen" required class="form-control select2">
													<option disabled selected>-- Pilih Dosen --</option>
													<?php foreach ($dosen as $dosen): ?>
														<option <?php echo ($jadwal->id_dosen === $dosen->id_dosen) ? "selected" : ""; ?>
																value="<?php echo $dosen->id_dosen; ?>"><?php echo $dosen->nama_lengkap; ?></option>
													<?php endforeach; ?>
												</select>
											<?php else: ?>
												<input type="text"
													   value="<?php echo namaDosen($dosen->nama_lengkap, $dosen->gelar); ?>"
													   readonly class="form-control">
												<input type="hidden" name="dosen"
													   value="<?php echo $dosen->id_dosen; ?>">
											<?php endif; ?>
											<?php echo form_error('dosen'); ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Ruangan</label>
										<div class="col-sm-8">
											<select name="ruangan" required class="form-control select2">
												<option disabled selected>-- Pilih Ruangan --</option>
												<?php foreach ($ruangan as $ruangan): ?>
													<option <?php echo ($jadwal->id_ruangan === $ruangan->id_ruangan) ? "selected" : ""; ?>
															value="<?php echo $ruangan->id_ruangan; ?>"><?php echo $ruangan->kode_ruangan . " ($ruangan->kapasitas)"; ?></option>
												<?php endforeach; ?>
											</select>
											<?php echo form_error('ruangan'); ?>
										</div>
									</div>
									<div class="form-group row text-right">
										<div class="col-sm-8 offset-3">
											<button class="btn btn-success" type="submit" name="update">SIMPAN</button>
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
	<!-- content-wrapper ends -->
