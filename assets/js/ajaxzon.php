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
		listarZona();
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

	// Zona  --------------------------------------------------------------------------------
	// no olvidar aumentar esta func arriba en:	window.onload
	function listarZona() {
		$.get("<?php echo site_url('Zona/listado'); ?>", function(data) {
			MyTable.fnDestroy();
			$('#data-zona').html(data);
			refresh();
		});
	}

	var id_zona;
	$(document).on("click", ".konfirmasiHapus-zona", function() {
		id_zona = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataZona", function() {
		var id = id_zona;		
		$.ajax({
			method: "POST",
			url: "<?php echo site_url('Zona/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			listarZona();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on("click", ".update-dataZona", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo site_url('Zona/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-zona').modal('show');
		})
	})

	$('#form-zona').submit(function(e) {
		var data = $(this).serialize();
		$.ajax({
			method: 'POST',
			url: "<?php echo site_url('Zona/procesarZona'); ?>",
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);
			listarZona();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-zona").reset();
				$('#modal-zona').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-zona', function(e){
		var data = $(this).serialize();
		$.ajax({
			method: 'POST',
			url: "<?php echo site_url('Zona/prosesUpdate'); ?>",
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);
			listarZona();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-zona").reset();
				$('#update-zona').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})		
		e.preventDefault();
	});

	$('#modal-zona').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-zona').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
	
</script>