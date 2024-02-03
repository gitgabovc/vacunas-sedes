<?php
$no = 1;
foreach ($dataEstablecimiento as $establecimiento) {
?>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $establecimiento->nombre; ?></td>
    <td><?php echo $establecimiento->codigo; ?></td>
    <td><?php echo $establecimiento->nombreMunicipio; ?></td>
    <td><?php echo $establecimiento->nombreResponsable; ?></td>
    <td class="text-center" style="min-width:230px;">
      <button class="btn btn-warning update-establecimiento" data-id="<?php echo $establecimiento->id; ?>"><i class="glyphicon glyphicon-repeat"></i> Mod</button>
      <button class="btn btn-danger confirmarDel-est" data-id="<?php echo $establecimiento->id; ?>" data-toggle="modal" data-target="#confirmarDel"><i class="glyphicon glyphicon-remove-sign"></i> Eli</button>
    </td>
  </tr>
<?php
  $no++;
}
?>