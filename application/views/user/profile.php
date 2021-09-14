<div class="main-panel">
	<div class="content-wrapper">
		<div class="row profile-page">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<div class="profile-header text-white">
							<div
									class="d-flex justify-content-center justify-content-md-between mx-4 mx-xl-5 px-xl-5 flex-wrap">
								<div
										class="profile-info d-flex align-items-center justify-content-center flex-wrap mr-sm-3">
									<img class="rounded-circle img-lg mb-3 mb-sm-0"
										 src="<?php echo base_url('assets/'); ?>images/faces/face8.jpg"
										 alt="profile image">
									<div class="wrapper pl-sm-4">
										<p class="profile-user-name text-center text-sm-left"><?php echo getUser('nama_lengkap'); ?></p>
										<div class="wrapper d-flex align-items-center justify-content-center flex-wrap">
											<p class="profile-user-designation text-center text-md-left my-2 my-md-0">
												(<?php echo showUserLevel(getUser('level'), true); ?>)</p>
											<div class="br-wrapper br-theme-css-stars"><select id="example-css"
																							   name="rating"
																							   autocomplete="off"
																							   style="display: none;">
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
												</select>
												<div class="br-widget">
													<a href="#" data-rating-value="1"
													   data-rating-text="1"
													   class="br-selected br-current"></a>
													<a href="#"
													   data-rating-value="2"
													   data-rating-text="2"
													   class=""></a>
													<a
														href="#"
														data-rating-value="3"
														ata-rating-text="3"
														class=""></a>
													<a href="#" data-rating-value="4"
													   data-rating-text="4" class=""></a>
													<a href="#"
													   data-rating-value="5"
													   data-rating-text="5"></a>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="details mt-2 mt-md-0">
									<div class="detail-col pr-3 mr-3">
										<p>Projects</p>
										<p>130</p>
									</div>
									<div class="detail-col">
										<p>Projects</p>
										<p>130</p>
									</div>
								</div>
							</div>
						</div>
						<div class="profile-body">
							<ul class="nav tab-switch" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="user-profile-info-tab" data-toggle="pill"
									   href="#user-profile-info" role="tab" aria-controls="user-profile-info"
									   aria-selected="true">Profile</a>
								</li>
							</ul>
							<div class="row">
								<div class="col-md-12">
									<div class="tab-content tab-body" id="profile-log-switch">
										<div class="tab-pane fade show active pr-3" id="user-profile-info"
											 role="tabpanel" aria-labelledby="user-profile-info-tab">
											<div class="table-responsive">
												<table class="table table-borderless w-100 mt-4">
													<tbody>
													<tr>
														<td>
															<strong>Nama Lengkap :</strong> <?php echo $user->nama_lengkap; ?>
														</td>
														<td>
															<strong>Username :</strong> <?php echo $user->username; ?>
														</td>
													</tr>
													<tr>
														<td>
															<strong>Level :</strong> <?php echo showUserLevel($user->level, true); ?>
														</td>
														<td>
															<strong>Email :</strong> -
														</td>
													</tr>
													<tr>
														<td>
															<strong>Languages :</strong> -
														</td>
														<td>
															<strong>Phone :</strong> -
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
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- content-wrapper ends -->
