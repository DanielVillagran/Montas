<!-- Content Header (Page header) -->
<?php
if (isset($_GET["is_workshop"])) {
	$workshop = true;
} else {
	$workshop = false;
}
if (isset($_GET["is_ended"])) {
	$ended = true;
} else {
	$ended = false;
}
?>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.4/build/alertify.min.js"></script>
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.4/build/css/alertify.min.css" />
<section class="content-header">
    <h1>
        Productos
    </h1>
    <ol class="breadcrumb">
        <li><a href="./"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Productos</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-12">
            <div class="btn-group  pull-right">
                <?php if ($workshop || $ended): ?>
                    <?php else: ?>
                        <a href="index.php?view=newproduct" class="btn btn-default">Agregar Producto</a>

                    <?php endif;?>
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-download"></i> Descargar <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="http://vmcomp.com.mx/montacargas/webservicesapp/create_pdf.php" download class="">PDF (.pdf)</a>

                            </ul>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <br>

                    <?php
$showStatus = false;
if ($workshop) {
	$products = ProductData::getWorkshop();
	$showStatus = false;
	$showPrice = false;

} else if ($ended) {
	if (Core::$user->kind == 3) {
		$products = ProductData::getOnlyFinished();
	} else {
		$products = ProductData::getFinished();
	}
	$showStatus = false;
	$showPrice = true;

} else {
	$products = ProductData::getAll();
	$showStatus = true;
	$showPrice = true;

}
if (count($products) > 0) {
	?>
                   <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Productos</h3>

                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="box-body">
                            <table class="table table-bordered datatable table-hover">
                                <thead>
                                    <th>ID</th>
                                    <th>Imagen</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Serie</th>
                                    <th>Capacidad</th>
                                    <th style="display: none;">Precio Salida</th>
                                    <th>Categoria</th>
                                    <th>Tipo</th>
                                    <?php if ($showStatus): ?>
                                        <th>Estatus</th>
                                    <?php endif;?>
                                    <?php if ($showPrice): ?>
                                      <th>Precio</th>
                                  <?php endif;?>

                                  <th>Activo</th>
                                  <th></th>
                              </thead>
                              <?php foreach ($products as $product): ?>
                                <tr>
                                    <td><?php echo $product->id; ?></td>

                                    <td>

                                        <?php
$serie = $product->serie;
	$imagenes = ProductData::getBySerieOnly($serie);
	?>
                                        <?php echo $serie; ?>

                                        <?php foreach ($imagenes as $i): ?>
                                            <a href="storage/products/<?php echo $i->img; ?>" target="_blank">
                                                <div class="col-md-2">
                                                    <img src="storage/products/<?php echo $i->img; ?>" style="width:64px;">
                                                </div>
                                            </a>
                                        <?php endforeach;?>
                                    </td>
                                    <td><?php echo $product->name; ?></td>
                                    <td><?php echo $product->model; ?></td>
                                    <td><?php echo $product->serie; ?></td>
                                    <td><?php echo $product->capacity; ?></td>
                                    <td style="display: none;">$
                                        <?php echo number_format($product->price_out, 2, '.', ','); ?></td>
                                        <td><?php if ($product->category_id != null) {
		echo $product->getCategory()->name;
	} else {
		echo "<center>----</center>";
	}?></td>
                                      <td><?php echo $product->type; ?></td>
                                      <?php if ($showStatus): ?>
                                          <?php if ($product->status == 0): ?>
                                            <td>Taller</td>
                                            <?php else: ?>
                                                <td>Terminado</td>
                                            <?php endif;?>
                                        <?php endif;?>
                                        <?php if ($showPrice): ?>
                                          <th><?php echo number_format($product->price_out, 2, '.', ','); ?></th>
                                      <?php endif;?>


                                      <td style="text-align: center; font-size: 30px;">
                                        <?php if ($product->is_active == 1): ?>
                                            <i class="fa fa-check"></i>
                                            <?php else: ?>
                                                <i class="fa fa-times"></i>

                                            <?php endif;?>
                                        </td>

                                        <?php if ($ended): ?>
                                            <td style="width:90px;">

                                                <a href="index.php?view=editproduct&id=<?php echo $product->id; ?>&finished=1&serie=<?php echo $product->serie; ?>"
                                                    class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
                                                    <?php if (Core::$user->kind == 1): ?>
                                                        <a onclick="activate_product(<?php echo $product->id; ?>)"
                                                            class="btn btn-xs btn-success"><i class="glyphicon glyphicon-check"></i></a>
                                                        <?php endif;?>


                                                    </td>

                                                    <?php elseif ($workshop): ?>
                                                        <td style="width:90px;">

                                                            <a href="index.php?view=editproduct&id=<?php echo $product->id; ?>&is_workshop=1&serie=<?php echo $product->serie; ?>"
                                                                class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-wrench"></i></a>
                                                                <a onclick="liberate_product(<?php echo $product->id; ?>)"
                                                                    class="btn btn-xs btn-success"><i class="glyphicon glyphicon-usd"></i></a>

                                                                </td>
                                                                <?php else: ?>
                                                                    <td style="width:90px;">
                                                                      <div class="row" style="margin-bottom: 2%;">
                                                                        <div class="col-md-2">
                                                                          <a target="_blank" href="index.php?action=productqr&id=<?php echo $product->id; ?>"
                                                                              class="btn btn-xs btn-default"><i class="fa fa-qrcode"></i></a>
                                                                          </div>
                                                                          <div class="col-md-2">
                                                                              <a href="index.php?view=editproduct&id=<?php echo $product->id; ?>&serie=<?php echo $product->serie; ?>"
                                                                                  class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-pencil"></i></a>
                                                                              </div>
                                                                              <div class="col-md-2">
                                                                                  <a style="display: none"
                                                                                  href="index.php?view=refaproduct&id=<?php echo $product->id; ?>"
                                                                                  class="btn btn-xs btn-success"><i class="glyphicon glyphicon-wrench"></i></a>
                                                                                  <a href="index.php?view=delproduct&id=<?php echo $product->id; ?>"
                                                                                      class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                                                                                  </div>




                                                                              </div>
                                                                              <div class="row">
                                                                                <a onclick="getHistorial(<?php echo $product->id; ?>)"
                                                                                    class="btn btn-xs btn-info" style="width: 90%; margin-left:5%; margin-righ:auto;">Ver Historial</a>
                                                                                </div>

                                                                            </td>

                                                                        <?php endif;?>
                                                                    </tr>
                                                                <?php endforeach;?>
                                                            </table>
                                                        </div>
                                                    </div><!-- /.box-body -->
                                                </div><!-- /.box -->

                                                <!-- Modal -->
                                                <div class="modal fade" id="historial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h3 class="modal-title" id="exampleModalLabel" style="width:100%; text-align:center;"><b>Historial</b></h3>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                      </button>
                                                  </div>
                                                  <div class="modal-body">
                                                    <div class="row">
                                                      <div class="col-md-2">

                                                      </div>
                                                      <div class="col-md-8" id="fechas">

                                                      </div>
                                                      <div class="col-md-2">

                                                      </div>
                                                  </div>

                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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
                                                        <input type="text" name="name" class="form-control" readonly placeholder="Marca" id="marca" value="">
                                                    </div>
                                                    <label for="" class="col-sm-2 col-form-label">Modelo</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" name="model" class="form-control" readonly id="modelo" placeholder="Modelo">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-sm-2 col-form-label">Serie</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" name="serie" class="form-control" readonly id="serie" placeholder="Serie" value="">
                                                    </div>
                                                    <label for="inputPassword" class="col-sm-2 col-form-label">Horómetro</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" name="horometer" class="form-control" readonly id="horo" placeholder="Horómetro">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-sm-2 col-form-label">Técnico</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" name="tecnico"  class="form-control" id="tec" readonly placeholder="Técnico" value="">
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
                                                        <input type="checkbox" id="a1" readonly value="">
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="ob1" readonly placeholder="Observaciones">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="staticEmail" style="margin-top: 1%;" class="col-sm-3 col-form-label">Aceite
                                                    Transmisión</label>
                                                    <div class="col-sm-1" style="margin-top: 1%;">
                                                        <input type="checkbox" id="a2" readonly value="">
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="ob2" readonly placeholder="Observaciones">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="staticEmail" style="margin-top: 1%;" class="col-sm-3 col-form-label">Aceite
                                                    Hidráulico</label>
                                                    <div class="col-sm-1" style="margin-top: 1%;">
                                                        <input type="checkbox" id="a3" readonly value="">
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" readonly id="ob3" placeholder="Observaciones">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="staticEmail" style="margin-top: 1%;" class="col-sm-3 col-form-label">Anticongelante
                                                    Radiador</label>
                                                    <div class="col-sm-1" style="margin-top: 1%;">
                                                        <input type="checkbox" readonly id="a4" value="">
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" readonly id="ob4" placeholder="Observaciones">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="staticEmail" style="margin-top: 1%;" class="col-sm-3 col-form-label">Anticongelante
                                                    Recuperador</label>
                                                    <div class="col-sm-1" style="margin-top: 1%;">
                                                        <input type="checkbox" readonly id="a5" value="">
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" readonly id="ob5" placeholder="Observaciones">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="staticEmail" style="margin-top: 1%;" class="col-sm-6 col-form-label">Imágen Horómetro</label>
                                                    <label for="staticEmail" style="margin-top: 1%;" class="col-sm-6 col-form-label">Imágen Equipo</label>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <img  id="img1" style="width: 100%; height: 200px;" alt="">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <img  id="img2" style="width: 100%; height: 200px;" alt="">
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            <?php
} else {
	?>
                           <div class="alert alert-info">
                            <h2>No hay productos</h2>
                            <p>No se han agregado productos a la base de datos, puedes agregar uno dando click en el boton
                                <b>"Agregar
                                Producto"</b>.</p>
                            </div>
                            <?php
}

?>
                        <br><br><br><br><br><br><br><br><br><br>
                    </div>
                </div>
            </section><!-- /.content -->

            <script src="../application/core/app/assets/refactions.js"></script>
<script type="text/javascript">
        function thePDF() {
var doc = new jsPDF('p', 'pt');
        doc.setFontSize(26);
        doc.text("<?php echo ConfigurationData::getByPreffix("company_name")->val; ?>", 40, 65);
        doc.setFontSize(18);
        doc.text("LISTADO DE PRODUCTOS", 40, 80);
        doc.setFontSize(12);
        doc.text("Usuario: <?php echo Core::$user->name . " " . Core::$user->lastname; ?>  -  Fecha: <?php echo date("d-m-Y h:i:s"); ?> ", 40, 90);
var columns = [
    {title: "Id", dataKey: "id"},
    {title: "Nombre del Producto", dataKey: "name"},
    {title: "Precio de Salida", dataKey: "price_out"},
];
var rows = [
  <?php foreach ($products as $product):
?>
    {
      "id": "<?php echo $product->id; ?>",
      "name": "<?php echo $product->name; ?>",
      "price_out": "$ <?php echo number_format($product->price_out, 2, '.', ','); ?>",
      },
 <?php endforeach;?>
];
doc.autoTable(columns, rows, {
    theme: 'grid',
    overflow:'linebreak',
    styles: {
        fillColor: <?php echo Core::$pdf_table_fillcolor; ?>
    },
    columnStyles: {
        id: {fillColor: <?php echo Core::$pdf_table_column_fillcolor; ?>}
    },
    margin: {top: 100},
    afterPageContent: function(data) {
    }
});
doc.setFontSize(12);
doc.text("<?php echo Core::$pdf_footer; ?>", 40, doc.autoTableEndPosY()+25);
<?php
$con = ConfigurationData::getByPreffix("report_image");
if ($con != null && $con->val != ""):
?>
var img = new Image();
img.src= "logo.png";
img.onload = function(){
doc.addImage(img, 'PNG', 495, 20, 60, 60,'mon');
doc.save('products-<?php echo date("d-m-Y h:i:s", time()); ?>.pdf');
}
<?php else: ?>
doc.save('products-<?php echo date("d-m-Y h:i:s", time()); ?>.pdf');
<?php endif;?>
}
</script>

