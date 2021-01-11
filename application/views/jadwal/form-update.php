<div class="main-panel">
	<div class="content-wrapper">
		<!-- Page Title Header Starts-->
		<?php echo showPageHeader(); ?>
		<!-- Page Title Header Ends-->
		<div class="row">
			<div class="col-md-7 grid-margin stretch-card">
				<div class="card">
					<div class="card-header header-sm d-flex justify-content-between align-items-center">
						<h4 class="card-title">Form Tambah Jadwal</h4>
					</div>
					<div class="card-body">
						<form action="<?php echo base_url('jadwal-kuliah/edit/' . $jadwal->id_jadwal); ?>" class="form-sample" method="POST">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Hari</label>
										<div class="col-sm-8">
											<select name="hari" required class="form-control select2">
												<option disabled selected>-- Pilih Hari --</option>
												<?php foreach ($hari as $hari): ?>
													<option <?php echo ($jadwal->hari == $hari) ? "selected" : ""; ?>
															value="<?php echo $hari; ?>"><?php echo $hari; ?></option>
												<?php endforeach; ?>
											</select>
											<?php echo form_error('hari'); ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Jam</label>
										<div class="col-sm-4">
											<input type="text" name="jam_mulai" class="form-control" required value="<?php echo showJam($jadwal->jam_mulai); ?>">
											<?php echo form_error('jam_mulai'); ?>
										</div>
										<div class="col-sm-4">
											<input type="text" name="jam_selesai" class="form-control" required value="<?php echo showJam($jadwal->jam_selesai); ?>">
											<?php echo form_error('jam_selesai'); ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Kelas</label>
										<div class="col-sm-8">
											<select name="kelas" required class="form-control select2">
												<option disabled selected>-- Pilih Kelas --</option>
												<?php foreach ($kelas as $kelas): ?>
													<option <?php echo ($jadwal->id_kelas == $kelas->id_kelas) ? "selected" : ""; ?>
															value="<?php echo $kelas->id_kelas; ?>"><?php echo $kelas->nama_kelas; ?></option>
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
													<option <?php echo ($jadwal->id_mata_kuliah == $mk->id_mata_kuliah) ? "selected" : ""; ?>
															value="<?php echo $mk->id_mata_kuliah; ?>"><?php echo $mk->nama_mata_kuliah; ?></option>
												<?php endforeach; ?>
											</select>
											<?php echo form_error('mata_kuliah'); ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Dosen Pengampu</label>
										<div class="col-sm-8">
											<select name="dosen" required class="form-control select2">
												<option disabled selected>-- Pilih Dosen --</option>
												<?php foreach ($dosen as $dosen): ?>
													<option <?php echo ($jadwal->id_dosen == $dosen->id_dosen) ? "selected" : ""; ?>
															value="<?php echo $dosen->id_dosen; ?>"><?php echo $dosen->nama_lengkap; ?></option>
												<?php endforeach; ?>
											</select>
											<?php echo form_error('dosen'); ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Ruangan</label>
										<div class="col-sm-8">
											<select name="ruangan" required class="form-control select2">
												<option disabled selected>-- Pilih Ruangan --</option>
												<?php foreach ($ruangan as $ruangan): ?>
													<option <?php echo ($jadwal->id_ruangan == $ruangan->id_ruangan) ? "selected" : ""; ?>
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
