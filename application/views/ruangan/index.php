<div class="main-panel">
	<div class="content-wrapper">
		<!-- Page Title Header Starts-->
		<?php echo showPageHeader(); ?>
		<!-- Page Title Header Ends-->
		<div class="row">
			<div class="col-md-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Data Ruangan</h4>
						<div class="table-responsive">
							<table id="order-listing" class="table table-striped">
								<thead>
								<tr>
									<th>Nomor</th>
									<th>Kode</th>
									<th>Kapasitas</th>
									<th>Actions</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($ruangan as $ruangan): ?>
									<tr>
										<td><?php echo $nomor++; ?></td>
										<td><?php echo $ruangan->kode_ruangan; ?></td>
										<td><?php echo $ruangan->kapasitas; ?></td>
										<td>
											<a href="<?php echo base_url('ruangan/edit/' . $ruangan->id_ruangan); ?>"
											   class="btn btn-success text-white">Edit</a>
											<a href="#" onclick="showConfirmDelete('ruangan', <?php echo $ruangan->id_ruangan; ?>)" class="btn btn-danger">Hapus</a>
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
