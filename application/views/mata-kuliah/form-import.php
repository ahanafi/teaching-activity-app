<div class="main-panel">
	<div class="content-wrapper">
		<!-- Page Title Header Starts-->
		<?php echo showPageHeader(); ?>
		<!-- Page Title Header Ends-->
		<div class="row">
			<div class="col-md-6 grid-margin stretch-card">
				<div class="card">
					<div class="card-header header-sm d-flex justify-content-between align-items-center">
						<h4 class="card-title">Form Tambah Mata Kuliah</h4>
					</div>
					<div class="card-body">
						<form action="<?php echo base_url('mata-kuliah/create'); ?>" class="form-sample" method="POST"
							  enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Template File</label>
										<div class="col-sm-8">
											<a href="<?php echo base_url('download/template/import-mk'); ?>" class="btn btn-primary btn-fw">
												<i class="fa fa-download"></i>
												<span>Download Template</span>
											</a>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Upload File</label>
										<div class="col-sm-8">
											<input type="file" class="form-control" name="file" required
												   autocomplete="off">
											<?php echo form_error('file'); ?>
										</div>
									</div>
									<div class="form-group row text-right">
										<div class="col-sm-8 offset-3">
											<button class="btn btn-success" type="submit" name="submit">IMPORT</button>
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
			<div class="col-md-6 grid-margin stretch-card">
				<div class="card">
					<div class="card-header header-sm d-flex justify-content-between align-items-center">
						<h4 class="card-title">Petunjuk Import Data Mata Kuliah</h4>
					</div>
					<div class="card-body">
						<div class="alert alert-success no-border-radius">
							<b>Langkah-langkah import data :</b>
							<ol>
								<li>Silahkan unduh template excel untuk import data mata kuliah di samping.</li>
								<li>Isi data mata kuliah yang akan di import ke aplikasi sesuai dengan format yang sudah tersedia.</li>
								<li>Jika data sudah siap, silahkan upload file template yang sudah diisi data mata kuliah yang akan diimport.</li>
								<!--<li>Apabila ada kesulitan, silahkan hubungi Administrator/Staff IT.</li>-->
							</ol>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- content-wrapper ends -->
