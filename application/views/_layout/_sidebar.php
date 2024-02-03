<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo base_url(); ?>assets/img/<?php echo $userdata->foto; ?>" class="img-circle">
      </div>
      <div class="pull-left info">
        <p><?php echo $userdata->nama; ?></p>
        <!-- Status -->
        <a href="<?php echo base_url(); ?>assets/#"><i class="fa fa-circle text-success"></i> Activo</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li class="header">MENU</li>
      <!-- Optionally, you can add icons to the links -->

      <li <?php if ($page == 'home') {
            echo 'class="active"';
          } ?>>
        <a href="<?php echo site_url('Home'); ?>">
          <i class="fa fa-home"></i>
          <span>Inicio</span>
        </a>
      </li>

      <li <?php if ($page == 'agentes') {
            echo 'class="active"';
          } ?>>
        <a href="<?php echo site_url('Usuario'); ?>">
          <i class="fa fa-user"></i>
          <span>Usuarios</span>
        </a>
      </li>

      <li <?php if ($page == 'inmueble') {
            echo 'class="active"';
          } ?>>
        <a href="<?php echo site_url('Campana'); ?>">
          <i class="fa fa-home"></i>
          <span>Campañas</span>
        </a>
      </li>


      <li <?php if ($page == 'reporte') {
            echo 'class="active"';
          } ?>>
        <a href="<?php echo site_url('Reporte'); ?>">
          <i class="fa fa-briefcase"></i>
          <span>Reportes</span>
        </a>
      </li>



      <li class="treeview">
        <a href="#"><i class="fa fa-wrench"></i> Configurar<i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li <?php if ($page == 'ciudad') {
                echo 'class="active"';
              } ?>><a href="<?php echo site_url('Ciudad'); ?>">
              <i class="fa fa-asterisk"></i> <span>Municipios</span>
            </a></li>
          <li><a href="<?php echo site_url('Zona'); ?>">
              <i class="fa fa-asterisk"></i> <span>Zonas</span>
            </a></li>
          <li><a href="<?php echo site_url('Establecimiento'); ?>">
              <i class="fa fa-asterisk"></i> <span>Establecimientos</span>
            </a></li>
          <li><a href="<?php echo site_url('Tipocampana'); ?>">
              <i class="fa fa-asterisk"></i> <span>Tipo Campaña</span>
            </a></li>
          <li><a href="<?php echo site_url('Admin'); ?>">
              <i class="fa fa-asterisk"></i> <span>Administradores</span>
            </a></li>
        </ul>
      </li>


    </ul>
    <!-- /.sidebar-menu -->

  </section>
  <!-- /.sidebar -->

</aside>