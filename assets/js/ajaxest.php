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
		listarEstablecimiento();
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
		setTimeout(function() {
			$('.form-msg').fadeOut(1000);
		}, 3000);
	}

	function effect_msg() {
		// $('.msg').hide();
		$('.msg').show(1000);
		setTimeout(function() {
			$('.msg').fadeOut(1000);
		}, 3000);
	}

	//Establecimiento  --------------------------------------------------------------------------------
	// no olvidar aumentar esta func arriba en:	window.onload
	function listarEstablecimiento() {
		// console.log('hola');
		$.get("<?php echo site_url('Establecimiento/listado'); ?>", function(data) {
			MyTable.fnDestroy();
			$('#data-establecimiento').html(data);
			refresh();
		});
	}

	var id_item;
	$(document).on("click", ".confirmarDel-est", function() {
		id_item = $(this).attr("data-id");
	})
	$(document).on("click", ".boxDelete", function() {
		var id = id_item;
		$.ajax({
				method: "POST",
				url: "<?php echo site_url('Establecimiento/delete'); ?>",
				data: "id=" + id
			})
			.done(function(data) {
				$('#confirmarDel').modal('hide');
				listarEstablecimiento();
				$('.msg').html(data);
				effect_msg();
			})
	})

	$(document).on("click", ".update-establecimiento", function() {
		var id = $(this).attr("data-id");

		$.ajax({
				method: "POST",
				url: "<?php echo site_url('Establecimiento/update'); ?>",
				data: "id=" + id
			})
			.done(function(data) {
				$('#tempat-modal').html(data);
				$('#update-establecimiento').modal('show');
			})
	})

	$('#form-establecimiento').submit(function(e) {
		var data = $(this).serialize();
		$.ajax({
				method: 'POST',
				url: "<?php echo site_url('Establecimiento/procesarEstablecimiento'); ?>",
				data: data
			})
			.done(function(data) {
				var out = jQuery.parseJSON(data);
				listarEstablecimiento();
				if (out.status == 'form') {
					$('.form-msg').html(out.msg);
					effect_msg_form();
				} else {
					document.getElementById("form-establecimiento").reset();
					$('#modal-establecimiento').modal('hide');
					$('.msg').html(out.msg);
					effect_msg();
				}
			})
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-establecimiento', function(e) {
		var data = $(this).serialize();
		$.ajax({
				method: 'POST',
				url: "<?php echo site_url('Establecimiento/prosesUpdate'); ?>",
				data: data
			})
			.done(function(data) {
				var out = jQuery.parseJSON(data);
				listarEstablecimiento();
				if (out.status == 'form') {
					$('.form-msg').html(out.msg);
					effect_msg_form();
				} else {
					document.getElementById("form-update-establecimiento").reset();
					$('#update-establecimiento').modal('hide');
					$('.msg').html(out.msg);
					effect_msg();
				}
			})
		e.preventDefault();
	});

	$('#modal-establecimiento').on('hidden.bs.modal', function() {
		$('.form-msg').html('');
	})

	$('#update-establecimiento').on('hidden.bs.modal', function() {
		$('.form-msg').html('');
	})
</script>