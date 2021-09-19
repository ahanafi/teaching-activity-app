<div class="main-panel">
	<div class="content-wrapper">
		<!-- Page Title Header Starts-->
		<?php echo showPageHeader('Form Unggah Tanda Tangan Digital'); ?>
		<!-- Page Title Header Ends-->
		<div class="row">
			<div class="col-lg-5 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title d-flex">
							Form Upload Tanda Tangan Digital
						</h4>
						<form class="forms-sample" enctype="multipart/form-data" method="POST">
							<div class="alert alert-warning my-2 border-warning" role="alert">
								<b>Perhatian</b>
								<ul class="pl-3 mb-2">
									<li>Format foto yang didukung : <b>JPG, PNG, JPEG</b></li>
									<li>Ukuran foto maskimal <b>1024 Kb (1 MB)</b></li>
									<li>Reolusi foto maksimal <b>512x512</b> pixel</li>
								</ul>
							</div>
							<div class="form-group">
								<label>File upload</label>
								<input type="file" onchange="showImagePreview(this)" name="signature"
									   class="form-control" required>
								<?php if (isset($error) && $error !== ''): ?>
									<div class="mt-2">
										<span class="error text-danger text-small"><?php echo $error; ?></span>
									</div>
								<?php endif; ?>
							</div>

							<button type="submit" name="upload" class="btn btn-success me-2">UPLOAD</button>
						</form>
					</div>
				</div>
			</div>
			<div class="col-lg-5 grid-margin stretch-card <?php echo ($user_paraf === null) ? 'hidden' : ''; ?>"
				 id="signature-preview">
				<div class="card">
					<div class="card-body align-center align-middle justify-content-between">
						<h4 class="card-title">
							Image Preview
							<a href="#" onclick="resetImage()" class="float-right text-danger">
								<i class="fa fa-undo"></i>
								Reset Image
							</a>
						</h4>
						<?php if ($user_paraf !== null && file_exists(FCPATH . $user_paraf)): ?>
							<img src="<?php echo base_url($user_paraf); ?>" alt="Image preview"
								 class="img img-fluid">
						<?php else: ?>
							<img src="<?php echo assets('images/img-placeholder.png'); ?>" alt="Image preview"
								 class="img img-fluid">
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- content-wrapper ends -->
