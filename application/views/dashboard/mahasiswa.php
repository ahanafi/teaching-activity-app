<div class="main-panel">
	<div class="content-wrapper">
		<!-- Page Title Header Starts-->
		<?php echo showPageHeader(); ?>
		<!-- Page Title Header Ends-->
		<div class="row">
			<div class="col-lg-4 col-md-3 col-sm-6 grid-margin stretch-card">
				<div class="card card-statistics bg-green-gradient">
					<div class="card-body">
						<div class="clearfix">
							<div class="float-left">
								<i class="fa fa-users icon-lg"></i>
							</div>
							<div class="float-right">
								<p class="mb-0 text-right text-white">Total Dosen</p>
								<div class="fluid-container">
									<h1 class="font-weight-medium text-right mb-0"><?php echo $total_dosen; ?></h1>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-3 col-sm-6 grid-margin stretch-card">
				<div class="card card-statistics bg-orange-gradient">
					<div class="card-body">
						<div class="clearfix">
							<div class="float-left">
								<i class="fa fa-book icon-lg"></i>
							</div>
							<div class="float-right">
								<p class="mb-0 text-right text-white">BAP Terverifikasi</p>
								<div class="fluid-container">
									<h1 class="font-weight-medium text-right mb-0">3455</h1>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-3 col-sm-6 grid-margin stretch-card">
				<div class="card card-statistics bg-blue-gradient">
					<div class="card-body">
						<div class="clearfix">
							<div class="float-left">
								<i class="fa fa-file-text icon-lg"></i>
							</div>
							<div class="float-right">
								<p class="mb-0 text-right text-white">BAP Belum Verifikasi</p>
								<div class="fluid-container">
									<h1 class="font-weight-medium text-right mb-0">5693</h1>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 grid-margin stretch-card">
				<div class="card" style="min-height: 45vh;">
					<div class="card-body">
						<h4 class="card-title font-weight-bold">Your Tasks</h4>
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
								<tr>
									<th>Task</th>
									<th>Description</th>
									<th>Status</th>
									<th>Actions</th>
								</tr>
								</thead>
								<tbody>
								<tr>
									<td>Upload Digital Signature</td>
									<td>
										Upload your digital signature as image file with one of allowed extension (PNG,
										JPG, JPEG).
									</td>
									<td>
										<span class="badge badge-inverse-danger">INCOMPLETE</span>
									</td>
									<td>
										<a href="<?php echo base_url('user/upload-signature'); ?>" class="btn btn-primary btn-fw">
											<i class="mdi mdi-upload"></i>Upload
										</a>
									</td>
								</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- content-wrapper ends -->
