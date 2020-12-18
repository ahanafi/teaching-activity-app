<?php
$uri1 = $this->uri->segment(1);
$uri2 = $this->uri->segment(2);
?>

</div>
<!-- ./wrapper -->
<script>
	const BASE_URL = "<?php echo base_url('') ?>";
</script>
<!-- jQuery -->
<script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('assets/plugins/jquery-ui/jquery-ui.min.js'); ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
	$.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<!-- ChartJS -->
<script src="<?php echo base_url('assets/plugins/chart.js/Chart.min.js'); ?>"></script>
<!-- Sparkline -->
<script src="<?php echo base_url('assets/plugins/sparklines/sparkline.js'); ?>"></script>
<!-- JQVMap -->
<script src="<?php echo base_url('assets/plugins/jqvmap/jquery.vmap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/jqvmap/maps/jquery.vmap.usa.js'); ?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url('assets/plugins/jquery-knob/jquery.knob.min.js'); ?>"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url('assets/plugins/moment/moment.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/daterangepicker/daterangepicker.js'); ?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js'); ?>"></script>
<!-- Summernote -->
<script src="<?php echo base_url('assets/plugins/summernote/summernote-bs4.min.js'); ?>"></script>
<!-- Select2 -->
<script src="<?php echo base_url('assets/plugins/select2/js/select2.full.min.js'); ?>"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js'); ?>"></script>
<!-- SweetAlert2 -->
<script src="<?php echo base_url('assets/plugins/sweetalert2/sweetalert2.min.js'); ?>"></script>
<!-- DataTables -->
<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/js/adminlte.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/custom.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/alerts.js'); ?>"></script>
<!-- Custom js for this page -->
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/js/demo.js'); ?>"></script>
<?php if ($uri1 == "dashboard") : ?>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url('assets/js/pages/dashboard.js'); ?>"></script>
<?php elseif ($uri1 == "jabatan") : ?>
	<script src="<?php echo base_url('assets/js/pages/jabatan.js'); ?>"></script>
	<script type="text/javascript">
		<?php if(validation_errors() !== ''): ?>
		$("#form-jabatan").modal('show');
		<?php endif; ?>
	</script>
<?php elseif ($uri1 == "akun-penerimaan" || $uri1 == "akun-pengeluaran") : ?>
	<script src="<?php echo base_url('assets/js/pages/akun.js'); ?>"></script>
	<script type="text/javascript">
		<?php if(validation_errors() !== ''): ?>
		$("#form-<?php echo $uri1; ?>").modal('show');
		<?php endif; ?>
	</script>
<?php elseif ($uri1 == "donatur"): ?>
	<script src="<?php echo base_url('assets/js/pages/donatur.js'); ?>"></script>
<?php elseif ($uri1 == "donasi"): ?>
	<script src="<?php echo base_url('assets/js/pages/donasi.js'); ?>"></script>
<?php elseif ($uri1 == "area"): ?>
	<script src="<?php echo base_url('assets/js/pages/wilayah.js'); ?>"></script>
<?php endif; ?>
<script type="text/javascript">
	$("a[data-toggle=tooltip]").tooltip();
	loadSelect2();
</script>
<?php if (isset($_SESSION['message']) && $_SESSION['message'] != ''): ?>
	<script type="text/javascript">
		showAlert('message', '<?php echo $_SESSION['message']['type']; ?>', '<?php echo ucfirst($_SESSION['message']['type']); ?>', '<?php echo $_SESSION['message']['text']; ?>');
	</script>
<?php endif;
$_SESSION['message'] = ''; ?>
<!-- End custom js for this page -->
</body>
</html>
