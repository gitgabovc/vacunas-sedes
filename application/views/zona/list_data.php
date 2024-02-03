<?php
  $no = 1;
  foreach ($dataZona as $zona) {
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $zona->descripcion; ?></td>
      <td class="text-center" style="min-width:230px;">
          <button class="btn btn-warning update-dataZona" data-id="<?php echo $zona->id; ?>"><i class="glyphicon glyphicon-repeat"></i> Mod</button>
          <button class="btn btn-danger konfirmasiHapus-zona" data-id="<?php echo $zona->id; ?>" data-toggle="modal" data-target="#konfirmasiHapus"><i class="glyphicon glyphicon-remove-sign"></i> Eli</button>
      </td>
    </tr>
    <?php
    $no++;
  }
?>