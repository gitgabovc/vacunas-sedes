<?php
foreach ($dataestablec as $item) {
?>
  <tr>
  <td style="min-width:230px;"><?php echo $item->codigo; ?></td>
  <td style="min-width:230px;"><?php echo $item->nombre; ?></td>


    <td class="text-center" style="min-width:230px;">
      <button class="btn btn-warning update-campana-est" data-id="<?php echo $item->id; ?>"><i class="glyphicon glyphicon-pencil"></i> Mod</button>
      <button class="btn btn-danger confirmarDel-campana-est" data-id="<?php echo $item->id; ?>" data-toggle="modal" data-target="#confirmarDel"><i class="glyphicon glyphicon-remove-sign"></i> Eli</button>
    </td>
  </tr>
<?php
}
?>