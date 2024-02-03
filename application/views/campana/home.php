<div class="msg" style="display:none;">
  <?php echo @$this->session->flashdata('msg'); ?>
</div>

<div class="box">
  <div class="box-header">
    <div class="col-md-6" style="padding: 0;">
      <button class="form-control btn btn-primary" data-toggle="modal" data-target="#modal-campana"><i class="glyphicon glyphicon-plus-sign"></i> Adicionar</button>
    </div>
    <div class="col-md-3">
    </div>
    <div class="col-md-3">
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="list-data" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Gestion</th>
          <th>Descripcion</th>
          <th>Inicio</th>
          <th>Fin</th>
          <th style="text-align: center;">Operaciones</th>
        </tr>
      </thead>
      <tbody id="data-campana">

      </tbody>
    </table>
  </div>
</div>

<?php echo $modal_campana; ?>

<div id="tempat-modal"></div>

<?php show_my_confirm('confirmarDel', 'boxDelete', 'Seguro de eliminar?', 'Si, eliminar'); ?>
<?php
$data['modalTitle'] = 'Campana';
$data['url'] = 'campana/import';
echo show_my_modal('modals/modal_import', 'import-campana', $data);
?>