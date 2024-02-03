<script type="text/javascript">
	var MyTable = $('#list-data').dataTable({
		  "paging": true,
		  "lengthChange": true,
		  "searching": true,
		  "ordering": true,
		  "info": true,
		  "autoWidth": false
		});

	window.onload = function() {
		listaCuenta();
		<?php
			if ($this->session->flashdata('msg') != '') {
				echo "effect_msg();";
			}
		?>
	}

	function refresh() {
		MyTable = $('#list-data').dataTable();
	}

	function effect_msg_form() {
		// $('.form-msg').hide();
		$('.form-msg').show(1000);
		setTimeout(function() { $('.form-msg').fadeOut(1000); }, 3000);
	}

	function effect_msg() {
		// $('.msg').hide();
		$('.msg').show(1000);
		setTimeout(function() { $('.msg').fadeOut(1000); }, 3000);
	}
	// Cuenta -------------------------------------------------------
	function listaCuenta() {
		$.get("<?php echo site_url('Cuenta/listado'); ?>", function(data) {
			MyTable.fnDestroy();
			$('#data-cuenta').html(data);
			refresh();
		});
	}

	var id_cuenta;
	$(document).on("click", ".confirmarDel-cuenta", function() {
		id_cuenta = $(this).attr("data-id");
	})
	$(document).on("click", ".boxDelete", function() {
		var id = id_cuenta;		
		$.ajax({
			method: "POST",
			url: "<?php echo site_url('Cuenta/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#confirmarDel').modal('hide');
			listaCuenta();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on("click", ".update-cuenta", function() {
		var id = $(this).attr("data-id");
		$.ajax({
			method: "POST",
			url: "<?php echo site_url('Cuenta/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-cuenta').modal('show');
		})
	})

	$('#form-cuenta').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: "<?php echo site_url('Cuenta/procesaInsert'); ?>",
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			listaCuenta();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-cuenta").reset();
				$('#modal-cuenta').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-cuenta', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: "<?php echo site_url('Cuenta/procesaUpdate'); ?>",
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			listaCuenta();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-cuenta").reset();
				$('#update-cuenta').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})		
		e.preventDefault();
	});

	$('#modal-cuenta').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-cuenta').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

</script>