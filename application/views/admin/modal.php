<div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
  <div class="form-msg"></div>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h3 style="display:block; text-align:center;">Datos del Usuario</h3>

  <form id="form-admin" method="POST" enctype="multipart/form-data">
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon1">
        <i class="glyphicon glyphicon-user"></i>
      </span>
      <input type="text" class="form-control" placeholder="Nombre" name="nombre" aria-describedby="sizing-addon1" required>
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon2">
        <i class="glyphicon glyphicon-tag"></i>
      </span>
      <input type="text" class="form-control" placeholder="Usuario" name="usuario" aria-describedby="sizing-addon2" required>
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon3">
        <i class="glyphicon glyphicon-lock"></i>
      </span>
      <input type="text" class="form-control" placeholder="Contraseña" name="password" aria-describedby="sizing-addon3" required>
    </div>
    <div class="input-group form-group">
      <span class="input-group-addon" id="sizing-addon4">
        Foto:
      </span>
      <input type="file" class="form-control" placeholder="Foto" name="foto" accept=".pdf,.jpg,.jpeg" aria-describedby="sizing-addon4">
    </div>
    <div class="form-group">
      <div class="col-md-12">
          <button type="submit" class="form-control btn btn-primary"> <i class="glyphicon glyphicon-ok"></i> Guardar</button>
      </div>
    </div>
  </form>
</div>

