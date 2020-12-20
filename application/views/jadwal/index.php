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
						<h4 class="card-title">Data Dosen</h4>
						<div class="table-responsive">
							<table id="order-listing" class="table table-striped">
								<thead>
								<tr>
									<th>Nomor</th>
									<th>Hari</th>
									<th>Nama Lengkap</th>
									<th>Tempat Lahir</th>
									<th>Tanggal Lahir</th>
									<th>Alamat</th>
									<th>Actions</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($dosen as $dosen): ?>
									<tr>
										<td><?php echo $nomor++; ?></td>
										<td><?php echo $dosen->nidn; ?></td>
										<td><?php echo $dosen->nama_lengkap; ?></td>
										<td><?php echo $dosen->tempat_lahir; ?></td>
										<td><?php echo $dosen->tanggal_lahir; ?></td>
										<td><?php echo $dosen->alamat; ?></td>
										<td>
											<a href="<?php echo base_url('dosen/edit/' . $dosen->id_dosen); ?>"
											   class="btn btn-success text-white">Edit</a>
											<a href="#" onclick="showConfirmDelete('dosen', <?php echo $dosen->id_dosen; ?>)" class="btn btn-danger">Hapus</a>
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
