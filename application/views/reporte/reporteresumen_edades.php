<h1>HOJA DE VACUNACIÓN RESUMEN POR EDADES</h1>
<h3>Campaña: <?php echo $campana
                ?></h3>
<h3>Establecimiento: <?php echo $establecimiento
                        ?></h3>
<h3>Gestión: <?php echo $gestion ?></h3>
<h4>Perros</h4>
<table style="text-align:center" border=1 cellspacing=0 cellpadding=2 bordercolor="666633">

    <tr>

        <td rowspan="2">NRO</td>
        <td rowspan="2">NRO BRIGADA</td>
        <td colspan="3">&lt;3 MESES</td>
        <td colspan="3">&gt;=3 MESES Y &lt;1 AÑO</td>
        <td colspan="3">&gt;=1 AÑO</td>
        <td colspan="3">TOTAL</td>
    </tr>
    <tr>

        <td>H</td>
        <td>M</td>
        <td>Total</td>
        <td>H</td>
        <td>M</td>
        <td>Total</td>
        <td>H</td>
        <td>M</td>
        <td>Total</td>
        <td>H</td>
        <td>M</td>
        <td>Total</td>

    </tr>
    <?php $num = 1;
    foreach ($listaPerros as $row) { ?>
        <tr>
            <td><?php echo $num;
                $num++ ?></td>
            <td><?php echo $row->nrobrigada ?></td>
            <td><?php echo $row->menortresmesesH ?> </td>
            <td><?php echo $row->menortresmesesM ?> </td>
            <td><?php echo ($row->menortresmesesM) + ($row->menortresmesesH) ?> </td>
            <td><?php echo $row->mayorigualtresmesesymenorunanioH ?></td>
            <td><?php echo $row->mayorigualtresmesesymenorunanioM ?></td>
            <td><?php echo ($row->mayorigualtresmesesymenorunanioM) + ($row->mayorigualtresmesesymenorunanioH) ?></td>
            <td><?php echo $row->mayorigualunanioH ?></td>
            <td><?php echo $row->mayorigualunanioM ?></td>
            <td><?php echo ($row->mayorigualunanioM) + ($row->mayorigualunanioH) ?></td>
            <td><?php echo $row->mayorigualunanioH ?></td>
            <td><?php echo $row->mayorigualunanioM ?></td>
            <td><?php echo ($row->mayorigualunanioM) + ($row->mayorigualunanioH) ?></td>
        </tr>
    <?php } ?>

</table>
<br>
<h4>Gatos</h4>
<table style="text-align:center" border=1 cellspacing=0 cellpadding=2 bordercolor="666633">

    <tr>

        <td rowspan="2">NRO</td>
        <td rowspan="2">NRO BRIGADA</td>
        <td colspan="3">&lt;3 MESES</td>
        <td colspan="3">&gt;=3 MESES Y &lt;1 AÑO</td>
        <td colspan="3">&gt;=1 AÑO</td>
        <td colspan="3">TOTAL</td>
    </tr>
    <tr>

        <td>H</td>
        <td>M</td>
        <td>Total</td>
        <td>H</td>
        <td>M</td>
        <td>Total</td>
        <td>H</td>
        <td>M</td>
        <td>Total</td>
        <td>H</td>
        <td>M</td>
        <td>Total</td>

    </tr>
    <?php $num = 1;
    foreach ($listaGatos as $row) { ?>
        <tr>
            <td><?php echo $num;
                $num++ ?></td>
            <td><?php echo $row->nrobrigada ?></td>
            <td><?php echo $row->menortresmesesH ?> </td>
            <td><?php echo $row->menortresmesesM ?> </td>
            <td><?php echo ($row->menortresmesesM) + ($row->menortresmesesH) ?> </td>
            <td><?php echo $row->mayorigualtresmesesymenorunanioH ?></td>
            <td><?php echo $row->mayorigualtresmesesymenorunanioM ?></td>
            <td><?php echo ($row->mayorigualtresmesesymenorunanioM) + ($row->mayorigualtresmesesymenorunanioH) ?></td>
            <td><?php echo $row->mayorigualunanioH ?></td>
            <td><?php echo $row->mayorigualunanioM ?></td>
            <td><?php echo ($row->mayorigualunanioM) + ($row->mayorigualunanioH) ?></td>
            <td><?php echo ($row->menortresmesesH)+($row->mayorigualunanioH)+($row->mayorigualtresmesesymenorunanioH)?></td>
            <td><?php echo ($row->menortresmesesM)+($row->mayorigualunanioM)+($row->mayorigualtresmesesymenorunanioM) ?></td>
            <td><?php echo ($row->menortresmesesH)+($row->mayorigualunanioH)+($row->mayorigualtresmesesymenorunanioH)+($row->menortresmesesM)+($row->mayorigualunanioM)+($row->mayorigualtresmesesymenorunanioM)?></td>
        </tr>
    <?php } ?>

</table>