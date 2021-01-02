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
			<div class="col-lg-4 col-md-3 col-sm-6 grid-margin stretch-card">
				<div class="card card-statistics bg-green-gradient">
					<div class="card-body">
						<div class="clearfix">
							<div class="float-left">
								<i class="mdi mdi-cube icon-lg"></i>
							</div>
							<div class="float-right">
								<p class="mb-0 text-right text-white">Total Revenue</p>
								<div class="fluid-container">
									<h3 class="font-weight-medium text-right mb-0">$65,650</h3>
								</div>
							</div>
						</div>
						<p class="mt-3 mb-0 text-white">
							<i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> 65% lower growth </p>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-3 col-sm-6 grid-margin stretch-card">
				<div class="card card-statistics bg-orange-gradient">
					<div class="card-body">
						<div class="clearfix">
							<div class="float-left">
								<i class="mdi mdi-receipt icon-lg"></i>
							</div>
							<div class="float-right">
								<p class="mb-0 text-right text-white">Orders</p>
								<div class="fluid-container">
									<h3 class="font-weight-medium text-right mb-0">3455</h3>
								</div>
							</div>
						</div>
						<p class="mt-3 mb-0 text-white">
							<i class="mdi mdi-bookmark-outline mr-1" aria-hidden="true"></i> Product-wise sales </p>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-3 col-sm-6 grid-margin stretch-card">
				<div class="card card-statistics bg-blue-gradient">
					<div class="card-body">
						<div class="clearfix">
							<div class="float-left">
								<i class="mdi mdi-poll-box icon-lg"></i>
							</div>
							<div class="float-right">
								<p class="mb-0 text-right text-white">Sales</p>
								<div class="fluid-container">
									<h3 class="font-weight-medium text-right mb-0">5693</h3>
								</div>
							</div>
						</div>
						<p class="mt-3 mb-0 text-white">
							<i class="mdi mdi-calendar mr-1" aria-hidden="true"></i> Weekly Sales </p>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title mb-0">Sales Statistics Overview</h4>
						<div class="d-flex flex-column flex-lg-row">
							<p>Lorem ipsum is placeholder text commonly used</p>
							<ul class="nav nav-tabs sales-mini-tabs ml-lg-auto mb-4 mb-md-0" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="sales-statistics_switch_1" data-toggle="tab"
									   role="tab" aria-selected="true">1D</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="sales-statistics_switch_2" data-toggle="tab"
									   role="tab" aria-selected="false">5D</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="sales-statistics_switch_3" data-toggle="tab"
									   role="tab" aria-selected="false">1M</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="sales-statistics_switch_4" data-toggle="tab"
									   role="tab" aria-selected="false">1Y</a>
								</li>
							</ul>
						</div>
						<div class="d-flex flex-column flex-lg-row">
							<div class="data-wrapper d-flex mt-2 mt-lg-0">
								<div class="wrapper pr-5">
									<h5 class="mb-0">Total Cost</h5>
									<div class="d-flex align-items-center">
										<h4 class="font-weight-semibold mb-0">15,263</h4>
										<small class="ml-2 text-gray d-none d-lg-block"><b>89.5%</b> of 20,000
											Total</small>
									</div>
								</div>
								<div class="wrapper">
									<h5 class="mb-0">Total Revenue</h5>
									<div class="d-flex align-items-center">
										<h4 class="font-weight-semibold mb-0">$753,098</h4>
										<small class="ml-2 text-gray d-none d-lg-block"><b>10.5%</b> of 20,000
											Total</small>
									</div>
								</div>
							</div>
							<div class="ml-lg-auto" id="sales-statistics-legend"></div>
						</div>
						<canvas class="mt-5" height="120" id="sales-statistics-overview"></canvas>
					</div>
				</div>
			</div>
			<div class="col-md-4 grid-margin stretch-card">
				<div class="card">
					<div class="card-body d-flex flex-column">
						<div class="wrapper">
							<h4 class="card-title mb-0">Net Profit Margin</h4>
							<p>Started collecting data from February 2019</p>
							<div class="mb-4" id="net-profit-legend"></div>
						</div>
						<canvas class="my-auto mx-auto" height="250" id="net-profit"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- content-wrapper ends -->
