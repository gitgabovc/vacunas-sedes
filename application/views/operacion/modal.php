<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Datos de la operacion</h3>

  <form id="form-operacion" method="POST">
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-key"></i>Inmueble:
      </span>
	  <select name="idinmueble" class="form-control">
	  <?php foreach($datainmuebles as $item): ?>
          <option value="<?php echo $item->id; ?>">
            <?php echo $item->propietario; ?> (<?php echo $item->descripcion; ?>)
          </option>
	  <?php endforeach; ?>
	  </select>
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-card"></i>Monto de Cierre:
      </span>
      <input type="text" class="form-control" placeholder="Importe" name="importe" aria-describedby="sizing-addon2">
    </div>    
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-calendar"></i>Fecha
      </span>
      <input type="date" class="form-control" placeholder="Fecha" name="fecha" aria-describedby="sizing-addon2">
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-usd"></i>
      </span>
      <input type="text" class="form-control" placeholder="Comision Total" name="comisionTotal" aria-describedby="sizing-addon2">
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-usd"></i>
      </span>
      <input type="text" class="form-control" placeholder="Comisión Agente" name="comisionAge" aria-describedby="sizing-addon2">
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-usd"></i>
      </span>
      <input type="text" class="form-control" placeholder="Comisión Remax" name="comisionRem" aria-describedby="sizing-addon2">
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-usd"></i>
      </span>
      <input type="text" class="form-control" placeholder="Retención" name="retencion" aria-describedby="sizing-addon2">
    </div>    
    <!-- div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-briefcase"></i>
      </span>
      <select name="rango" class="form-control"  aria-describedby="sizing-addon2" style="width: 100%">
          <option value="1">Rango 1</option>
          <option value="2">Rango 2</option>
      </select>
    </div -->
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Guardar</button>
      </div>
    </div>
  </form>
</div>

