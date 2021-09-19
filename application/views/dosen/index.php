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
	<?php $this->load->view('modal/form-import', ['title' => 'Dosen', 'route' => base_url('dosen/import') ]); ?>
