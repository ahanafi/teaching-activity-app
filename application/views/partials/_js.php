<?php
$uri1 = $this->uri->segment(1);
$uri2 = $this->uri->segment(2);
?>
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<script type="text/javascript">
	const BASE_URL = `<?php echo base_url(); ?>`;
	<?php
	$totalSegments = $this->uri->total_segments();
	for($i = 1; $i <= $totalSegments; $i++):
	?>
	const URI_<?php echo $i; ?> = "<?php echo $this->uri->segment($i); ?>";
	<?php endfor; ?>
</script>
<!-- plugins:js -->
<script src="<?php echo assets('vendors/js/vendor.bundle.base.js'); ?>"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<script src="<?php echo assets('vendors/datatables.net/jquery.dataTables.js'); ?>"></script>
<script src="<?php echo assets('vendors/datatables.net-bs4/dataTables.bootstrap4.js'); ?>"></script>
<script src="<?php echo assets('vendors/sweetalert2/sweetalert2.min.js'); ?>"></script>
<script src="<?php echo assets('vendors/summernote/dist/summernote-bs4.min.js'); ?>"></script>
<script src="<?php echo assets('vendors/select2/select2.min.js'); ?>"></script>

<?php if (($uri1 === "berita-acara" || $uri1 === "jadwal-kuliah") && ($uri2 === "create" || $uri2 === "edit")): ?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.9/flatpickr.min.js"
			integrity="sha512-+ruHlyki4CepPr07VklkX/KM5NXdD16K1xVwSva5VqOVbsotyCQVKEwdQ1tAeo3UkHCXfSMtKU/mZpKjYqkxZA=="
			crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.9/l10n/id.min.js"
			integrity="sha512-XCJP/fJxX6uFAvyH4yZfgsbzmiBiS7hPiVEGw8C+372GAiMgLlPVy00o585G/kD+Shh2YWXr34Ui0lee7+x0ZA=="
			crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script>
		flatpickr('input[name=tanggal]');
		const timeOptions = {
			enableTime: true,
			noCalendar: true,
			dateFormat: "H:i",
			time_24hr: true
		};
		flatpickr('input[name=jam_mulai]', timeOptions);
		flatpickr('input[name=jam_selesai]', timeOptions)
	</script>
<?php endif; ?>
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="<?php echo assets('js/shared/off-canvas.js'); ?>"></script>
<script src="<?php echo assets('js/shared/misc.js'); ?>"></script>
<script src="<?php echo assets('js/shared/data-table.js'); ?>"></script>
<script src="<?php echo assets('js/shared/alerts.js'); ?>"></script>
<script src="<?php echo assets('js/shared/custom.js'); ?>"></script>
<!-- endinject -->
<?php if ($uri1 === "dashboard"): ?>
	<script type="text/javascript">

		const drawSheduleAccurationChart = (chartData) => {
			let doughnutChartCanvas = $("#trafficDoughnutChart").get(0).getContext("2d");
			let doughnutPieOptions = {
				//cutoutPercentage: 50,
				animationEasing: "easeOutBounce",
				animateRotate: true,
				animateScale: false,
				responsive: true,
				maintainAspectRatio: true,
				showScale: true,
				legend: {
					display: false
				},
				layout: {
					padding: {
						left: 0,
						right: 0,
						top: 0,
						bottom: 0
					}
				}
			};
			window.scheduleAccurationChart = new Chart(doughnutChartCanvas, {
				type: 'bar',
				data: chartData,
				options: doughnutPieOptions
			});
		}

		const showScheduleAccuracy = async (el) => {
			const jadwalId = el.value;
			const URL = BASE_URL + 'get-akurasi-jadwal/' + jadwalId;
			const request = await fetch(URL, {
				method: 'GET',
				headers: {
					'Content-Type': 'application/json',
					'X-Requested-With': 'XMLHttpRequest'
				}
			}).then(res => res.json());
			const jadwal = request.jadwal;
			const scheduleAccurationData = {
				datasets: [{
					data: request.data,
					backgroundColor: request.colors,
					borderColor: request.colors,
				}],

				// These labels appear in the legend and in the tooltips when hovering different arcs
				labels: request.label
			};

			document.getElementById('lecture-name').innerText = jadwal.dosen;
			document.getElementById('study-name').innerText = jadwal.nama_mata_kuliah;
			document.getElementById('class-name').innerText = `${jadwal.nama_kelas}/${jadwal.semester}`;
			document.getElementById('schedule').innerText = jadwal.jadwal;

			window.scheduleAccurationChart.data = scheduleAccurationData;
			window.scheduleAccurationChart.update();
		}

		const usedAppTypeData = {
			labels: <?php echo json_encode($app_label);?>,
			datasets: [{
				label: 'Jumlah Penggunaan',
				data: <?php echo json_encode($app_value); ?>,
				backgroundColor: <?php echo json_encode($app_colors); ?>,
				borderColor: <?php echo json_encode($app_colors); ?>,
				borderWidth: 0
			}]
		};

		const materialExtensionTypeData = {
			datasets: [{
				data: <?php echo json_encode($material_value); ?>,
				backgroundColor: <?php echo json_encode($material_colors); ?>,
				borderColor: <?php echo json_encode($material_colors); ?>,
			}],

			// These labels appear in the legend and in the tooltips when hovering different arcs
			labels: <?php echo json_encode($material_label); ?>
		};

		const accurationScheduleAndImplementationData = {
			datasets: [{
				data: <?php echo json_encode($akurasi_jadwal_value); ?>,
				backgroundColor: <?php echo json_encode($akurasi_jadwal_colors); ?>,
				borderColor: <?php echo json_encode($akurasi_jadwal_colors); ?>,
			}],

			// These labels appear in the legend and in the tooltips when hovering different arcs
			labels: <?php echo json_encode($akurasi_jadwal_label); ?>
		};

		window.onload = () => {
			drawSheduleAccurationChart(accurationScheduleAndImplementationData);
		}
	</script>
<?php endif; ?>
<?php if ($uri1 === "berita-acara"): ?>
	<script src="<?php echo assets('js/shared/berita-acara.js'); ?>"></script>
<?php endif; ?>
<!-- Custom js for this page-->
<script src="<?php echo assets('js/demo/dashboard.js'); ?>"></script>
<!-- End custom js for this page-->
<?php if (isset($_SESSION['message']) && $_SESSION['message'] !== ''): ?>
	<script type="text/javascript">
		showAlert('message', '<?php echo $_SESSION['message']['type']; ?>', '<?php echo ucfirst($_SESSION['message']['type']); ?>', '<?php echo $_SESSION['message']['text']; ?>');
	</script>
<?php endif;
$_SESSION['message'] = ''; ?>
<?php if (($uri1 === "jadwal" || $uri1 === "jadwal-kuliah" || $uri1 === "berita-acara") && ($uri2 === "create" || $uri2 === "edit")): ?>
	<script type="text/javascript">
		loadSelect2();
		$("input[name=jam_mulai]").timepicker({
			uiLibrary: 'bootstrap4',
			format: 'HH:MM'
		});
		$("input[name=jam_selesai]").timepicker({
			uiLibrary: 'bootstrap4',
			format: 'HH:MM'
		});
	</script>
<?php endif; ?>
</body>
</html>
