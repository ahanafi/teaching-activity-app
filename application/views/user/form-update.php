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
			<div class="col-md-8 grid-margin stretch-card">
				<div class="card">
				<div class="card-header header-sm d-flex justify-content-between align-items-center">
					<h4 class="card-title">Form Edit Pengguna</h4>
				</div>
					<div class="card-body">
						<form action="<?php echo base_url('user/edit/' . $user->id_pengguna); ?>" class="form-sample" method="POST" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Nama Lengkap</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="nama_lengkap" value="<?php echo $user->nama_lengkap; ?>" required autocomplete="off">
											<?php echo form_error('nama_lengkap'); ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Username</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="username" value="<?php echo $user->username; ?>" required autocomplete="off">
											<?php echo form_error('username'); ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">E-mail</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="email" value="<?php echo $user->email; ?>" required autocomplete="off">
											<?php echo form_error('email'); ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Level</label>
										<div class="col-sm-8">
											<select class="form-control" name="level" required>
												<?php foreach ($user_level as $key => $val): ?>
													<option <?php echo ($user->level == $val) ? "selected" : ""; ?> value="<?php echo $key; ?>"><?php echo $val; ?></option>
												<?php endforeach; ?>
											</select>
											<?php echo form_error('level'); ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Foto</label>
										<div class="col-sm-8">
											<input type="file" class="form-control file-upload-info" name="foto">
											<?php echo form_error('foto'); ?>
										</div>
									</div>
									<div class="form-group row text-right">
										<div class="col-sm-8 offset-3">
											<button class="btn btn-success" type="submit" name="update">SIMPAN</button>
											<a href="<?php echo base_url('user'); ?>" class="btn btn-secondary">KEMBALI</a>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-4 grid-margin stretch-card">
				<div class="card">
				<div class="card-header header-sm d-flex justify-content-between align-items-center">
					<h4 class="card-title">Foto</h4>
				</div>
					<div class="card-body">
						<img src="<?php echo assets('images/avatar.png'); ?>" alt="" class="img img-fluid">
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- content-wrapper ends -->
