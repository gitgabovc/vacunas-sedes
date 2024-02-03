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
		listarTipoinmueble();
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

	//Tipocampana  --------------------------------------------------------------------------------
	// no olvidar aumentar esta func arriba en:	window.onload
	function listarTipocampana() {
		$.get("<?php echo site_url('Tipocampana/listado'); ?>", function(data) {
			MyTable.fnDestroy();
			$('#data-tipocampana').html(data);
			refresh();
		});
	}

	var id_tcam;
	$(document).on("click", ".confirmarDel-tipocampana", function() {
		id_tcam = $(this).attr("data-id");
	})
	$(document).on("click", ".boxDelete", function() {
		var id = id_tcam;		
		$.ajax({
			method: "POST",
			url: "<?php echo site_url('Tipocampana/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#confirmarDel').modal('hide');
			listarTipocampana();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on("click", ".update-dataTipocampana", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo site_url('Tipocampana/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-tipocampana').modal('show');
		})
	})

	$('#form-tipocampana').submit(function(e) {
		var data = $(this).serialize();
		$.ajax({
			method: 'POST',
			url: "<?php echo site_url('Tipocampana/procesarTipocampana'); ?>",
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);
			listarTipocampana();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tipocampana").reset();
				$('#modal-tipocampana').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-tipocampana', function(e){
		var data = $(this).serialize();
		$.ajax({
			method: 'POST',
			url: "<?php echo site_url('Tipocampana/prosesUpdate'); ?>",
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);
			listarTipocampana();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-tipocampana").reset();
				$('#update-tipocampana').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})		
		e.preventDefault();
	});

	$('#modal-tipocampana').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-tipocampana').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
	
</script>