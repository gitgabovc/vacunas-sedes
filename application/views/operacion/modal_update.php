<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Modificar Datos operacion</h3>
      <form method="POST" id="form-update-operacion">
        <input type="hidden" name="id" value="<?php echo $dataoperacion->id; ?>">
        
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-key"></i>Código:
      </span>
      <input type="text" class="form-control" placeholder="Código" name="codigo" aria-describedby="sizing-addon2" value="<?php echo $dataoperacion->codigo; ?>">
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-card"></i>C.I.:
      </span>
      <input type="text" class="form-control" placeholder="C.I." name="ci" aria-describedby="sizing-addon2" value="<?php echo $dataoperacion->ci; ?>">
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-user"></i>
      </span>
      <input type="text" class="form-control" placeholder="Nombres" name="nombres" aria-describedby="sizing-addon2" value="<?php echo $dataoperacion->nombres; ?>">
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-user"></i>
      </span>
      <input type="text" class="form-control" placeholder="Apellidos" name="apellidos" aria-describedby="sizing-addon2" value="<?php echo $dataoperacion->apellidos; ?>">
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-calendar"></i> Fecha Nacimiento:
      </span>
      <input type="date" class="form-control" placeholder="Fecha" name="fecnac" aria-describedby="sizing-addon2" value="<?php echo $dataoperacion->fecnac; ?>">
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-phone-alt"></i>
      </span>
      <input type="text" class="form-control" placeholder="Teléfono" name="telefono" aria-describedby="sizing-addon2" value="<?php echo $dataoperacion->telefono; ?>">
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-home"></i>
      </span>
      <input type="text" class="form-control" placeholder="Dirección" name="direccion" aria-describedby="sizing-addon2" value="<?php echo $dataoperacion->direccion; ?>">
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-envelope"></i>
      </span>
      <input type="email" class="form-control" placeholder="Correo" name="correo" aria-describedby="sizing-addon2" value="<?php echo $dataoperacion->correo; ?>">
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-calendar"></i> Fecha Ingreso:
      </span>
      <input type="date" class="form-control" placeholder="In" name="fechain" aria-describedby="sizing-addon2" value="<?php echo $dataoperacion->fechain; ?>">
    </div>
	
        <div class="form-group">
          <div class="col-md-12">
              <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Guardar</button>
          </div>
        </div>
      </form>
</div>
