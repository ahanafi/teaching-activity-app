<div class="main-panel">
	<div class="content-wrapper">
		<!-- Page Title Header Starts-->
		<?php echo showPageHeader(); ?>
		<!-- Page Title Header Ends-->
		<div class="row">
			<div class="col-md-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-header header-sm d-flex justify-content-between align-items-center">
						<h4 class="card-title">Data Program Studi</h4>
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
									<th>Kode</th>
									<th>Nama Program Studi</th>
									<th>Jenjang</th>
									<th>Fakultas</th>
									<th>Kaprodi</th>
									<th>Actions</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($program_studi as $prodi): ?>
									<tr>
										<td><?php echo $nomor++; ?></td>
										<td><?php echo $prodi->kode_program_studi; ?></td>
										<td><?php echo $prodi->nama_program_studi; ?></td>
										<td><?php echo $prodi->jenjang; ?></td>
										<td><?php echo $prodi->kode_fakultas; ?></td>
										<td>
											<?php if($prodi->id_dosen != ''): ?>
											<a href="<?php echo base_url('dosen/detail/'.$prodi->id_dosen); ?>" target="_blank" class="btn-link"><?php echo $prodi->kaprodi; ?></a>
											<?php else:?>
											-
											<?php endif;?>
										</td>
										<td>
											<a href="<?php echo base_url('program-studi/edit/' . $prodi->id_program_studi); ?>"
											   class="btn btn-success text-white">Edit</a>
											<a href="#" onclick="showConfirmDelete('program-studi', <?php echo $prodi->id_program_studi; ?>)" class="btn btn-danger">Hapus</a>
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
