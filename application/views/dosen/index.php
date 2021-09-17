<div class="main-panel">
	<div class="content-wrapper">
		<!-- Page Title Header Starts-->
		<?php echo showPageHeader(); ?>
		<!-- Page Title Header Ends-->
		<div class="row">
			<div class="col-md-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-header header-sm d-flex justify-content-between align-items-center">
						<h4 class="card-title">Data Dosen</h4>
						<div class="pull-right">
							<a href="<?php echo base_url(uriSegment(1) . '/create'); ?>"
							   class="ml-auto btn btn-primary btn-fw">
								<i class="fa fa-plus"></i>
								<span>Tambah Data</span>
							</a>
							<button type="button" class="ml-auto btn btn-secondary btn-fw" data-toggle="modal"
									data-target="#import-modal">
								<i class="fa fa-download"></i>
								<span>Import Data</span>
							</button>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="order-listing" class="table table-striped">
								<thead>
								<tr>
									<th>Nomor</th>
									<th>NIDN</th>
									<th>Nama Lengkap</th>
									<th>Gelar</th>
									<th>Program Studi</th>
									<th>Actions</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($dosen as $dosen): ?>
									<tr>
										<td><?php echo $nomor++; ?></td>
										<td>
											<a href="<?php echo base_url('dosen/detail/' . $dosen->id_dosen); ?>"
											   class="btn-link">
												<?php echo $dosen->nidn; ?>
											</a>
										</td>
										<td><?php echo $dosen->nama_lengkap; ?></td>
										<td><?php echo $dosen->gelar; ?></td>
										<td><?php echo $dosen->jenjang . " - " . $dosen->prodi; ?></td>
										<td>
											<a href="<?php echo base_url('dosen/edit/' . $dosen->id_dosen); ?>"
											   class="btn btn-success text-white">Edit</a>
											<a href="#"
											   onclick="showConfirmDelete('dosen', <?php echo $dosen->id_dosen; ?>)"
											   class="btn btn-danger">Hapus</a>
										</td>
									</tr>
								<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- content-wrapper ends -->
	<div class="modal fade" id="import-modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header p-3">
					<h5 class="modal-title">Import Data Dosen</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body p-3">
					<div class="alert alert-warning font-weight-semibold font-italic">
						Silahkan unduh format import data di bawah ini dan isi dengan data yang akan diimpor ke dalam
						aplikasi.
					</div>
					<form action="<?php echo base_url('dosen/import'); ?>" method="POST" enctype="multipart/form-data">
						<div class="form-group row">
							<label for="exampleInputEmail2" class="col-sm-3 col-form-label">Contoh Format</label>
							<div class="col-sm-9">
								<a href="" class="btn btn-primary">
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
