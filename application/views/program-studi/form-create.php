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
					<h4 class="card-title">Form Tambah Program Studi</h4>
				</div>
					<div class="card-body">
						<form action="<?php echo base_url('program-studi/create'); ?>" class="form-sample" method="POST" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Kode Program Studi</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="kode_program_studi" value="<?php echo set_value('kode_program_studi'); ?>" required autocomplete="off">
											<?php echo form_error('kode_program_studi'); ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Nama Program Studi</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="nama_program_studi" value="<?php echo set_value('nama_program_studi'); ?>" required autocomplete="off">
											<?php echo form_error('nama_program_studi'); ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Fakultas</label>
										<div class="col-sm-8">
											<select name="id_fakultas" id="" class="form-control select2" required>
												<option selected disabled>-- Pilih Fakultas --</option>
												<?php foreach ($fakultas as $fak):?>
													<option <?php echo (set_value('id_fakultas') === $fak->id_fakultas) ? "selected" : ""; ?> value="<?php echo $fak->id_fakultas; ?>"><?php echo $fak->kode_fakultas . " - " . $fak->nama_fakultas; ?></option>
												<?php endforeach; ?>
											</select>
											<?php echo form_error('id_fakultas'); ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Jenjang</label>
										<div class="col-sm-8">
											<select name="jenjang" id="" class="form-control select2" required>
												<option selected disabled>-- Pilih Jenjang --</option>
												<?php foreach ($jenjang as $jenjang):?>
													<option <?php echo (set_value('jenjang') === $jenjang) ? "selected" : ""; ?> value="<?php echo $jenjang; ?>"><?php echo $jenjang; ?></option>
												<?php endforeach; ?>
											</select>
											<?php echo form_error('jenjang'); ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Ketua Prodi</label>
										<div class="col-sm-8">
											<select name="id_dosen" id="" class="form-control select2" required>
												<option selected disabled>-- Pilih Dosen --</option>
												<?php foreach ($dosen as $dosen):?>
													<option <?php echo (set_value('id_dosen') === $dosen->id_dosen) ? "selected" : ""; ?> value="<?php echo $dosen->id_dosen; ?>"><?php echo $dosen->nama_lengkap; ?></option>
												<?php endforeach; ?>
											</select>
											<?php echo form_error('jenjang'); ?>
										</div>
									</div>
									<div class="form-group row text-right">
										<div class="col-sm-8 offset-3">
											<button class="btn btn-success" type="submit" name="submit">SIMPAN</button>
											<a href="<?php echo base_url('program-studi'); ?>" class="btn btn-secondary">KEMBALI</a>
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
