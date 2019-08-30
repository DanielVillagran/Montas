<?php
require '../application/core/app/model/Conection.php';

if (Core::$user->kind == 3) {
    Core::redir("./?view=sell");
}
$usuario = UserData::getById($_SESSION["user_id"])->name;
$alertas = R::getAll('SELECT * FROM alerts where status = 1');


?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Montacargas Azteca</h1>
    <!--          <h4>Almacen principal: --><?php //echo StockData::getPrincipal()->name;  ?><!--</h4>-->
    <h4>Alertas</h4>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-12">


            <div class="clearfix"></div>
            <br>
            <?php
            if (!empty($alertas)):
                foreach ($alertas as $alerta):

                    $pdatos = R::find('product', ' id =  "' . $alerta['product_id'] . '"');
//var_dump($pdatos);
                    foreach ($pdatos as $p) {


                        ?>
                        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
                             aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle" style="text-align: center;"><h4><b>BITÁCORA DE
                                                    REVISIÓN DE MONTACARGAS DE RENTA</b></h4></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="form" enctype="multipart/form-data">
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-sm-2 col-form-label">Marca</label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="name" class="form-control" placeholder="Marca" id="marca" value="">
                                                </div>
                                                <label for="" class="col-sm-2 col-form-label">Modelo</label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="model" class="form-control" id="modelo" placeholder="Modelo">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-sm-2 col-form-label">Serie</label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="serie" class="form-control" id="serie" placeholder="Serie" value="">
                                                </div>
                                                <label for="inputPassword" class="col-sm-2 col-form-label">Horómetro</label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="horometer" class="form-control" id="horo" placeholder="Horómetro">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="staticEmail" class="col-sm-2 col-form-label">Técnico</label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="tecnico"  class="form-control" id="tec" readonly placeholder="Técnico" value="<?php echo $usuario?>">
                                                </div>
                                                <label for="inputPassword" class="col-sm-2 col-form-label">Cliente</label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="cliente" class="form-control" id="cliente" readonly placeholder="Cliente">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="staticEmail" style="margin-top: 1%;" class="col-sm-3 col-form-label">Aceite
                                                    Motor</label>
                                                <div class="col-sm-1" style="margin-top: 1%;">
                                                    <input type="checkbox" id="a1" value="">
                                                </div>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="ob1" placeholder="Observaciones">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="staticEmail" style="margin-top: 1%;" class="col-sm-3 col-form-label">Aceite
                                                    Transmisión</label>
                                                <div class="col-sm-1" style="margin-top: 1%;">
                                                    <input type="checkbox" id="a2" value="">
                                                </div>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="ob2" placeholder="Observaciones">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="staticEmail" style="margin-top: 1%;" class="col-sm-3 col-form-label">Aceite
                                                    Hidráulico</label>
                                                <div class="col-sm-1" style="margin-top: 1%;">
                                                    <input type="checkbox" id="a3" value="">
                                                </div>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="ob3" placeholder="Observaciones">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="staticEmail" style="margin-top: 1%;" class="col-sm-3 col-form-label">Anticongelante
                                                    Radiador</label>
                                                <div class="col-sm-1" style="margin-top: 1%;">
                                                    <input type="checkbox" id="a4" value="">
                                                </div>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="ob4" placeholder="Observaciones">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="staticEmail" style="margin-top: 1%;" class="col-sm-3 col-form-label">Anticongelante
                                                    Recuperador</label>
                                                <div class="col-sm-1" style="margin-top: 1%;">
                                                    <input type="checkbox" id="a5" value="">
                                                </div>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="ob5" placeholder="Observaciones">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="staticEmail" style="margin-top: 1%;" class="col-sm-6 col-form-label">Imágen Horómetro</label>
                                                <label for="staticEmail" style="margin-top: 1%;" class="col-sm-6 col-form-label">Imágen Equipo</label>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <input type="file" id="horom" class="">
                                                </div>
                                                <div class="col-sm-6">
                                                    <input type="file" id="equ" class="">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <img src="#" id="img1" style="width: 100%; height: 200px;" alt="">
                                                </div>
                                                <div class="col-sm-6">
                                                    <img src="#" id="img2" style="width: 100%; height: 200px;" alt="">
                                                </div>
                                            </div>
                                            <input type="hidden" id="pid_<?php echo $p->id; ?>"
                                                   value="<?php echo $p->id; ?>">
                                            <p></p>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="button" id="" onclick="createReturn(<?php echo $p->id; ?>)" class="btn btn-primary" >Guardar</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php if ($alerta['type'] == 1): ?>
                            <div class="box" style="border-top-color: darkviolet !important;">
                                <div class="box-header">
                                    <div class="row">
                                        <div class="col-md-11">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 style="width: 100%;" class="box-title">
                                                        <b>Serie:</b> <?php echo $p->serie ?></h3>
                                                    <h3 style="width: 100%;" class="box-title">
                                                        <b>Modelo:</b> <?php echo $p->model ?></h3>

                                                </div>
                                                <div class="col-md-4">
                                                    <h3 style="width: 100%;" class="box-title"><b>Fecha: </b><?php
                                                        setlocale(LC_TIME, 'es_MX.UTF-8');
                                                        date_default_timezone_set('America/Mexico_City');
                                                        echo strftime("%d de %B de %Y a las %H:%M", strtotime($alerta['created'])); ?>
                                                    </h3>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <span style="background-color: darkviolet !important;" class="badge"
                                                  onclick="closeAlert(<?php echo $alerta['id'] ?>)">Cerrar</span>
                                        </div>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body">

                                    El producto con número de serie <b><?php echo $p->serie ?></b> con modelo
                                    <b><?php echo $p->model ?></b> se agrego recientemente.


                                </div><!-- /.box-body -->

                            </div><!-- /.box -->
                        <?php elseif ($alerta['type'] == 2): ?>
                            <div class="box" style="border-top-color: blue !important;">
                                <div class="box-header">
                                    <div class="row">
                                        <div class="col-md-11">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 style="width: 100%;" class="box-title">
                                                        <b>Serie:</b> <?php echo $p->serie ?></h3>
                                                    <h3 style="width: 100%;" class="box-title">
                                                        <b>Modelo:</b> <?php echo $p->model ?></h3>

                                                </div>
                                                <div class="col-md-4">
                                                    <h3 style="width: 100%;" class="box-title"><b>Fecha: </b><?php
                                                        setlocale(LC_TIME, 'es_MX.UTF-8');
                                                        date_default_timezone_set('America/Mexico_City');
                                                        echo strftime("%d de %B de %Y a las %H:%M", strtotime($alerta['created'])); ?>
                                                    </h3>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <span style="background-color: blue !important;" class="badge"
                                                  onclick="closeAlert(<?php echo $alerta['id'] ?>)">Cerrar</span>
                                        </div>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body">

                                    Al producto con número de serie <b><?php echo $p->serie ?></b> y con modelo
                                    <b><?php echo $p->model ?></b> se le agregaron reparaciones.


                                </div><!-- /.box-body -->

                            </div><!-- /.box -->
                        <?php elseif ($alerta['type'] == 3): ?>
                            <div class="box" style="border-top-color: brown !important;">
                                <div class="box-header">
                                    <div class="row">
                                        <div class="col-md-11">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 style="width: 100%;" class="box-title">
                                                        <b>Serie:</b> <?php echo $p->serie ?></h3>
                                                    <h3 style="width: 100%;" class="box-title">
                                                        <b>Modelo:</b> <?php echo $p->model ?></h3>

                                                </div>
                                                <div class="col-md-4">
                                                    <h3 style="width: 100%;" class="box-title"><b>Fecha: </b><?php
                                                        setlocale(LC_TIME, 'es_MX.UTF-8');
                                                        date_default_timezone_set('America/Mexico_City');
                                                        echo strftime("%d de %B de %Y a las %H:%M", strtotime($alerta['created'])); ?>
                                                    </h3>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <span style="background-color: brown !important;" class="badge"
                                                  onclick="closeAlert(<?php echo $alerta['id'] ?>)">Cerrar</span>
                                        </div>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body">

                                    El producto con número de serie <b><?php echo $p->serie ?></b> y con modelo
                                    <b><?php echo $p->model ?></b> se ha marcado como terminado.


                                </div><!-- /.box-body -->

                            </div><!-- /.box -->
                        <?php elseif ($alerta['type'] == 4): ?>
                            <div class="box" style="border-top-color: green !important;">
                                <div class="box-header">
                                    <div class="row">
                                        <div class="col-md-11">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 style="width: 100%;" class="box-title">
                                                        <b>Serie:</b> <?php echo $p->serie ?></h3>
                                                    <h3 style="width: 100%;" class="box-title">
                                                        <b>Modelo:</b> <?php echo $p->model ?></h3>

                                                </div>
                                                <div class="col-md-4">
                                                    <h3 style="width: 100%;" class="box-title"><b>Fecha: </b><?php
                                                        setlocale(LC_TIME, 'es_MX.UTF-8');
                                                        date_default_timezone_set('America/Mexico_City');
                                                        echo strftime("%d de %B de %Y a las %H:%M", strtotime($alerta['created'])); ?>
                                                    </h3>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <span style="background-color: green !important;" class="badge"
                                                  onclick="closeAlert(<?php echo $alerta['id'] ?>)">Cerrar</span>
                                        </div>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body">

                                    El producto con número de serie <b><?php echo $p->serie ?></b> y con modelo
                                    <b><?php echo $p->model ?></b> se ha marcado como listo para la venta.


                                </div><!-- /.box-body -->

                            </div><!-- /.box -->
                        <?php elseif ($alerta['type'] == 6): ?>
                            <div class="box" style="border-top-color: red !important;">
                                <div class="box-header">
                                    <div class="row">
                                        <div class="col-md-11">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h3 style="width: 100%;" class="box-title">
                                                        <b>Serie:</b> <?php echo $p->serie ?></h3>
                                                    <h3 style="width: 100%;" class="box-title">
                                                        <b>Modelo:</b> <?php echo $p->model ?></h3>

                                                </div>
                                                <div class="col-md-4">
                                                    <h3 style="width: 100%;" class="box-title"><b>Fecha: </b><?php
                                                        setlocale(LC_TIME, 'es_MX.UTF-8');
                                                        date_default_timezone_set('America/Mexico_City');
                                                        echo strftime("%d de %B de %Y a las %H:%M", strtotime($alerta['created'])); ?>
                                                    </h3>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <span style="background-color: red !important;" class="badge"
                                                  onclick="closeAlert2(<?php echo $alerta['id'] ?>,<?php echo $p->id ?>)">Cerrar</span>
                                        </div>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body">

                                    El producto ha cumplido 1 semana con el cliente, favor de dar seguimiento.


                                </div><!-- /.box-body -->

                            </div><!-- /.box -->
                        <?php elseif ($alerta['type'] == 5):

                            $renta = R::getAll('SELECT * from rent where status = 1 and product_id = ' . $alerta['product_id']);
                            for ($i = 0; $i < count($renta); $i++) {


                                ?>
                                <div class="box" style="border-top-color: yellow !important;">
                                    <div class="box-header">
                                        <div class="row">
                                            <div class="col-md-11">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <h3 style="width: 100%;" class="box-title">
                                                            <b>Serie:</b> <?php echo $p->serie ?></h3>
                                                        <h3 style="width: 100%;" class="box-title">
                                                            <b>Modelo:</b> <?php echo $p->model ?></h3>

                                                    </div>
                                                    <div class="col-md-4">
                                                        <h3 style="width: 100%;" class="box-title"><b>Fecha: </b><?php
                                                            setlocale(LC_TIME, 'es_MX.UTF-8');
                                                            date_default_timezone_set('America/Mexico_City');
                                                            echo strftime("%d de %B de %Y a las %H:%M", strtotime($alerta['created'])); ?>
                                                        </h3>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <span style="background-color: yellow !important; color: black !important;"
                                                      class="badge" onclick="closeAlert(<?php echo $alerta['id'] ?>)">Cerrar</span>
                                            </div>
                                        </div>
                                    </div><!-- /.box-header -->


                                    <div class="box-body">
                                        <?php if ($renta[$i]['type'] == 2): ?>
                                            El producto con número de serie <b><?php echo $p->serie ?></b> y con modelo
                                            <b><?php echo $p->model ?></b> se ha rentado a
                                            <b><?php echo strtoupper($renta[$i]['cliente_name']) ?></b> el día
                                            <b><?php echo date("d/m/Y", strtotime($renta[$i]['date_start'])) ?></b> hasta el día
                                            <b><?php echo date("d/m/Y", strtotime($renta[$i]['date_end'])) ?></b>
                                        <?php else: ?>
                                            El producto con número de serie <b><?php echo $p->serie ?></b> y con modelo
                                            <b><?php echo $p->model ?></b> se ha rentado a
                                            <b><?php echo strtoupper($renta[$i]['cliente_name']) ?></b> el día
                                            <b><?php echo date("d/m/Y", strtotime($renta[$i]['date_start'])) ?></b> de forma
                                            <b>indefinida</b>.
                                        <?php endif; ?>

                                    </div><!-- /.box-body -->

                                </div><!-- /.box -->
                            <?php } ?>
                        <?php endif; ?>
                    <?php } ?>

                <?php endforeach; ?>
            <?php else: ?>
                <div class="jumbotron">
                    <h2>No hay alertas</h2>
                    <p>Por el momento no hay alertas, estas se muestran cuando existe algun movimiento de los
                        productos.</p>
                </div>
            <?php endif; ?>

            <div class="clearfix"></div>


        </div>
    </div>


</section><!-- /.content -->
<script src="../application/core/app/assets/refactions.js"></script>
<script src="../application/core/app/assets/alertify.js"></script>
