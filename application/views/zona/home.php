<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  <div class="box-header">
    <div class="col-md-6">
        <button class="form-control btn btn-primary" data-toggle="modal" data-target="#modal-zona"><i class="glyphicon glyphicon-plus-sign"></i> Adicionar</button>
    </div>
    <div class="col-md-3">
        <a href="<?php echo site_url('Zona/export'); ?>" class="form-control btn btn-default"><i class="glyphicon glyphicon glyphicon-floppy-save"></i> Export Data Excel</a>
    </div>
    <div class="col-md-3">
        <button class="form-control btn btn-default" data-toggle="modal" data-target="#import-zona"><i class="glyphicon glyphicon glyphicon-floppy-open"></i> Import Data Excel</button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Zona</th>
          <th style="text-align: center;">Opciones</th>
        </tr>
      </thead>
      <tbody id="data-zona">
      
      </tbody>
    </table>
  </div>
</div>

<?php echo $modal_template_zona; ?>

<div id="tempat-modal"></div>

<?php show_my_confirm('konfirmasiHapus', 'hapus-dataZona', 'Eliminar zona?', 'Si, Eliminar'); ?>
<?php
  $data['judul'] = 'Zona';
  $data['url'] = 'Zona/import';
  echo show_my_modal('modals/modal_import', 'import-zona', $data);
  // las funciones jquery estan en su propio archivo, que se carga en C:\inetpub\wwwroot\crud\application\views\_layout\_js.php
?>