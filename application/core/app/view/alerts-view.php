<?php
require '../application/core/app/model/Conection.php';

if(Core::$user->kind==3){ Core::redir("./?view=sell"); }

$alertas = R::getAll( 'SELECT * FROM alerts where status = 1' );


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
if(!empty($alertas)):
foreach ($alertas as $alerta):

$pdatos = R::find('product', ' id =  "' . $alerta['product_id'] . '"');
//var_dump($pdatos);
foreach ($pdatos as $p){



?>
    <?php if($alerta['type'] == 1):?>
<div class="box" style="border-top-color: darkviolet !important;">
  <div class="box-header">
    <div class="row">
      <div class="col-md-11">
          <div class="row">
              <div class="col-md-8">
                  <h3 style="width: 100%;" class="box-title"><b>Serie:</b> <?php echo $p->serie?></h3>
                  <h3 style="width: 100%;" class="box-title"><b>Modelo:</b> <?php echo $p->model?></h3>

              </div>
              <div class="col-md-4">
                  <h3 style="width: 100%;" class="box-title"><b>Fecha: </b><?php
                      setlocale(LC_TIME, 'es_MX.UTF-8');
                      date_default_timezone_set ('America/Mexico_City');
                      echo strftime("%d de %B de %Y a las %H:%M", strtotime($alerta['created']));?></h3>

              </div>
          </div>
      </div>
      <div class="col-md-1">
        <span style="background-color: darkviolet !important;" class="badge" onclick="closeAlert(<?php echo $alerta['id']?>)">Cerrar</span>
      </div>
    </div>
  </div><!-- /.box-header -->
  <div class="box-body">

        El producto con número de serie <b><?php echo $p->serie?></b> con modelo <b><?php echo $p->model?></b> se agrego recientemente.


  </div><!-- /.box-body -->

</div><!-- /.box -->
    <?php elseif($alerta['type'] == 2):?>
        <div class="box" style="border-top-color: blue !important;">
            <div class="box-header">
                <div class="row">
                    <div class="col-md-11">
                        <div class="row">
                            <div class="col-md-8">
                                <h3 style="width: 100%;" class="box-title"><b>Serie:</b> <?php echo $p->serie?></h3>
                                <h3 style="width: 100%;" class="box-title"><b>Modelo:</b> <?php echo $p->model?></h3>

                            </div>
                            <div class="col-md-4">
                                <h3 style="width: 100%;" class="box-title"><b>Fecha: </b><?php
                      setlocale(LC_TIME, 'es_MX.UTF-8');
                      date_default_timezone_set ('America/Mexico_City');
                      echo strftime("%d de %B de %Y a las %H:%M", strtotime($alerta['created']));?></h3>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <span style="background-color: blue !important;" class="badge" onclick="closeAlert(<?php echo $alerta['id']?>)">Cerrar</span>
                    </div>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">

                Al producto con número de serie <b><?php echo $p->serie?></b> y con modelo <b><?php echo $p->model?></b> se le agregaron reparaciones.


            </div><!-- /.box-body -->

        </div><!-- /.box -->
    <?php elseif($alerta['type'] == 3):?>
        <div class="box" style="border-top-color: brown !important;">
            <div class="box-header">
                <div class="row">
                    <div class="col-md-11">
                        <div class="row">
                            <div class="col-md-8">
                                <h3 style="width: 100%;" class="box-title"><b>Serie:</b> <?php echo $p->serie?></h3>
                                <h3 style="width: 100%;" class="box-title"><b>Modelo:</b> <?php echo $p->model?></h3>

                            </div>
                            <div class="col-md-4">
                               <h3 style="width: 100%;" class="box-title"><b>Fecha: </b><?php
                      setlocale(LC_TIME, 'es_MX.UTF-8');
                      date_default_timezone_set ('America/Mexico_City');
                      echo strftime("%d de %B de %Y a las %H:%M", strtotime($alerta['created']));?></h3>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <span style="background-color: brown !important;" class="badge" onclick="closeAlert(<?php echo $alerta['id']?>)">Cerrar</span>
                    </div>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">

                El producto con número de serie <b><?php echo $p->serie?></b> y con modelo <b><?php echo $p->model?></b> se ha marcado como terminado.


            </div><!-- /.box-body -->

        </div><!-- /.box -->
    <?php elseif($alerta['type'] == 4):?>
        <div class="box" style="border-top-color: green !important;">
            <div class="box-header">
                <div class="row">
                    <div class="col-md-11">
                        <div class="row">
                            <div class="col-md-8">
                                <h3 style="width: 100%;" class="box-title"><b>Serie:</b> <?php echo $p->serie?></h3>
                                <h3 style="width: 100%;" class="box-title"><b>Modelo:</b> <?php echo $p->model?></h3>

                            </div>
                            <div class="col-md-4">
                                <h3 style="width: 100%;" class="box-title"><b>Fecha: </b><?php
                      setlocale(LC_TIME, 'es_MX.UTF-8');
                      date_default_timezone_set ('America/Mexico_City');
                      echo strftime("%d de %B de %Y a las %H:%M", strtotime($alerta['created']));?></h3>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <span style="background-color: green !important;" class="badge" onclick="closeAlert(<?php echo $alerta['id']?>)">Cerrar</span>
                    </div>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">

                El producto con número de serie <b><?php echo $p->serie?></b> y con modelo <b><?php echo $p->model?></b> se ha marcado como listo para la venta.


            </div><!-- /.box-body -->

        </div><!-- /.box -->
    <?php elseif($alerta['type'] == 5):

        $renta = R::getAll('SELECT * from rent where status = 1 and product_id = '.$alerta['product_id']);
    for($i =0; $i < count($renta); $i++){


        ?>
        <div class="box" style="border-top-color: yellow !important;">
            <div class="box-header">
                <div class="row">
                    <div class="col-md-11">
                        <div class="row">
                            <div class="col-md-8">
                                <h3 style="width: 100%;" class="box-title"><b>Serie:</b> <?php echo $p->serie?></h3>
                                <h3 style="width: 100%;" class="box-title"><b>Modelo:</b> <?php echo $p->model?></h3>

                            </div>
                            <div class="col-md-4">
                                <h3 style="width: 100%;" class="box-title"><b>Fecha: </b><?php
                                    setlocale(LC_TIME, 'es_MX.UTF-8');
                                    date_default_timezone_set ('America/Mexico_City');
                                    echo strftime("%d de %B de %Y a las %H:%M", strtotime($alerta['created']));?></h3>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <span style="background-color: yellow !important; color: black !important;" class="badge" onclick="closeAlert(<?php echo $alerta['id']?>)">Cerrar</span>
                    </div>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
<?php if($renta[$i]['type'] == 2):?>
                El producto con número de serie <b><?php echo $p->serie?></b> y con modelo <b><?php echo $p->model?></b> se ha rentado a <b><?php echo strtoupper($renta[$i]['cliente_name'])?></b> el día <b><?php echo date("d/m/Y", strtotime($renta[$i]['date_start']))?></b> hasta el día <b><?php echo date("d/m/Y", strtotime($renta[$i]['date_end']))?></b>
<?php else:?>
        El producto con número de serie <b><?php echo $p->serie?></b> y con modelo <b><?php echo $p->model?></b> se ha rentado a <b><?php echo strtoupper($renta[$i]['cliente_name'])?></b> el día <b><?php echo date("d/m/Y", strtotime($renta[$i]['date_start']))?></b> de forma <b>indefinida</b>.
<?php endif;?>

        </div><!-- /.box-body -->

        </div><!-- /.box -->
    <?php } ?>
    <?php endif;?>
<?php } ?>

<?php endforeach;?>
<?php else:?>
    <div class="jumbotron">
        <h2>No hay alertas</h2>
        <p>Por el momento no hay alertas, estas se muestran cuando existe algun movimiento de los productos.</p>
    </div>
<?php endif;?>

<div class="clearfix"></div>


  </div>
</div>
        </section><!-- /.content -->
<script src="../application/core/app/assets/refactions.js"></script>
<script src="../application/core/app/assets/alertify.js"></script>
