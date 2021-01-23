<div class="main-panel">
	<div class="content-wrapper">
		<!-- Page Title Header Starts-->
		<?php echo showPageHeader(); ?>
		<!-- Page Title Header Ends-->
		<div class="row">
			<div class="col-md-7 grid-margin stretch-card">
				<div class="card">
				<div class="card-header header-sm d-flex justify-content-between align-items-center">
					<h4 class="card-title">Form Edit Kelas</h4>
				</div>
					<div class="card-body">
						<form action="<?php echo base_url('kelas/edit/' . $kelas->id_kelas); ?>" class="form-sample" method="POST">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Nama Kelas</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="nama_kelas" value="<?php echo $kelas->nama_kelas; ?>" required autocomplete="off">
											<?php echo form_error('nama_kelas'); ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Program Studi</label>
										<div class="col-sm-8">
											<select name="id_program_studi" id="" class="form-control select2">
												<option selected disabled>-- Pilih Program Studi --</option>
												<?php foreach ($program_studi as $prodi):?>
													<option <?php echo ($kelas->id_program_studi === $prodi->id_program_studi) ? "selected" : ""; ?> value="<?php echo $prodi->id_program_studi; ?>"><?php echo $prodi->jenjang . " - ". $prodi->nama_program_studi; ?></option>
												<?php endforeach; ?>
											</select>
											<?php echo form_error('id_program_studi'); ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Semester</label>
										<div class="col-sm-8">
											<select name="semester" id="" class="form-control select2">
												<option selected disabled>-- Pilih Semester --</option>
												<?php for ($i=1; $i<=8; $i++):?>
													<option <?php echo ($kelas->semester == $i) ? "selected" : ""; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
												<?php endfor; ?>
											</select>
											<?php echo form_error('semester'); ?>
										</div>
									</div>
									<div class="form-group row text-right">
										<div class="col-sm-8 offset-3">
											<button class="btn btn-success" type="submit" name="update">SIMPAN</button>
											<a href="<?php echo base_url('kelas'); ?>" class="btn btn-secondary">KEMBALI</a>
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
