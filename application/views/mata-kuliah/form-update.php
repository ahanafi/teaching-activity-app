<div class="main-panel">
	<div class="content-wrapper">
		<!-- Page Title Header Starts-->
		<?php echo showPageHeader(); ?>
		<!-- Page Title Header Ends-->
		<div class="row">
			<div class="col-md-7 grid-margin stretch-card">
				<div class="card">
					<div class="card-header header-sm d-flex justify-content-between align-items-center">
						<h4 class="card-title">Form Edit Mata Kuliah</h4>
					</div>
					<div class="card-body">
						<form action="<?php echo base_url('mata-kuliah/edit/' . $mata_kuliah->id_mata_kuliah); ?>" class="form-sample" method="POST"
							  enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Kode Mata Kuliah</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="kode_mata_kuliah"
												   value="<?php echo $mata_kuliah->kode_mata_kuliah; ?>" required
												   autocomplete="off">
											<?php echo form_error('kode_mata_kuliah'); ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Nama Mata Kuliah</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="nama_mata_kuliah"
												   value="<?php echo $mata_kuliah->nama_mata_kuliah; ?>" required
												   autocomplete="off">
											<?php echo form_error('nama_mata_kuliah'); ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Jumlah SKS</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="sks"
												   value="<?php echo $mata_kuliah->sks; ?>" required
												   autocomplete="off">
											<?php echo form_error('sks'); ?>
										</div>
									</div>
									<div class="form-group row text-right">
										<div class="col-sm-8 offset-3">
											<button class="btn btn-success" type="submit" name="update">SIMPAN</button>
											<a href="<?php echo base_url('mata-kuliah'); ?>"
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
