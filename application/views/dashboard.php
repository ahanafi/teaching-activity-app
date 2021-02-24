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
			<div class="col-md-8 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<div class="d-flex justify-content-between align-items-center pb-4">
							<h4 class="card-title mb-0">Grafik Penggunaan Aplikasi</h4>
							<div id="bar-traffic-legend"></div>
						</div>
						<canvas id="barChart" style="height:250px"></canvas>
					</div>
				</div>
			</div>
			<div class="col-md-4 grid-margin stretch-card">
				<div class="card">
					<div class="p-4 pr-5 border-bottom bg-light d-flex justify-content-between">
						<h4 class="card-title mb-0">Grafik Bentuk Materi</h4>

					</div>
					<div class="card-body d-flex flex-column">
						<canvas class="my-auto" id="doughnutChart" height="200"></canvas>
						<div class="d-flex pt-3 border-top">
							<table class="table table-bordered">
								<?php for ($i = 0; $i < count($material_value); $i++): ?>
									<tr>
										<td>
											<span style="display:block;width: 10px;height: 10px;background-color: '<?php echo $material_colors[$i]; ?>';"></span>
											<?php echo $material_label[$i]; ?></td>
										<td><?php echo $material_value[$i]; ?></td>
									</tr>
								<?php endfor; ?>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8 grid-margin">
				<div class="card">
					<div class="card-header header-sm">
						<div class="d-flex align-items-center">
							<h4 class="card-title mb-0">Grafik Ketepatan Jadwal dan Pelaksanaan Perkuliahan</h4>
							<div class="dropdown ml-auto">
								<select name="" id="" class="form-control" onchange="showScheduleAccuracy(this)">
									<?php foreach ($jadwal_per_dosen as $jadwal_dosen): ?>
									<optgroup label="<?php echo namaDosen($jadwal_dosen['nama_dosen'], $jadwal_dosen['gelar']); ?>">
										<?php foreach ($jadwal_dosen['jadwal'] as $jadwal): ?>
											<option value="<?php echo $jadwal->id_jadwal; ?>">
											<?php echo $jadwal->nama_mata_kuliah . " - " . $jadwal->nama_kelas; ?>
											</option>
										<?php endforeach; ?>
									</optgroup>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center order-lg-first">
								<div class="wrapper">
									<div class="chartjs-size-monitor">
										<div class="chartjs-size-monitor-expand">
											<div class=""></div>
										</div>
										<div class="chartjs-size-monitor-shrink">
											<div class=""></div>
										</div>
									</div>
									<canvas id="trafficDoughnutChart" height="325" width="375"
											class="chartjs-render-monitor"
											style="display: block; height: 140px; width: 300px;"></canvas>
								</div>
							</div>
							<div class="col-lg-6 order-lg-last">
								<table class="table table-bordered">
									<tr>
										<td style="background-color: #dee2e6;">Nama Dosen</td>
										<td id="lecture-name"><?php echo namaDosen($jadwal->dosen, $jadwal->gelar); ?></td>
									</tr>
									<tr>
										<td style="background-color: #dee2e6;">Mata Kuliah</td>
										<td id="study-name"><?php echo $jadwal->nama_mata_kuliah; ?></td>
									</tr>
									<tr>
										<td style="background-color: #dee2e6;">Kelas</td>
										<td id="class-name"><?php echo $jadwal->nama_kelas; ?></td>
									</tr>
									<tr>
										<td style="background-color: #dee2e6;">Jadwal</td>
										<td id="schedule"><?php echo ucfirst(strtolower($jadwal->hari)) . ", " . showJamKuliah($jadwal->jam_mulai, $jadwal->jam_selesai); ?></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- content-wrapper ends -->
