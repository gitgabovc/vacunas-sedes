<?php
  $no = 1;
  foreach ($dataCiudad as $ciudad) {
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $ciudad->nombre; ?></td>

      <td class="text-center" style="min-width:230px;">
          <button class="btn btn-warning update-dataCiudad" data-id="<?php echo $ciudad->id; ?>"><i class="glyphicon glyphicon-repeat"></i> Mod</button>
          <button class="btn btn-danger confirmarDel-ciudad" data-id="<?php echo $ciudad->id; ?>" data-toggle="modal" data-target="#confirmarDel"><i class="glyphicon glyphicon-remove-sign"></i> Eli</button>
      </td>
    </tr>
    <?php
    $no++;
  }
?>