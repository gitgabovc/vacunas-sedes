<h1>HOJA DE VACUNACIÓN </h1>
<h3>Campaña: <?php echo $campana
                ?></h3>
<h3>Establecimiento: <?php echo $establecimiento
                        ?></h3>
<h3>Gestión: <?php echo $gestion ?></h3>
<table border=1 cellspacing=0 cellpadding=2 bordercolor="666633">
    <tr>
        <th>NRO</th>
        <th>NRO BRIGADA</th>

        <th>FECHA DE VACUNACIÓN</th>
        <th>NOMBRE DE LA MASCOTA</th>
        <th>EDAD MESES</th>
        <th>EDAD AÑOS</th>
        <th>TIPO</th>
        <th>SEXO</th>
        <th>COLOR</th>
        <th>NOMBRE DEL DUEÑO</th>
    </tr>
    <?php $num = 1;
    foreach ($lista as $row) { ?>
        <tr>

            <td><?php echo $num;
                $num++ ?></td>
            <td><?php echo $row->nrobrigada ?></td>


            <td><?php echo $row->fecha ?></td>
            <td style="text-transform:upperCase;"><?php echo $row->nombreMascota ?></td>
            <td><?php echo $row->edad_meses ?></td>
            <td><?php echo $row->edad_anios ?></td>
            <td style="text-transform:upperCase;"><?php echo $row->tipo ?></td>
            <td style="text-transform:upperCase;"><?php echo $row->sexo ?></td>
            <td style="text-transform:upperCase;"><?php echo $row->color ?></td>
            <td style="text-transform:upperCase;"><?php echo $row->nombrePropietario ?></td>
        </tr>
    <?php } ?>
</table>