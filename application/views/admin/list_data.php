
<?php
  foreach ($datausuario as $item) {
    ?>
    <tr>
      <td style="min-width:230px;"><?php echo $item->username; ?></td>
      <td><?php echo $item->nama; ?></td>
      <td class="text-center" style="min-width:230px;">
        <button class="btn btn-warning passwd-admin" data-id="<?php echo $item->id; ?>"><i class="glyphicon glyphicon-repeat"></i> Pass</button>
        <button class="btn btn-warning update-admin" data-id="<?php echo $item->id; ?>"><i class="glyphicon glyphicon-repeat"></i> Mod</button>
        <button class="btn btn-danger confirmarDel" data-id="<?php echo $item->id; ?>" data-toggle="modal" data-target="#confirmarDel"><i class="glyphicon glyphicon-remove-sign"></i> Eli</button>
      </td>
    </tr>
    <?php
  }
?>