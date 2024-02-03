<div class="box ">
    <div class="box-header">
        <?php foreach ($datacampana as $row) { ?>
            <div class="card ">
                <h5 class="card-header"><span style='font-weight:bold;'>Campaña : </span><span style='text-transform:capitalize'><?php echo $row->descripcion ?></span></h5>
                <div class="card-body">
                    <h5 class="card-title"> <span style='font-weight:bold;'>Fecha de Inicio :</span> <?php echo $row->fechaini ?></h5>
                    <p class="card-text"><?php echo diferenciaDias($row->fechaini); ?> </p>
                    <a href="<?php echo site_url('reporte/index') . '/' . $row->gestion . '/' . $row->id; ?>" class="btn btn-primary">Ir a la campaña</a>
                </div>
            </div>
            <hr style='border: 2px solid khaki; height: 2px; background-color: #3c8dbc;'>
        <?php } ?>
    </div>
    <!-- /.box-header -->

</div>
<?php
function diferenciaDias($fecha)
{
    $fechaActual = new DateTime(date("Y-m-d"));
    $fechaActua = new DateTime($fecha);
    $diff = $fechaActual->diff($fechaActua);
    // return $diff->days;
    // return ($fechaActua == $fechaActual);
    // $torf = var_dump($fechaActual < $fechaActua);

    // return $diff->days . $torf;
    //campania q faltan -5 dias para comenzar
    if ($fechaActual > $fechaActua) {
        return "La campaña se realizó hace " . $diff->days . " día(s)";
    }
    //campania q ya pasaron 5 dias dias para comenzar
    if ($fechaActual < $fechaActua) {

        return "Falta " . $diff->days . " día(s) para que comience la campaña";
    }
    //campania q hoy comenzo
    if ($fechaActual == $fechaActua) {
        return 'La campaña comienza el día de hoy';
    }
}
?>