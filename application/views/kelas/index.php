<div class="main-panel">
	<div class="content-wrapper">
		<!-- Page Title Header Starts-->
		<?php echo showPageHeader(); ?>
		<!-- Page Title Header Ends-->
		<div class="row">
			<div class="col-md-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Data Kelas</h4>
						<div class="table-responsive">
							<table id="order-listing" class="table table-striped">
								<thead>
								<tr>
									<th>Nomor</th>
									<th>Nama Kelas</th>
									<th>Program Studi</th>
									<th>Semester</th>
									<th>Actions</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($kelas as $kelas): ?>
									<tr>
										<td><?php echo $nomor++; ?></td>
										<td><?php echo $kelas->nama_kelas . "/" . $kelas->semester; ?></td>
										<td><?php echo $kelas->jenjang . " - ". $kelas->prodi; ?></td>
										<td><?php echo $kelas->semester; ?></td>
										<td>
											<a href="<?php echo base_url('kelas/edit/' . $kelas->id_kelas); ?>"
											   class="btn btn-success text-white">Edit</a>
											<a href="#" onclick="showConfirmDelete('kelas', <?php echo $kelas->id_kelas; ?>)" class="btn btn-danger">Hapus</a>
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
