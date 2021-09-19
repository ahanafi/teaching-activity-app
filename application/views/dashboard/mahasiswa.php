<div class="main-panel">
	<div class="content-wrapper">
		<!-- Page Title Header Starts-->
		<?php echo showPageHeader(); ?>
		<!-- Page Title Header Ends-->
		<div class="row">
			<div class="col-md-12 grid-margin stretch-card">
				<div class="card" style="min-height: 65vh;">
					<div class="card-header header-sm d-flex justify-content-between align-items-center">
						<h4 class="card-title font-weight-bold">Your Tasks</h4>
					</div>
					<div class="card-body">

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
										<?php if($exist_paraf): ?>
											<span class="badge badge-inverse-success">COMPLETE</span>
										<?php else: ?>
										<span class="badge badge-inverse-danger">INCOMPLETE</span>
										<?php endif; ?>
									</td>
									<td class="text-center">
										<?php if(!$exist_paraf): ?>
										<a href="<?php echo base_url('user/upload-signature'); ?>" class="btn btn-primary btn-fw">
											<i class="mdi mdi-upload"></i>Upload
										</a>
										<?php else: echo "<i>NO_ACTION</i>"; endif; ?>
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
