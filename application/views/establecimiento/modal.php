<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Nuevo Establecimiento</h3>

  <form id="form-establecimiento" method="POST">
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-home"></i>
      </span>
      <input type="text" class="form-control" placeholder="Establecimiento" name="nombre" aria-describedby="sizing-addon2">
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-tasks"></i>
      </span>
      <input type="text" class="form-control" placeholder="Código" name="codigo" aria-describedby="sizing-addon2">
    </div>

    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-user"></i>
      </span>
      <select name="responsable_id" class="form-control" aria-describedby="sizing-addon1" style="width: 100%">
        <option value="0" selected disabled>Seleccione Responsable</option>
        <?php foreach ($dataResponsable as $item) :
        ?>
          <option value="<?php echo  $item->id;
                          ?>"><?php echo $item->nombre;
                              ?></option>
        <?php endforeach;
        ?>
      </select>
    </div>


    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon1">
        Municipio:
      </span>
      <select name="municipio" class="form-control" aria-describedby="sizing-addon1" style="width: 100%">
        <option value="0" selected disabled>Seleccione Municipio</option>
        <?php foreach ($dataMunicipio as $item) :
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