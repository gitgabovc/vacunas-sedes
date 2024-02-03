<!-- REQUIRED JS SCRIPTS -->
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.js?v=01"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dist/js/app.min.js"></script>

<!-- My Ajax -->
<?php
if ($page == 'ciudad')
	include './assets/js/ajaxciu.php';
elseif ($page == 'establecimiento')
	include './assets/js/ajaxest.php';
elseif ($page == 'zona')
	include './assets/js/ajaxzon.php';

elseif ($page == 'cuenta')
	include './assets/js/ajaxcue.php';
elseif ($page == 'tipocampana')
	include './assets/js/ajaxtip.php';
elseif ($page == 'campana')
	include './assets/js/ajaxcam.php';
elseif ($page == 'usuario')
	include './assets/js/ajaxusu.php';
elseif ($page == 'campana_est')
	include './assets/js/ajaxcam_est.php';
elseif ($page == 'admin')
	include './assets/js/ajaxadm.php';
else
	include './assets/js/ajax.php';
?>