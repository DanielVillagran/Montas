<!-- Content Header (Page header) -->
<?php
if(isset($_GET["is_workshop"])){
    $workshop = true;
}else{
    $workshop = false;
}
if(isset($_GET["is_ended"])){
    $ended = true;
}else{
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
                <?php if($workshop || $ended): ?>
                <?php else:?>
                <a href="index.php?view=newproduct" class="btn btn-default">Agregar Producto</a>

                <?php endif;?>
                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-download"></i> Descargar <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="report/products-word.php">Word 2007 (.docx)</a></li>
                        <li><a href="report/products-xlsx.php">Excel (.xlsx)</a></li>
                        <li><a onclick="thePDF()" id="makepdf" class="">PDF (.pdf)</a>

                    </ul>
                </div>
            </div>
            <div class="clearfix"></div>
            <br>

            <?php
            $showStatus = false;
            if($workshop){
                $products = ProductData::getWorkshop();
                $showStatus = false;
                $showPrice = false;


            }else if($ended){
                $products = ProductData::getFinished();
                $showStatus = false;
                $showPrice = true;


            }else{
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
                                <th>Modelo</th>
                                <th>Serie</th>
                                <th>Capacidad</th>
                                <th style="display: none;">Precio Salida</th>
                                <th>Categoria</th>
                                <th>Tipo</th>
                                <?php if($showStatus) :?>
                                <th>Estatus</th>
                              <?php endif;?>
                              <?php if($showPrice) :?>
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
                                            $imagenes = ProductData::getBySerie($serie);
                                            ?>

                                    <?php foreach ($imagenes as $i): ?>
                                    <a href="storage/products/<?php echo $i->img; ?>" target="_blank">
                                        <div class="col-md-2">
                                            <img src="storage/products/<?php echo $i->img; ?>" style="width:64px;">
                                        </div>
                                    </a>
                                    <?php endforeach; ?>
                                </td>
                                <td><?php echo $product->model; ?></td>
                                <td><?php echo $product->serie; ?></td>
                                <td><?php echo $product->capacity; ?></td>
                                <td style="display: none;">$
                                    <?php echo number_format($product->price_out, 2, '.', ','); ?></td>
                                <td><?php if ($product->category_id != null) {
                                                echo $product->getCategory()->name;
                                            } else {
                                                echo "<center>----</center>";
                                            } ?></td>
                                <td><?php echo $product->type; ?></td>
                                <?php if($showStatus): ?>
                                  <?php if($product->status == 0):?>
                                    <td>Taller</td>
                                  <?php else:?>
                                    <td>Terminado</td>
                                  <?php endif;?>
                              <?php endif;?>
                              <?php if($showPrice) :?>
                              <th><?php echo number_format($product->price_out,2, '.',','); ?></th>
                            <?php endif;?>


                                <td style="text-align: center; font-size: 30px;">
                                    <?php if ($product->is_active == 1): ?>
                                    <i class="fa fa-check"></i>
                                    <?php else:?>
                                    <i class="fa fa-times"></i>

                                    <?php endif; ?>
                                </td>

                                <?php if($ended): ?>
                                <td style="width:90px;">

                                    <a href="index.php?view=editproduct&id=<?php echo $product->id; ?>&finished=1&serie=<?php echo $product->serie; ?>"
                                        class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
                                    <a onclick="activate_product(<?php echo $product->id; ?>)"
                                        class="btn btn-xs btn-success"><i class="glyphicon glyphicon-check"></i></a>

                                </td>

                                <?php elseif($workshop):?>
                                <td style="width:90px;">

                                    <a href="index.php?view=editproduct&id=<?php echo $product->id; ?>&is_workshop=1&serie=<?php echo $product->serie; ?>"
                                        class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-wrench"></i></a>
                                    <a onclick="liberate_product(<?php echo $product->id; ?>)"
                                        class="btn btn-xs btn-success"><i class="glyphicon glyphicon-usd"></i></a>

                                </td>
                                <?php else:?>
                                <td style="width:90px;">
                                    <a target="_blank" href="index.php?action=productqr&id=<?php echo $product->id; ?>"
                                        class="btn btn-xs btn-default"><i class="fa fa-qrcode"></i></a>
                                    <a href="index.php?view=editproduct&id=<?php echo $product->id; ?>&serie=<?php echo $product->serie; ?>"
                                        class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-pencil"></i></a>
                                    <a style="display: none"
                                        href="index.php?view=refaproduct&id=<?php echo $product->id; ?>"
                                        class="btn btn-xs btn-success"><i class="glyphicon glyphicon-wrench"></i></a>
                                    <a href="index.php?view=delproduct&id=<?php echo $product->id; ?>"
                                        class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                                </td>

                                <?php endif;?>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->


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
        doc.text("<?php echo ConfigurationData::getByPreffix("
            company_name ")->val;?>", 40, 65);
        doc.setFontSize(18);
        doc.text("LISTADO DE PRODUCTOS", 40, 80);
        doc.setFontSize(12);
        doc.text("Usuario: <?php echo Core::$user->name . "
            " . Core::$user->lastname; ?>  -  Fecha: <?php echo date("
            d - m - Y h: i: s ");?> ", 40, 90);
        var columns = [{
                title: "Id",
                dataKey: "id"
            },
            {
                title: "Codigo",
                dataKey: "code"
            },
            {
                title: "Nombre del Producto",
                dataKey: "name"
            },
            {
                title: "Precio de entrada",
                dataKey: "price_in"
            },
            {
                title: "Precio de Salida",
                dataKey: "price_in"
            },
        ];
        var rows = [ <
            ? php foreach($products as $product) :
            ?
            > {
                "id": "<?php echo $product->id; ?>",
                "code": "<?php echo $product->barcode; ?>",
                "name": "<?php echo $product->name; ?>",
                "price_in": "$ <?php echo number_format($product->price_in, 2, '.', ',');?>",
                "price_out": "$ <?php echo number_format($product->price_out, 2, '.', ',');?>",
            }, <
            ? php endforeach; ? >
        ];
        doc.autoTable(columns, rows, {
            theme: 'grid',
            overflow: 'linebreak',
            styles: {
                fillColor: < ? php echo Core::$pdf_table_fillcolor; ? >
            },
            columnStyles: {
                id: {
                    fillColor: < ? php echo Core::$pdf_table_column_fillcolor; ? >
                }
            },
            margin: {
                top: 100
            },
            afterPageContent: function (data) {}
        });
        doc.setFontSize(12);
        doc.text("<?php echo Core::$pdf_footer;?>", 40, doc.autoTableEndPosY() + 25); <
        ? php
        $con = ConfigurationData::getByPreffix("report_image");
        if ($con != null && $con - > val != ""):
            ?
            >
            var img = new Image();
        img.src = "storage/configuration/<?php echo $con->val;?>";
        img.onload = function () {
                doc.addImage(img, 'PNG', 495, 20, 60, 60, 'mon');
                doc.save('products-<?php echo date("d-m-Y h:i:s", time()); ?>.pdf');
            } <
            ? php
        else : ? >
            doc.save('products-<?php echo date("d-m-Y h:i:s", time()); ?>.pdf'); <
        ? php endif; ? >
    }



</script>
