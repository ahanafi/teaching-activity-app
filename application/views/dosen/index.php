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
											<a href="<?php echo base_url('dosen/detail/' . $dosen->id_dosen); ?>" class="btn-link">
												<?php echo $dosen->nidn; ?>
											</a>
										</td>
										<td><?php echo $dosen->nama_lengkap; ?></td>
										<td><?php echo $dosen->gelar; ?></td>
										<td><?php echo $dosen->jenjang . " - " . $dosen->prodi; ?></td>
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
