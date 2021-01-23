<div class="main-panel">
	<div class="content-wrapper">
		<!-- Page Title Header Starts-->
		<?php echo showPageHeader(); ?>
		<!-- Page Title Header Ends-->
		<div class="row">
			<div class="col-md-6 grid-margin stretch-card">
				<div class="card">
					<div class="card-header header-sm d-flex justify-content-between align-items-center">
						<h4 class="card-title">Form Ubah Password</h4>
					</div>
					<div class="card-body">
						<form action="<?php echo base_url('user/change-password'); ?>" class="form-sample" method="POST">
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Password Lama</label>
								<div class="col-sm-8">
									<input type="password" class="form-control" name="old_password" placeholder="Masukkan password lama"
										   required autocomplete="off">
									<?php echo form_error('old_password'); ?>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Password Baru</label>
								<div class="col-sm-8">
									<input type="password" class="form-control" name="new_password" required
										   autocomplete="off" placeholder="Masukkan password baru">
									<?php echo form_error('new_password'); ?>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Ulangi Password</label>
								<div class="col-sm-8">
									<input type="password" class="form-control" name="konfirmasi_password" required
										   autocomplete="off" placeholder="Ketik ulang password baru">
									<?php echo form_error('konfirmasi_password'); ?>
								</div>
							</div>
							<div class="form-group row text-right">
								<div class="col-sm-8 offset-3">
									<button class="btn btn-success" type="submit" name="update-password">SIMPAN</button>
									<a href="<?php echo base_url('user/profile'); ?>" class="btn btn-secondary">KEMBALI</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- content-wrapper ends -->
