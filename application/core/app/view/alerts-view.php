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
                  <h3 style="width: 100%;" class="box-title"><b>Fecha:</b> <?php echo date("F j, Y, g:i a", strtotime($alerta['created']));?></h3>

              </div>
          </div>
      </div>
      <div class="col-md-1">
        <span style="background-color: darkviolet !important;" class="badge">Cerrar</span>
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
                                <h3 style="width: 100%;" class="box-title"><b>Fecha: </b><?php echo date("F j, Y, g:i a", strtotime($alerta['created']));?></h3>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <span style="background-color: blue !important;" class="badge">Cerrar</span>
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
                                <h3 style="width: 100%;" class="box-title"><b>Fecha: </b><?php echo date("F j, Y, g:i a", strtotime($alerta['created']));?></h3>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <span style="background-color: brown !important;" class="badge">Cerrar</span>
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
                                <h3 style="width: 100%;" class="box-title"><b>Fecha: </b><?php echo date("F j, Y, g:i a", strtotime($alerta['created']));?></h3>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <span style="background-color: green !important;" class="badge">Cerrar</span>
                    </div>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">

                El producto con número de serie <b><?php echo $p->serie?></b> y con modelo <b><?php echo $p->model?></b> se ha marcado como listo para la venta.


            </div><!-- /.box-body -->

        </div><!-- /.box -->
    <?php endif;?>
<?php } ?>
<?php endforeach;?>

<div class="clearfix"></div>


  </div>
</div>
        </section><!-- /.content -->
