<?php
foreach ($datacampana as $item) {
?>
  <tr>
    <td style="min-width:230px;"><?php echo $item->gestion; ?></td>
    <td><?php echo $item->descripcion; ?></td>
    <td><?php $date = date_create($item->fechaini);
        echo date_format($date, "d/m/Y"); ?></td>
    <td><?php $date = date_create($item->fechafin);
        echo date_format($date, "d/m/Y"); ?></td>
    <td class="text-center" style="min-width:230px;">

      <a class="btn btn-primary usuarios" href="<?php echo site_url('Campana/establecimiento') . '/' . $item->id; ?>" data-placement="top" title="Asignar usuarios"><i class="glyphicon glyphicon-user"></i> Asig</a>
      <button class="btn btn-warning update-campana" data-id="<?php echo $item->id; ?>"><i class="glyphicon glyphicon-pencil"></i> Mod</button>
      <button class="btn btn-danger confirmarDel-campana" data-id="<?php echo $item->id; ?>" data-toggle="modal" data-target="#confirmarDel"><i class="glyphicon glyphicon-remove-sign"></i> Eli</button>
      <!-- <button class="btn btn-danger confirmarDel-campana" data-id="<?php echo $item->id; ?>" data-toggle="modal" data-target="#confirmarDel"><i class="glyphicon glyphicon-remove-sign"></i> Report</button> -->
    </td>
  </tr>
<?php
}
?>