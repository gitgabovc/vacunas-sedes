<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box ">
  <div class="box-header">
    <form action="<?php echo site_url('Reporte/generarReporte') ?>" method="post" target="_blank">
      <div class="input-group form-group col-md-4 d-block" style="margin:10px;">
        <span class="input-group-addon" id="sizing-addon2">
          Gestion:
        </span>
        <select name="gestion" class="form-control" id="gestion" aria-describedby="sizing-addon2" style="width: 100% !important">

          <option <?php if ($id == 0) {
                    echo 'selected';
                  } ?>selected value="0">(Todos)</option>

          <?php foreach ($gestiones as $item) : ?>
            <option value="<?php echo $item['id']; ?>" <?php if ($id != 0 && $item['id'] == $id) {
                                                          echo "selected";
                                                        } ?>>
              <?php echo $item['id']; ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="input-group form-group col-md-4 d-block " style="margin:10px;">
        <span class="input-group-addon" id="sizing-addon1">
          Campaña:
        </span>
        <select name="campana" id="campana" class="form-control" aria-describedby="sizing-addon1" style="width: 100%">
          <option selected value="0">(Todos)</option>
          <?php foreach ($listacampana as $item) :
          ?>
            <option value="<?php echo $item->id;
                            ?>" <?php if ($item->id == $idCampana) echo "selected"
                                ?>><?php echo $item->descripcion . ' ( ' . $item->fechaini . ' ) ';
                                    ?></option>
          <?php endforeach;
          ?>
        </select>
      </div>
      <div class="input-group form-group col-md-4 d-block " id="establecimientos" style="margin:10px;">
        <span class="input-group-addon" id="sizing-addon1">
          Establecimiento:
        </span>
        <select name="establecimiento" id="establecimiento" class="form-control" aria-describedby="sizing-addon1" style="width: 100%">
          <option value="0">(Todos)</option>
          <?php foreach ($listaestablecimientos as $item) :
          ?>
            <option value="<?php echo $item->id;
                            ?>" <?php //if ($item->id == $id) echo "selected" 
                                ?>><?php echo $item->nombre;
                                    ?></option>
          <?php endforeach;
          ?>
        </select>
      </div>

      <div class="form-check form-check-inline" style="margin-left:10px;">
        <input class="form-check-input" type="radio" name="tipoReporte" id="inlineRadio2" value="detalleCampana">
        <label class="form-check-label" for="inlineRadio2">Detalle de la campaña</label>
      </div>

      <div class="form-check form-check-inline" style="margin-left:10px; margin-top:10px;">
        <input class="form-check-input" type="radio" name="tipoReporte" id="inlineRadio1" value="resumenCampana" checked>
        <label class="form-check-label" for="inlineRadio1">Resumen de la campaña</label>
      </div>
      <div class="form-check form-check-inline" style="margin-left:10px;">
        <input class="form-check-input" type="radio" name="tipoReporte" id="inlineRadio3" value="resumenEdades">
        <label class="form-check-label" for="inlineRadio2">Resumen edades animales</label>
      </div>

      <div class="text-left" style="margin-left:10px; margin-top:30px; ">
        <button type='submit' name="print" class="btn btn-success " style="width:15%;"><i class="glyphicon glyphicon-ok"></i> OK</button>
        <button id="exportar" type='submit' name="excel" class="btn btn-warning " style="width:15%;"><i class="glyphicon glyphicon glyphicon-floppy-save"></i> XLS</button>
      </div>


    </form>

  </div>
  <!-- /.box-header -->

</div>

<script type="text/javascript">
  $(document).ready(function() {
    // if($('#idCampana').val()!=0){
    //   $('#campana').change();
    // }
    $('#gestion').on('change', function() {
      var idu = $(this).val();
      console.log(idu);
      $.ajax({
        type: 'POST',
        url: '<?php echo site_url('Reporte/getsubuni'); ?>',
        data: {
          idu: idu
        },
        success: function(data) {
          $('#campana').html('<option value = "0">(Todos)</option>');

          var dataObj = jQuery.parseJSON(data);
          console.log(dataObj);
          //console.log(dataObj);
          if (dataObj) {
            $.each(dataObj, function(id, nombre) {
              var option = $('<option>', {
                value: id,
                text: nombre
              });

              $('#campana').append(option);
            });
            $('#campana').change();
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log(errorThrown);
          // alert('Error al procesar solitud: ' + textStatus);
        }
      });
    });

    $('#campana').on('change', function() {
      var ids = $(this).val();
      console.log(ids);
      $.ajax({
        type: 'POST',
        url: '<?php echo site_url('reporte/getcateprog'); ?>',
        data: {
          ids: ids
        },
        success: function(data) {
          $('#establecimiento').html('');
          var dataObj = jQuery.parseJSON(data);
          console.log(dataObj);
          if (dataObj) {
            var option1 = $('<option>', {
              value: 0,
              text: '(Todos)'
            });
            $('#establecimiento').append(option1);
            $.each(dataObj, function(id, nombre) {
              var option = $('<option>', {
                value: id,
                text: nombre
              });
              $('#establecimiento').append(option);
            });
            var count = $("#establecimiento :selected").length;
            if (count == 0)
              $('#establecimiento').html('<option value = "1">(Ningun establecimiento)</option>');
          } else {}
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log(errorThrown);
          // alert('Error al procesar solitud: ' + textStatus);
        }
      });
    });
  });
</script>