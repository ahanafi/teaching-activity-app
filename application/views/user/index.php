<div class="main-panel">
	<div class="content-wrapper">
		<!-- Page Title Header Starts-->
		<?php echo showPageHeader(); ?>
		<!-- Page Title Header Ends-->
		<div class="row">
			<div class="col-md-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Data Pengguna</h4>
						<div class="table-responsive">
							<table id="order-listing" class="table table-striped">
								<thead>
								<tr>
									<th>Nomor</th>
									<th>Nama Lengkap</th>
									<th>Username</th>
									<th>Level</th>
									<th>Actions</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($users as $user): ?>
									<tr>
										<td><?php echo $nomor++; ?></td>
										<td><?php echo $user->nama_lengkap; ?></td>
										<td><?php echo $user->username; ?></td>
										<td>
											<?php if ($user->level == "SUPER_USER"): ?>
												<label class="badge badge-inverse-success">ADMINISTRATOR</label>
											<?php elseif ($user->level == "KAPRODI"): ?>
												<label class="badge badge-inverse-info">KAPRODI</label>
											<?php elseif ($user->level == "DOSEN"): ?>
												<label class="badge badge-inverse-primary">DOSEN</label>
											<?php endif; ?>
										</td>
										<td>
											<a href="<?php echo base_url('user/edit/' . $user->id_pengguna); ?>"
											   class="btn btn-success text-white">Edit</a>
											<a href="#"
											   onclick="showConfirmDelete('user', <?php echo $user->id_pengguna; ?>)"
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
