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
		listarCaja();
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
	
// ----------------------------------------------------------------------------------------------------------
	//Caja
	function listarCaja() {
		$.get("<?php echo site_url('Caja/listado'); ?>", function(data) {
			MyTable.fnDestroy();
			$('#data-caja').html(data);
			refresh();
		});
	}

	var id_caja;
	$(document).on("click", ".konfirmasiHapus-caja", function() {
		id_caja = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataCaja", function() {
		var id = id_caja;
		
		$.ajax({
			method: "POST",
			url: "<?php echo site_url('Caja/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			listarCaja();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on("click", ".update-dataCaja", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo site_url('Caja/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-caja').modal('show');
		})
	})

	$(document).on("click", ".detail-dataCaja", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo site_url('Caja/detail'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#tabel-detail').dataTable({
				  "paging": true,
				  "lengthChange": false,
				  "searching": true,
				  "ordering": true,
				  "info": true,
				  "autoWidth": false
				});
			$('#detail-caja').modal('show');
		})
	})


	$('#form-caja').submit(function(e) {
		var data = $(this).serialize();
		$.ajax({
			method: 'POST',
			url: "<?php echo site_url('Caja/procesaInsert'); ?>",
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);
			listarCaja();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-caja").reset();
				$('#modal-caja').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})		
		e.preventDefault();
	});
	

	$(document).on('submit', '#form-update-caja', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: "<?php echo site_url('Caja/prosesUpdate'); ?>",
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			listarCaja();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-caja").reset();
				$('#update-caja').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$('#modal-caja').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-caja').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})
	
	
</script>