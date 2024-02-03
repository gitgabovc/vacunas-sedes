<div class="row">
  <div class="col-md-3">
    <!-- Profile Image -->
    <div class="box box-primary">
      <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url(); ?>assets/img/<?php echo $userdata->foto; ?>" alt="User profile picture">

        <h3 class="profile-username text-center"><?php echo $userdata->nama; ?></h3>

        <p class="text-muted text-center">Usuario</p>

        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <b>Nombre de Usuario</b> <a class="pull-right"><?php echo $userdata->username; ?></a>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <div class="col-md-9">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#settings" data-toggle="tab">Datos</a></li>
        <li><a href="#password" data-toggle="tab">Contraseña</a></li>
      </ul>
      <div class="tab-content">
        <div class="active tab-pane" id="settings">
          <form class="form-horizontal" action="<?php echo site_url('Profile/update') ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="inputUsername" class="col-sm-2 control-label">Usuario:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id= placeholder="Nombre de usuario" name="username" value="<?php echo $userdata->username; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="nama" class="col-sm-2 control-label">Nombre:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" placeholder="Nombre" name="nama" value="<?php echo $userdata->nama; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputFoto" class="col-sm-2 control-label">Foto:</label>
              <div class="col-sm-10">
                <input type="file" class="form-control" placeholder="Foto" name="foto">
              </div>
            </div>
            
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-danger">Guardar</button>
              </div>
            </div>
          </form>
        </div>
        <div class="tab-pane" id="password">
          <form class="form-horizontal" action="<?php echo site_url('Profile/up_password') ?>" method="POST">
            <div class="form-group">
              <label for="passAct" class="col-sm-2 control-label">Actual:</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" placeholder="Contraseña Actual" name="passAct">
              </div>
            </div>
            <div class="form-group">
              <label for="passNue" class="col-sm-2 control-label">Nueva:</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" placeholder="Contraseña Nueva" name="passNue">
              </div>
            </div>
            <div class="form-group">
              <label for="passRep" class="col-sm-2 control-label">Repita Nueva:</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" placeholder="Repita Contraseña" name="passRep">
              </div>
            </div>
            
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-danger">Guardar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="msg" style="display:none;">
      <?php echo $this->session->flashdata('msg'); ?>
    </div>
  </div>
</div>