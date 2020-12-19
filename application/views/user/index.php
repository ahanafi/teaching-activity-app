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
			<div class="col-md-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Daftar Pengguna</h4>
						<div class="table-responsive">
							<table id="order-listing" class="table table-striped">
								<thead>
								<tr>
									<th>Nomor</th>
									<th>Nama Lengkap</th>
									<th>Username</th>
									<th>E-mail</th>
									<th>Level</th>
									<th>Foto</th>
									<th>Actions</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($users as $user): ?>
									<tr>
										<td><?php echo $nomor++; ?></td>
										<td><?php echo $user->nama_lengkap; ?></td>
										<td><?php echo $user->username; ?></td>
										<td><?php echo $user->email; ?></td>
										<td>
											<label class="badge badge-inverse-info">On hold</label>
										</td>
										<td>
											<div class="d-flex align-items-center">
												<img class="img-xs rounded-circle"
													 src="<?php echo base_url(); ?>assets/images/faces/face2.jpg"
													 alt="profile image">
											</div>
										</td>
										<td>
											<a href="<?php echo base_url('user/edit/' . $user->id_pengguna); ?>"
											   class="btn btn-success text-white">Edit</a>
											<a data-toggle="modal" data-taraget="#confirm-delete-modal" href="#" class="btn btn-danger">Hapus</a>
										</td>
									</tr>
								<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="modal fade" id="confirm-delete-modal" tabindex="-1" role="dialog"
					 aria-labelledby="confirm-delete-modalLabel" style="display: none;" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="confirm-delete-modalLabel">Konfirmasi Hapus Data</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
							</div>
							<div class="modal-body">
								<p>Apakah Anda yakin akan menghapus data ini?</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-danger">Ya, Hapus!</button>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- content-wrapper ends -->
