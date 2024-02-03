
<?php
  foreach ($datausuario as $item) {
    ?>
    <tr>
      <td style="min-width:230px;"><?php echo $item->usuario; ?></td>
      <td><?php echo $item->nombre; ?></td>
      <td><?php echo $item->establecimiento; ?></td>
      <td class="text-center" style="min-width:230px;">
        <button class="btn btn-warning update-usuario" data-id="<?php echo $item->id; ?>"><i class="glyphicon glyphicon-repeat"></i> Mod</button>
        <button class="btn btn-danger confirmarDel-usuario" data-id="<?php echo $item->id; ?>" data-toggle="modal" data-target="#confirmarDel"><i class="glyphicon glyphicon-remove-sign"></i> Eli</button>
      </td>
    </tr>
    <?php
  }
?>