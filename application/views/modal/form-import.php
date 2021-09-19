<div class="modal fade" id="import-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header p-3">
				<h5 class="modal-title">Import Data <?php echo $title; ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body p-3">
				<div class="alert alert-warning font-weight-semibold font-italic">
					Silahkan unduh format import data di bawah ini dan isi dengan data yang akan diimpor ke dalam
					aplikasi.
				</div>
				<form action="<?php echo $route; ?>" method="POST" enctype="multipart/form-data">
					<div class="form-group row">
						<label for="exampleInputEmail2" class="col-sm-3 col-form-label">Contoh Format</label>
						<div class="col-sm-9">
							<a href="<?php echo base_url('import/download-samples/' . strtolower(str_replace(' ', '-', $title))); ?>"
							   class="btn btn-primary">
								<i class="fa fa-download"></i>
								<span>Unduh Format Import Data</span>
							</a>
						</div>
					</div>
					<div class="form-group row">
						<label for="exampleInputPassword2" class="col-sm-3 col-form-label">File</label>
						<div class="col-sm-9">
							<input type="file" class="form-control" name="file" required>
							<?php
							if (isset($_GET['errmsg']) && $_GET['errmsg'] !== '') {
								$errorMessage = str_replace("-", " ", $_GET['errmsg']);
								echo "<small class='form-text text-danger'>$errorMessage</small>";
							}
							?>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">&nbsp;</label>
						<div class="col-sm-9">
							<button type="submit" name="import" class="btn btn-success me-2">Import Sekarang
							</button>
							<button class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Batal</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
