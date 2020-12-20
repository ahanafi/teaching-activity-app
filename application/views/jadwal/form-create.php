<div class="main-panel">
	<div class="content-wrapper">
		<!-- Page Title Header Starts-->
		<div class="row page-title-header">
			<div class="col-12">
				<div class="page-header">
					<h4 class="page-title">Dashboard</h4>
					<div class="quick-link-wrapper w-100 d-md-flex flex-md-wrap">
						<ul class="quick-links ml-auto">
							<li><a href="#">Settings</a></li>
							<li><a href="#">Analytics</a></li>
							<li><a href="#">Watchlist</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- Page Title Header Ends-->
		<div class="row">
			<div class="col-md-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-header header-sm d-flex justify-content-between align-items-center">
						<h4 class="card-title">Form Tambah Dosen</h4>
					</div>
					<div class="card-body">
						<form action="<?php echo base_url('dosen/create'); ?>" class="form-sample" method="POST"
							  enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-6">
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
										<label class="col-sm-3 col-form-label">Jenis Kelamin</label>
										<div class="col-sm-4">
											<div class="form-radio">
												<label class="form-check-label">
													<input type="radio" class="form-check-input" name="jenis_kelamin"
														   value="L" <?php echo (set_value('jenis_kelamin') == 'L') ? "checked" : ""; ?>> Laki-Laki </label>
											</div>
										</div>
										<div class="col-sm-5">
											<div class="form-radio">
												<label class="form-check-label">
													<input type="radio" class="form-check-input" name="jenis_kelamin"
														   value="P" <?php echo (set_value('jenis_kelamin') == 'P') ? "checked" : ""; ?>> Perempuan </label>
											</div>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Tempat Lahir</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="tempat_lahir"
												   value="<?php echo set_value('tempat_lahir'); ?>" required
												   autocomplete="off">
											<?php echo form_error('tempat_lahir'); ?>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Tanggal Lahir</label>
										<div class="col-sm-8">
											<input type="date" class="form-control" name="tanggal_lahir" required
												   autocomplete="off" value="<?php echo set_value('tanggal_lahir'); ?>">
											<?php echo form_error('tanggal_lahir'); ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Alamat</label>
										<div class="col-sm-8">
											<textarea name="alamat" rows="4"
													  class="form-control"><?php echo set_value('alamat'); ?></textarea>
											<?php echo form_error('alamat'); ?>
										</div>
									</div>
									<div class="form-group row text-right">
										<div class="col-sm-8 offset-3">
											<button class="btn btn-success" type="submit" name="submit">SIMPAN</button>
											<a href="<?php echo base_url('dosen'); ?>"
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
