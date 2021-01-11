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
			<div class="col-8 grid-margin stretch-card">
				<div class="card">
					<div class="card-header header-sm d-flex justify-content-between align-items-center">
						<h4 class="card-title">Form Tahun Akademik</h4>
					</div>
					<div class="card-body">
						<?php if (isset($is_edit) && $is_edit == false): ?>
							<div class="form-sample">
								<div class="row">
									<div class="col-9 offset-1">
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Tahun Akademik</label>
											<div class="col-sm-8">
												<input type="text" readonly value="<?php echo $tahun_akademik->tahun; ?>" class="form-control">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Semester</label>
											<div class="col-sm-8">
												<input type="text" readonly value="<?php echo $tahun_akademik->semester_akademik; ?>" class="form-control">
											</div>
										</div>
										<div class="form-group row text-right">
											<div class="col-sm-8 offset-4">
												<a href="<?php echo base_url('tahun-akademik') . "?is_edit=true";?>" class="btn btn-fw btn-success">
													<i class="fa fa-pencil"></i>
													<span>EDIT DATA</span>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php else: ?>
							<form action="<?php echo base_url('tahun-akademik'); ?>" class="form-sample" method="POST">
								<div class="row">
									<div class="col-9 offset-1">
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Tahun Akademik</label>
											<div class="col-sm-8">
												<select name="tahun" required class="form-control select2">
													<?php
														for($tahun = 2019; $tahun<=2025; $tahun++):
															$tahunAkd = $tahun."/".($tahun+1);
														?>
														<option <?php echo ($tahun_akademik->tahun == $tahunAkd) ? "selected" : ""; ?>
																value="<?php echo $tahunAkd; ?>"><?php echo $tahunAkd; ?></option>
													<?php endfor; ?>
												</select>
												<?php echo form_error('tahun'); ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Semester</label>
											<div class="col-sm-8">
												<select name="semester" required class="form-control select2">
													<option <?php echo ($tahun_akademik->semester_akademik == "GANJIL") ? "selected" : ""; ?> value="GANJIL">GANJIL</option>
													<option <?php echo ($tahun_akademik->semester_akademik == "GENAP") ? "selected" : ""; ?> value="GENAP">GENAP</option>
												</select>
												<?php echo form_error('semester'); ?>
											</div>
										</div>
										<div class="form-group row text-right">
											<div class="col-sm-8 offset-4">
												<a href="<?php echo base_url('tahun-akademik'); ?>" class="btn btn-fw btn-secondary">
													<i class="fa fa-chevron-left"></i>
													<span>KEMBALI</span>
												</a>
												<button class="btn btn-fw btn-primary" type="submit" name="update">
													<i class="fa fa-save"></i>
													<span>SIMPAN</span>
												</button>
											</div>
										</div>
									</div>
								</div>
							</form>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- content-wrapper ends -->
