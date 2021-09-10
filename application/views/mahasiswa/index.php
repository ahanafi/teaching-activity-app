<div class="main-panel">
	<div class="content-wrapper">
		<!-- Page Title Header Starts-->
		<?php echo showPageHeader(); ?>
		<!-- Page Title Header Ends-->
		<div class="row">
			<div class="col-md-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-header header-sm d-flex justify-content-between align-items-center">
						<h4 class="card-title">Data Mahasiswa</h4>
						<a href="<?php echo base_url(uriSegment(1) . '/create'); ?>"
						   class="ml-auto btn btn-primary btn-fw">
							<i class="fa fa-plus"></i>
							<span>Tambah Data</span>
						</a>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="order-listing" class="table table-striped">
								<thead>
								<tr>
									<th>Nomor</th>
									<th>NIM</th>
									<th>Nama Lengkap</th>
									<th>Kelas</th>
									<th>Program Studi</th>
									<th>Actions</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($mahasiswa as $mahasiswa): ?>
									<tr>
										<td><?php echo $nomor++; ?></td>
										<td>
											<a href="<?php echo base_url('mahasiswa/detail/' . $mahasiswa->id_mahasiswa); ?>" class="btn-link">
												<?php echo $mahasiswa->nim; ?>
											</a>
										</td>
										<td><?php echo $mahasiswa->nama_lengkap; ?></td>
										<td><?php echo $mahasiswa->nama_kelas . "/" . $mahasiswa->semester; ?></td>
										<td><?php echo $mahasiswa->jenjang . " - " . $mahasiswa->prodi; ?></td>
										<td>
											<b><i>NO_ACTION</i></b>
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
