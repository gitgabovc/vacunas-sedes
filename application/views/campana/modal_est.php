<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Datos de los Establecimientos</h3>

  <form id="form-campana-est" method="POST">
    <input type="hidden" name='id-camp-est' value='<?php echo $id ?>'>
    
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon1">
        Establecimiento:
      </span>
      <select name="tipo_campana_id_est" class="form-control" aria-describedby="sizing-addon1" style="width: 100%">
        <?php foreach ($dataestablecnombre as $item) :
        ?>
          <option value="<?php echo  $item->id;
                          ?>"><?php echo $item->nombre;
                              ?></option>
        <?php endforeach;
        ?>
      </select>
    </div>
    <div class="form-group">
      <div class="col-md-12">
        <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Guardar</button>
      </div>
    </div>
  </form>
</div>