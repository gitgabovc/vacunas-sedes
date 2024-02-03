<?php
  foreach ($dataagente as $item) {
    ?>
    <tr>
      <td style="min-width:230px;"><?php echo $item->nombres.' '.$item->apellidos; ?></td>
      <td><?php echo $item->telefono; ?></td>
      <td><?php echo $item->direccion; ?></td>
      <td><?php echo $item->codigo; ?></td>
      <td class="text-center" style="min-width:230px;">
        <button class="btn btn-warning update-agente" data-id="<?php echo $item->id; ?>"><i class="glyphicon glyphicon-repeat"></i> Mod</button>
        <button class="btn btn-danger confirmarDel-agente" data-id="<?php echo $item->id; ?>" data-toggle="modal" data-target="#confirmarDel"><i class="glyphicon glyphicon-remove-sign"></i> Eli</button>
      </td>
    </tr>
    <?php
  }
?>