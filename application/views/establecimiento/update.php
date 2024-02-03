<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Modificar Establecimiento</h3>

  <form id="form-update-establecimiento" method="POST">
    <input type="hidden" name="id" value="<?php echo $dataEstablecimiento->id; ?>">
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-home"></i>
      </span>
      <input type="text" class="form-control" placeholder="Establecimiento" name="nombre" aria-describedby="sizing-addon2" value="<?php echo $dataEstablecimiento->nombre; ?>">
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-tasks"></i>
      </span>
      <input type="text" class="form-control" placeholder="Código" name="codigo" aria-describedby="sizing-addon2" value="<?php echo $dataEstablecimiento->codigo; ?>">
    </div>


    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-user"></i>
      </span>
      <select name="responsable" class="form-control" aria-describedby="sizing-addon2" style="width: 100%">
        <?php foreach ($dataResponsableUpdate as $item) :
        ?>
          <option value="<?php echo $item->id; ?>" <?php if ($item->id == $dataEstablecimiento->responsable_id) echo "selected" ?>><?php echo $item->nombre; ?></option>
        <?php endforeach;
        ?>
      </select>
    </div>

    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        Municipio:
      </span>
      <select name="municipio" class="form-control" aria-describedby="sizing-addon2" style="width: 100%">
        <?php foreach ($dataMunicipioupdate as $item) :
        ?>
          <option value="<?php echo $item->id; ?>" <?php if ($item->id == $dataEstablecimiento->municipio_id) echo "selected" ?>><?php echo $item->nombre; ?></option>
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