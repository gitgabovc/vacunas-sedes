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
		listaUsuario();
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
	// Usuario -------------------------------------------------------
	function listaUsuario() {
		$.get("<?php echo site_url('Usuario/listado'); ?>", function(data) {
			MyTable.fnDestroy();
			$('#data-usuario').html(data);
			refresh();
		});
	}

	var id_cuenta;
	$(document).on("click", ".confirmarDel-usuario", function() {
		id_cuenta = $(this).attr("data-id");
	})
	$(document).on("click", ".boxDelete", function() {
		var id = id_cuenta;		
		$.ajax({
			method: "POST",
			url: "<?php echo site_url('Usuario/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#confirmarDel').modal('hide');
			listaUsuario();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on("click", ".update-usuario", function() {
		var id = $(this).attr("data-id");
		$.ajax({
			method: "POST",
			url: "<?php echo site_url('Usuario/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-usuario').modal('show');
		})
	})

	$('#form-usuario').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: "<?php echo site_url('Usuario/procesaInsert'); ?>",
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			listaUsuario();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-usuario").reset();
				$('#modal-usuario').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-usuario', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: "<?php echo site_url('Usuario/procesaUpdate'); ?>",
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			listaUsuario();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-usuario").reset();
				$('#update-usuario').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})		
		e.preventDefault();
	});

	$('#modal-usuario').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-usuario').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

</script>