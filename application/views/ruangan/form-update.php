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
			<div class="col-md-7 grid-margin stretch-card">
				<div class="card">
					<div class="card-header header-sm d-flex justify-content-between align-items-center">
						<h4 class="card-title">Form Tambah Ruang Kelas</h4>
					</div>
					<div class="card-body">
						<form action="<?php echo base_url('ruang-kelas/edit/' . $ruangan->id_ruangan); ?>" class="form-sample" method="POST">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Kode</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="kode_ruangan"
												   value="<?php echo $ruangan->kode_ruangan; ?>" required
												   autocomplete="off">
											<?php echo form_error('kode_ruangan'); ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Kapasitas</label>
										<div class="col-sm-8">
											<input type="number" class="form-control" name="kapasitas"
												   value="<?php echo $ruangan->kapasitas; ?>" required
												   autocomplete="off">
											<?php echo form_error('kapasitas'); ?>
										</div>
									</div>
									<div class="form-group row text-right">
										<div class="col-sm-8 offset-3">
											<button class="btn btn-success" type="submit" name="update">SIMPAN</button>
											<a href="<?php echo base_url('ruang-kelas'); ?>"
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