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
		listarCiudad();
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

	//Ciudad  --------------------------------------------------------------------------------
	// no olvidar aumentar esta func arriba en:	window.onload
	function listarCiudad() {
		$.get("<?php echo site_url('Ciudad/listado'); ?>", function(data) {
			MyTable.fnDestroy();
			$('#data-ciudad').html(data);
			refresh();
		});
	}

	var id_ciudad;
	$(document).on("click", ".confirmarDel-ciudad", function() {
		id_ciudad = $(this).attr("data-id");
	})
	$(document).on("click", ".boxDelete", function() {
		var id = id_ciudad;		
		$.ajax({
			method: "POST",
			url: "<?php echo site_url('Ciudad/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#confirmarDel').modal('hide');
			listarCiudad();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on("click", ".update-dataCiudad", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo site_url('Ciudad/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-ciudad').modal('show');
		})
	})

	$('#form-ciudad').submit(function(e) {
		var data = $(this).serialize();
		$.ajax({
			method: 'POST',
			url: "<?php echo site_url('Ciudad/procesarCiudad'); ?>",
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);
			listarCiudad();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-ciudad").reset();
				$('#modal-ciudad').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-ciudad', function(e){
		var data = $(this).serialize();
		$.ajax({
			method: 'POST',
			url: "<?php echo site_url('Ciudad/prosesUpdate'); ?>",
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);
			listarCiudad();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-ciudad").reset();
				$('#update-ciudad').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})		
		e.preventDefault();
	});

	$('#modal-ciudad').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-ciudad').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
	
</script>