<div class="main-panel">
	<div class="content-wrapper">
		<!-- Page Title Header Starts-->
		<?php echo showPageHeader(); ?>
		<!-- Page Title Header Ends-->
		<div class="row">
			<div class="col-md-6 grid-margin stretch-card">
				<div class="card">
					<div class="card-header header-sm d-flex justify-content-between align-items-center">
						<h4 class="card-title">Form Tambah Dosen</h4>
					</div>
					<div class="card-body">
						<form action="<?php echo base_url('dosen/create'); ?>" class="form-sample" method="POST"
							  enctype="multipart/form-data">
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">NIDN</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="nidn"
										   value="<?php echo set_value('nidn'); ?>" required autocomplete="off">
									<?php echo form_error('nidn'); ?>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Nama Lengkap</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="nama_lengkap"
										   value="<?php echo set_value('nama_lengkap'); ?>" required
										   autocomplete="off">
									<?php echo form_error('nama_lengkap'); ?>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Gelar</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="gelar"
										   value="<?php echo set_value('gelar'); ?>" placeholder="Contoh Gelar: SPd., MPd">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Jenis Kelamin</label>
								<div class="col-sm-4">
									<div class="form-radio">
										<label class="form-check-label">
											<input type="radio" class="form-check-input" name="jenis_kelamin"
												   value="L" <?php echo (set_value('jenis_kelamin') == 'L') ? "checked" : ""; ?>>
											Laki-Laki </label>
									</div>
								</div>
								<div class="col-sm-5">
									<div class="form-radio">
										<label class="form-check-label">
											<input type="radio" class="form-check-input" name="jenis_kelamin"
												   value="P" <?php echo (set_value('jenis_kelamin') == 'P') ? "checked" : ""; ?>>
											Perempuan </label>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Program Studi</label>
								<div class="col-sm-8">
									<select name="id_program_studi" id="" class="form-control select2">
										<option selected disabled>-- Pilih Program Studi --</option>
										<?php foreach ($program_studi as $prodi): ?>
											<option <?php echo (set_value('id_program_studi') === $prodi->id_program_studi) ? "selected" : ""; ?>
													value="<?php echo $prodi->id_program_studi; ?>"><?php echo $prodi->jenjang . " - " . $prodi->nama_program_studi; ?></option>
										<?php endforeach; ?>
									</select>
									<?php echo form_error('id_program_studi'); ?>
								</div>
							</div>
							<div class="form-group row text-right">
								<div class="col-sm-8 offset-3">
									<button class="btn btn-success" type="submit" name="submit">SIMPAN</button>
									<a href="<?php echo base_url('dosen'); ?>"
									   class="btn btn-secondary">KEMBALI</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- content-wrapper ends -->
