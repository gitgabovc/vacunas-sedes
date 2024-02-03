<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  <div class="box-header">
    <div class="col-md-6">
        <button class="form-control btn btn-primary" data-toggle="modal" data-target="#modal-ciudad"><i class="glyphicon glyphicon-plus-sign"></i> Adicionar</button>
    </div>
    <div class="col-md-3">
        <a href="<?php echo site_url('Ciudad/export'); ?>" class="form-control btn btn-default"><i class="glyphicon glyphicon glyphicon-floppy-save"></i> Export Data Excel</a>
    </div>
    <div class="col-md-3">
        <button class="form-control btn btn-default" data-toggle="modal" data-target="#import-ciudad"><i class="glyphicon glyphicon glyphicon-floppy-open"></i> Import Data Excel</button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Municipio</th>
          
          <th style="text-align: center;">Opciones</th>
        </tr>
      </thead>
      <tbody id="data-ciudad">
      
      </tbody>
    </table>
  </div>
</div>

<?php echo $modal_template_ciudad; ?>

<div id="tempat-modal"></div>

<?php show_my_confirm('confirmarDel', 'boxDelete', 'Eliminar municipio?', 'Si, Eliminar'); ?>
<?php
  $data['judul'] = 'Ciudad';
  $data['url'] = 'Ciudad/import';
  echo show_my_modal('modals/modal_import', 'import-ciudad', $data);
  // las funciones jquery estan en su propio archivo, que se carga en C:\inetpub\wwwroot\crud\application\views\_layout\_js.php
?>