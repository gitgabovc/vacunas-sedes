<h1>HOJA DE VACUNACIÓN RESUMEN</h1>
<h3>Campaña: <?php echo $campana
                ?></h3>
<h3>Establecimiento: <?php echo $establecimiento
                        ?></h3>
<h3>Gestión: <?php echo $gestion ?></h3>
<table border=1 cellspacing=0 cellpadding=2 bordercolor="666633">
    <tr>
        <th>NRO</th>
        <th>ESTABLECIMIENTO</th>
        <th>RESPONSABLE</th>
        <th>LUGAR</th>
        <th># BRIGADA</th>
        <th>DOSIS</th>
        <th>PERROS</th>
        <th>GATOS</th>
        <th>TOTAL</th>
        <th>%</th>
    </tr>
    <?php $num = 1;
    foreach ($lista as $row) { ?>
        <tr>

            <td><?php echo $num;
                $num++ ?></td>
            <td style="text-transform:upperCase;"><?php echo $row->establecimiento ?></td>
            <td><?php echo $row->responsable ?></td>

            <td><?php echo $row->lugar ?></td>
            <td style="text-transform:upperCase;"><?php echo $row->nrobrigada ?></td>
            <td><?php echo $row->dosis ?></td>
            <td style="text-transform:upperCase;"><?php echo $row->perros ?></td>
            <td style="text-transform:upperCase;"><?php echo $row->gatos ?></td>
            <td><?php echo $row->vacunas ?></td>
            <td style="text-transform:upperCase;"><?php echo 100 * ($row->vacunas) / ($row->dosis) ?>%</td>
        </tr>
    <?php } ?>
</table>