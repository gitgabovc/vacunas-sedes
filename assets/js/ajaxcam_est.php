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
		listaCampanaEst();
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
	// Campana -------------------------------------------------------
	function listaCampanaEst() {
		var id = $('#id-est').val();
		$.get("<?php echo site_url('Campana/listadoEst'); ?>" + '/' + id, function(data) {
			MyTable.fnDestroy();
			$('#data-campana-est').html(data);
			refresh();
		});
	}

	var id_campana_est;
	$(document).on("click", ".confirmarDel-campana-est", function() {
		id_campana_est = $(this).attr("data-id");
	})
	$(document).on("click", ".boxDelete", function() {
		var id = id_campana_est;
		$.ajax({
				method: "POST",
				url: "<?php echo site_url('Campana/delete_establecimineto_de_campana'); ?>",
				data: "id=" + id
			})
			.done(function(data) {
				$('#confirmarDel').modal('hide');
				listaCampanaEst();
				$('.msg').html(data);
				effect_msg();
			})
	})

	$(document).on("click", ".update-campana-est", function() {
		var ids = $(this).attr("data-id");
		console.log(ids);
		
		$.ajax({
				method: "POST",
				url: "<?php echo site_url('Campana/update_establecimiento_de_campana'); ?>",
				data: "id=" + ids
			})
			.done(function(data) {
				$('#tempat-modal').html(data);
				$('#update-campana-est').modal('show');
			})
	})
	

	//prueba llevar a otra pagina
	// $(document).on("click", '.usuarios', function() {
	// 	var id = $(this).attr("data-id");
	// 	console.log(id);
	// 	$.ajax({
	// 		method: "POST",
	// 		url: "<?php // echo site_url('Campana/establecimiento'); 
						?>",
	// 		data: "id=" +id
	// 	})
	// 	.done(function(data) {


	// 		// window.location.href = '"<?php //echo site_url('Campana/establecimiento'); 
											?>"';
	// 	})
	// })

	$('#form-campana-est').submit(function(e) {
		console.log($(this).serialize());
		var data = $(this).serialize();
		// console.log(data);
		$.ajax({
				method: 'POST',
				url: "<?php echo site_url('Campana/procesaInsertEst'); ?>",
				data: data
			})
			.done(function(data) {
				var out = jQuery.parseJSON(data);

				listaCampanaEst();
				if (out.status == 'form') {
					$('.form-msg').html(out.msg);
					effect_msg_form();
				} else {
					document.getElementById("form-campana-est").reset();
					$('#modal-campana-est').modal('hide');
					$('.msg').html(out.msg);
					effect_msg();
				}
			})
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-campana-est', function(e) {
		var data = $(this).serialize();
		console.log(data);
		$.ajax({
				method: 'POST',
				url: "<?php echo site_url('Campana/procesaUpdate_est'); ?>",
				data: data
			})
			.done(function(data) {
				var out = jQuery.parseJSON(data);

				listaCampanaEst();
				if (out.status == 'form') {
					$('.form-msg').html(out.msg);
					effect_msg_form();
				} else {
					document.getElementById("form-update-campana-est").reset();
					$('#update-campana-est').modal('hide');
					$('.msg').html(out.msg);
					effect_msg();
				}
			})
		e.preventDefault();
	});

	$('#modal-campana-est').on('hidden.bs.modal', function() {
		$('.form-msg').html('');
	})

	$('#update-campana-est').on('hidden.bs.modal', function() {
		$('.form-msg').html('');
	})
</script>