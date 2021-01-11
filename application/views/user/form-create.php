<div class="main-panel">
	<div class="content-wrapper">
		<!-- Page Title Header Starts-->
		<?php echo showPageHeader(); ?>
		<!-- Page Title Header Ends-->
		<div class="row">
			<div class="col-md-6 grid-margin stretch-card">
				<div class="card">
					<div class="card-header header-sm d-flex justify-content-between align-items-center">
						<h4 class="card-title">Form Tambah Pengguna</h4>
					</div>
					<div class="card-body">
						<form action="<?php echo base_url('user/create'); ?>" class="form-sample" method="POST"
							  enctype="multipart/form-data">
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Nama Lengkap</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="nama_lengkap"
										   value="<?php echo set_value('nama_lengkap'); ?>" required autocomplete="off">
									<?php echo form_error('nama_lengkap'); ?>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Username</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="username"
										   value="<?php echo set_value('username'); ?>" required autocomplete="off">
									<?php echo form_error('username'); ?>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Level</label>
								<div class="col-sm-8">
									<select class="form-control" name="level" required>
										<?php foreach ($user_level as $key => $val): ?>
											<option <?php echo (set_value('level') == $val) ? "selected" : ""; ?>
													value="<?php echo $key; ?>"><?php echo $val; ?></option>
										<?php endforeach; ?>
									</select>
									<?php echo form_error('level'); ?>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Password</label>
								<div class="col-sm-8">
									<input type="password" class="form-control" name="password" required
										   autocomplete="off">
									<?php echo form_error('password'); ?>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Ulangi Password</label>
								<div class="col-sm-8">
									<input type="password" class="form-control" name="konfirmasi_password" required
										   autocomplete="off">
									<?php echo form_error('konfirmasi_password'); ?>
								</div>
							</div>
							<div class="form-group row text-right">
								<div class="col-sm-8 offset-3">
									<button class="btn btn-success" type="submit" name="submit">SIMPAN</button>
									<a href="<?php echo base_url('user'); ?>" class="btn btn-secondary">KEMBALI</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- content-wrapper ends -->
