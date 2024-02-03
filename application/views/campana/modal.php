<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Datos de la Campaña</h3>

  <form id="form-campana" method="POST">

    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon1">
        Tipo Campaña:
      </span>
      <select name="tipo_campana_id" class="form-control"  aria-describedby="sizing-addon1" style="width: 100%">
          <?php foreach($tipocampana as $item): ?>
		  <option value="<?php echo $item->id; ?>"><?php echo $item->descripcion; ?></option>
		  <?php endforeach; ?>
      </select>
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        Gestion:
      </span>
      <select name="gestion" class="form-control"  aria-describedby="sizing-addon2" style="width: 100%">
          <?php foreach($gestiones as $item): ?>
		  <option value="<?php echo $item['id']; ?>"><?php echo $item['id']; ?></option>
		  <?php endforeach; ?>
      </select>
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon3">
        <i class="glyphicon glyphicon-star"></i> Desc.:
      </span>
      <input type="text" class="form-control" placeholder="Descripcion" name="descripcion" aria-describedby="sizing-addon3">
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon4">
        <i class="glyphicon glyphicon-calendar"></i> Inicio:
      </span>
      <input type="date" class="form-control" placeholder="" name="fechaini" aria-describedby="sizing-addon4">
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon5">
        <i class="glyphicon glyphicon-calendar"></i> Fin:
      </span>
      <input type="date" class="form-control" placeholder="" name="fechafin" aria-describedby="sizing-addon5">
    </div>
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Guardar</button>
      </div>
    </div>
  </form>
</div>

