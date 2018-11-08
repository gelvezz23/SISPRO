 <!-- Content Wrapper. Contains page content -->
        <div style="min-height: 524px;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                <center> <div class="section-title text-center wow zoomIn">
                        <h2>PREGUNTAS</a></h2>
                 </div></center>
                <!--small>Editar</small-->
                </h1>
            </section>
            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="box box-solid">
                    <div class="box-body">
                        <!--ini-perfil-->
                   <?php
if ($tipo == "general") {
    //mostrar  vista general -> la misma del docente
    ?>
                        <h1>Listado de preguntas</h1>
                    <a href="<?php echo base_url(); ?>director/Preguntas/ver_preguntas_director">Ver preguntas del director</a>
                    <?php
if (!$todas_las_areas) {
        echo "No existen areas registradas";
    } else {
        ?>
                         <center>Tabla de Areas</center>
                         <p>ver por:</p>
                         <?php
foreach ($todas_las_areas as $area): ?>
                        <a href="<?php echo base_url(); ?>director/Preguntas/ver_preguntas_area/<?=$area->id?>"><?php echo $area->nombre . "  /  "; ?></a>
                         <?php
endforeach;
    }
} else if ($tipo == "gestion") {
    //mostrar aprobacion de nuevas preguntas
    ?>
                          <?php if ($preguntas_espera) {
        ?>
                          <h3>Ver nuevas preguntas registradas por docentes de plan de estudios</h3>
                          <table id="example" class="table table-striped table-bordered nowrap tabla-preguntas-espera" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>docente a cargo</th>
                <th>Area de conocimiento</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
foreach ($preguntas_espera as $pregunta): ?>
            <tr>
                <td><?php echo $pregunta->id; ?></td>
                <td><?php echo $pregunta->docente; ?></td>
                <td><?php echo $pregunta->area; ?></td>

                <td>
                    <a href="<?php echo base_url(); ?>director/Preguntas/verDetalle/<?=$pregunta->id?>">Ver detalle</a>
                    <a href="<?php echo base_url(); ?>director/Preguntas/aprobar_pregunta/<?=$pregunta->id?>">Aprobar</a>
                                    </td>
                                        </tr>
                                        <?php endforeach;
        ?>
                                    </tbody>
                                </table>
                        <?php
} else {?>
                            <p>No hay preguntas en espera de ser aprobadas.</p>
                          <?php
}
} else if ($tipo == "ver preguntas docente") {
    if ($preguntas) {
        ?>
                          <h3>Preguntas del usuario</h3>
                          <a href="#">Listar todas las preguntas en detalle</a>
                          <table id="example" class="table table-striped table-bordered nowrap tabla-preguntas-espera" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Area</th>
                <th>Estado</th>
                <th>Visibilidad</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
foreach ($preguntas as $pregunta): ?>
            <tr>
                <td><?php echo $pregunta->id; ?></td>
                <td><?php echo $pregunta->area; ?></td>
                <td><?php echo $pregunta->estado; ?></td>
                <td><?php echo $pregunta->visibilidad; ?></td>
                <td>
                    <a href="<?php echo base_url(); ?>director/Preguntas/verDetalle/<?=$pregunta->id?>">Ver detalle</a>
                    <a href="<?php echo base_url(); ?>director/Preguntas/editar/<?=$pregunta->id?>">Editar pregunta</a>
                    <a href="#">Eliminar</a>
                                    </td>
                                        </tr>
                                        <?php endforeach;
        ?>
                                    </tbody>
                                </table>
                        <?php
} else {?>
                            <p>No tienes Preguntas registradas</p>
                          <?php
                      }
}else if($tipo == "ver preguntas area"){

 if ($preguntas) {
        ?>
                          <h3>Preguntas del Area "<?=$nombre_area?>"</h3>
                          <a href="#">Listar todas las preguntas en detalle</a>
                          <table id="example" class="table table-striped table-bordered nowrap tabla-preguntas-espera" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Estado</th>
                <th>Visibilidad</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
foreach ($preguntas as $pregunta): ?>
            <tr>
                <td><?php echo $pregunta->id; ?></td>
                <td><?php echo $pregunta->estado; ?></td>
                <td><?php echo $pregunta->visibilidad; ?></td>
                <td>
                    <a href="<?php echo base_url(); ?>director/Preguntas/verDetalle/<?=$pregunta->id?>">Ver detalle</a>
                                    </td>
                                        </tr>
                                        <?php endforeach;
        ?>
                                    </tbody>
                                </table>
                        <?php
} else {?>
                            <p>No tienes Preguntas registradas</p>
                          <?php
}

} else if ($tipo == "ver detalle pregunta") {
    //vista detalle de la pregunta
    ?>
<h3>Informacion acerca de la pregunta</h3>
<p>Id pregunta: <?=$info_pregunta->id?></p>
<?php
if ($enunciado != "no existe enunciado") {
        ?>
<p><?= $enunciado;?></p>
<?php
}
    ?>
<p><?=$info_pregunta->descripcion?></p>
<?php
$i = 97;
    foreach ($opciones_respuesta as $o) {
        ?>
        <p><?=chr($i++) . ". " . $o->descripcion;?></p>
        <?php

    }

    ?>


    <h3>Informacion de las opcion(es) de respuesta</h3>
    <?php
if ($info_pregunta->tipo == "seleccion multiple") {
        ?>
         <table style="width:100%">
        <thead>
            <tr>
                <th>Valor</th>
                <th>Respuesta</th>
                <th>Justificacion</th>
            </tr>
        </thead>
        <tbody>
            <?php
$i = 97;
        foreach ($opciones_respuesta as $o) {
            ?>
            <tr>
                <td><?php echo chr($i++); ?></td>
                <td><?php
if ($o->correcta == "si") {
                echo "Correcta";
            } else {
                echo "Incorrecta";
            }

            ?></td>
                <td><?php echo $o->justificacion; ?></td>
                                        </tr>
                                        <?php }
        ?>
                                    </tbody>
                                </table>
<?php
} else {
        //verdadero-falso, pregunta-abierta
        foreach ($opciones_respuesta as $o) {
            if ($o->correcta == "si") {
                ?>
        <p>Respuesta correcta: <?=$o->descripcion;?></p>
        <p>Justificacion: <?=$o->justificacion;?></p>
        <?php
break;
            }
        }
    }

}

?>
                    <!--fin-perfil-->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->