<?php
  $no = 1;
  foreach ($dataTipocampana as $item) {
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $item->descripcion; ?></td>
      <td class="text-center" style="min-width:230px;">
          <button class="btn btn-warning update-dataTipocampana" data-id="<?php echo $item->id; ?>"><i class="glyphicon glyphicon-repeat"></i> Mod</button>
          <button class="btn btn-danger confirmarDel-tipocampana" data-id="<?php echo $item->id; ?>" data-toggle="modal" data-target="#confirmarDel"><i class="glyphicon glyphicon-remove-sign"></i> Eli</button>
      </td>
    </tr>
    <?php
    $no++;
  }
?>