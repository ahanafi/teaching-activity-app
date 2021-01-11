<div class="main-panel">
	<div class="content-wrapper">
		<!-- Page Title Header Starts-->
		<?php echo showPageHeader(); ?>
		<!-- Page Title Header Ends-->
		<div class="row">
			<div class="col-md-6 grid-margin stretch-card">
				<div class="card">
					<div class="card-header header-sm d-flex justify-content-between align-items-center">
						<h4 class="card-title">Form Tambah Fakultas</h4>
					</div>
					<div class="card-body">
						<form action="<?php echo base_url('fakultas/create'); ?>" class="form-sample" method="POST"
							  enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Kode Fakultas</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="kode_fakultas"
												   value="<?php echo set_value('kode_fakultas'); ?>" required
												   autocomplete="off">
											<?php echo form_error('kode_fakultas'); ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Nama Fakultas</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="nama_fakultas"
												   value="<?php echo set_value('nama_fakultas'); ?>" required
												   autocomplete="off">
											<?php echo form_error('nama_fakultas'); ?>
										</div>
									</div>
									<div class="form-group row text-right">
										<div class="col-sm-8 offset-3">
											<button class="btn btn-success" type="submit" name="submit">SIMPAN</button>
											<a href="<?php echo base_url('fakultas'); ?>" class="btn btn-secondary">KEMBALI</a>
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
