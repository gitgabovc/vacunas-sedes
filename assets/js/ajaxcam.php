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
		listaCampana();
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
	// Campana -------------------------------------------------------
	function listaCampana() {
		$.get("<?php echo site_url('Campana/listado'); ?>", function(data) {
			MyTable.fnDestroy();
			$('#data-campana').html(data);
			refresh();
		});
	}

	var id_campana;
	$(document).on("click", ".confirmarDel-campana", function() {
		id_campana = $(this).attr("data-id");
	})
	$(document).on("click", ".boxDelete", function() {
		var id = id_campana;		
		$.ajax({
			method: "POST",
			url: "<?php echo site_url('Campana/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#confirmarDel').modal('hide');
			listaCampana();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on("click", ".update-campana", function() {
		var id = $(this).attr("data-id");
		$.ajax({
			method: "POST",
			url: "<?php echo site_url('Campana/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-campana').modal('show');
		})
	})

	//prueba llevar a otra pagina
	// $(document).on("click", '.usuarios', function() {
	// 	var id = $(this).attr("data-id");
	// 	console.log(id);
	// 	$.ajax({
	// 		method: "POST",
	// 		url: "<?php // echo site_url('Campana/establecimiento'); ?>",
	// 		data: "id=" +id
	// 	})
	// 	.done(function(data) {
			

	// 		// window.location.href = '"<?php //echo site_url('Campana/establecimiento'); ?>"';
	// 	})
	// })

	$('#form-campana').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: "<?php echo site_url('Campana/procesaInsert'); ?>",
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			listaCampana();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-campana").reset();
				$('#modal-campana').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-campana', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: "<?php echo site_url('Campana/procesaUpdate'); ?>",
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			listaCampana();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-campana").reset();
				$('#update-campana').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})		
		e.preventDefault();
	});

	$('#modal-campana').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-campana').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

</script>