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
		listaAgente();
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
	// Agente -------------------------------------------------------
	function listaAgente() {
		$.get("<?php echo site_url('Agente/listado'); ?>", function(data) {
			MyTable.fnDestroy();
			$('#data-agente').html(data);
			refresh();
		});
	}

	var id_agente;
	$(document).on("click", ".confirmarDel-agente", function() {
		id_agente = $(this).attr("data-id");
	})
	$(document).on("click", ".boxDelete", function() {
		var id = id_agente;		
		$.ajax({
			method: "POST",
			url: "<?php echo site_url('Agente/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#confirmarDel').modal('hide');
			listaAgente();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on("click", ".update-agente", function() {
		var id = $(this).attr("data-id");
		$.ajax({
			method: "POST",
			url: "<?php echo site_url('Agente/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-agente').modal('show');
		})
	})

	$('#form-agente').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: "<?php echo site_url('Agente/procesaInsert'); ?>",
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			listaAgente();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-agente").reset();
				$('#modal-agente').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-agente', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: "<?php echo site_url('Agente/procesaUpdate'); ?>",
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			listaAgente();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-agente").reset();
				$('#update-agente').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})		
		e.preventDefault();
	});

	$('#modal-agente').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-agente').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

</script>