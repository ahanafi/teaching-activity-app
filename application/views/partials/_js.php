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

<script src="<?php echo assets('vendors/gijgo/js/gijgo.min.js'); ?>"></script>
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="<?php echo assets('js/shared/off-canvas.js'); ?>"></script>
<script src="<?php echo assets('js/shared/misc.js'); ?>"></script>
<script src="<?php echo assets('js/shared/data-table.js'); ?>"></script>
<script src="<?php echo assets('js/shared/alerts.js'); ?>"></script>
<script src="<?php echo assets('js/shared/custom.js'); ?>"></script>
<!-- endinject -->
<?php if($uri1 == "berita-acara"): ?>
	<script src="<?php echo assets('js/shared/berita-acara.js'); ?>"></script>
<?php endif; ?>
<!-- Custom js for this page-->
<script src="<?php echo assets('js/demo/dashboard.js'); ?>"></script>
<!-- End custom js for this page-->
<?php if (isset($_SESSION['message']) && $_SESSION['message'] != ''): ?>
	<script type="text/javascript">
		showAlert('message', '<?php echo $_SESSION['message']['type']; ?>', '<?php echo ucfirst($_SESSION['message']['type']); ?>', '<?php echo $_SESSION['message']['text']; ?>');
	</script>
<?php endif;
$_SESSION['message'] = ''; ?>
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
</body>
</html>
