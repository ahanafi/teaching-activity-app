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
						<h4 class="card-title">Daftar Fakultas</h4>
						<div class="table-responsive">
							<table id="order-listing" class="table table-striped">
								<thead>
								<tr>
									<th>Nomor</th>
									<th>Kode</th>
									<th>Nama Fakultas</th>
									<th>Actions</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($fakultas as $fk): ?>
									<tr>
										<td><?php echo $nomor++; ?></td>
										<td><?php echo $fk->kode_fakultas; ?></td>
										<td><?php echo $fk->nama_fakultas; ?></td>
										<td>
											<a href="<?php echo base_url('fakultas/edit/' . $fk->id_fakultas); ?>"
											   class="btn btn-success text-white">Edit</a>
											<a href="#" onclick="showConfirmDelete('fakultas', <?php echo $fk->id_fakultas; ?>)" class="btn btn-danger">Hapus</a>
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
