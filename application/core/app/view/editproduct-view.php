<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.4/build/alertify.min.js"></script>
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.4/build/css/alertify.min.css"/>
<!--<link rel="stylesheet" href="/application/core/app/assets/css/alertify.css"/>-->

<style>
    .alertify-notifier {
        color: white !important;
        font-weight: bolder !important;
    }
    /* Container needed to position the button. Adjust the width as needed */
    .container {
        position: relative;
        width: 100%;
    }

    /* Make the image responsive */
    .container img {
        width: 100%;
        height: auto;
    }

    /* Style the button and place it in the middle of the container/image */
    .container .btn {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        color: white;
        font-size: 16px;
        padding: 12px 24px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
    }

    .container .btn:hover {
        background-color: red;
    }
</style>
<section class="content">
    <?php
require '../application/core/app/model/Conection.php';
$lista = R::find('reparations', ' product_id =  "' . $_GET["id"] . '"');
$list2 = R::find('refactions', ' product_id =  "' . $_GET["id"] . '"');

$product = ProductData::getById($_GET["id"]);
if (isset($_GET["is_workshop"])) {
	$workshop = $_GET["is_workshop"];

} else {
	$workshop = 0;
}
if (isset($_GET["finished"])) {
	$finished = $_GET["finished"];

} else {
	$finished = 0;
}
$categories = CategoryData::getAll();
$imagenes = ProductData::getBySerie($_GET["serie"]);

if ($product != null):
?>
        <div class="row">
            <div class="col-md-12">
                <h1><?php echo $product->name ?>
                    <small>Editar Producto</small>
                </h1>
                <?php if (isset($_COOKIE["prdupd"])): ?>
                    <p class="alert alert-info">La informacion del producto se ha actualizado exitosamente.</p>
                    <?php setcookie("prdupd", "", time() - 18600);endif;?>
                <br>
                <div class="box box-primary">
                    <table class="table">
                        <tr>
                            <td>
                                <form class="form-horizontal" method="post" id="addproduct"
                                      enctype="multipart/form-data" action="index.php?view=updateproduct" role="form">

                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-3 control-label">Imagen*</label>
                                        <div class="col-md-8">
                                            <input type="file" multiple="" <?php if (count($imagenes) == 6): echo "readonly='readonly'";endif;?> onchange="validateFiles(<?php echo count($imagenes); ?>)" <?php if ($workshop == 1): echo "readonly='readonly'";endif;?>
                                                   name="image[]" id="image[]" placeholder="">

                                            <br>
                                            <div class="row">
<?php if ($workshop): ?>
<input type="hidden" id="type" name="type" value="is_workshop=1">
<?php elseif ($finished): ?>
<input type="hidden" id="type" name="type" value="finished=1">
    <?php else: ?>
<input type="hidden" id="type" name="type" value="">
    <?php endif;?>



                                                <?php foreach ($imagenes as $img): ?>

                                                    <div class="col-md-2">
                                                        <div class="container">
                                                            <img style="max-height: 350px; width: 100%;"
                                                                 src="storage/products/<?php echo $img->img; ?>"
                                                                 class="img-responsive">
                                                                 <?php if ($workshop): ?>
    <?php else: ?>
    <button type="button" onclick="deleteImage(<?php echo $img->id; ?>)" class="btn btn-danger"><i class="fa fa-times"></i></button>

    <?php endif;?>
                                                        </div>
                                                    </div>
                                                <?php endforeach;?>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group" style="display: none">
                                        <label for="inputEmail1" class="col-lg-3 control-label">Codigo de
                                            barras*</label>
                                        <div class="col-md-8">
                                            <input type="text" name="barcode" class="form-control" id="barcode"
                                                   value="<?php echo $product->barcode; ?>"
                                                   placeholder="Codigo de barras del Producto">
                                        </div>
                                    </div>
                                    <input type="hidden" id="product_id" value="<?php echo $product->id; ?>">
                                    <div class="form-group" style="">
                                        <label for="inputEmail1" class="col-lg-3 control-label">Marca</label>
                                        <div class="col-md-8">
                                            <input type="text" name="name" class="form-control" id="name"
                                                   value="<?php echo $product->name; ?>"
                                                   placeholder="Marca del Producto">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-3 control-label">Categoria</label>
                                        <div class="col-md-8">
                                            <select name="category_id"
                                                    class="form-control" <?php if ($workshop == 1 || $finished == 1): echo "readonly='readonly'";endif;?>>
                                                <option value="">-- NINGUNA --</option>
                                                <?php foreach ($categories as $category): ?>
                                                    <option value="<?php echo $category->id; ?>" <?php if ($product->category_id != null && $product->category_id == $category->id) {
	echo "selected";
}?>><?php echo $category->name; ?></option>
                                                <?php endforeach;?>
                                            </select></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-3 control-label">Descripcion</label>
                                        <div class="col-md-8">
                                            <textarea
                                                    name="description" <?php if ($workshop == 1): echo "readonly='readonly'";endif;?> class="form-control"
                                                    id="description"
                                                    placeholder="Descripcion del Producto"><?php echo $product->description; ?></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group" style="display: none">
                                        <label for="inputEmail1" class="col-lg-3 control-label">Precio de
                                            Entrada*</label>
                                        <div class="col-md-8">
                                            <input type="text"
                                                   name="price_in" <?php if ($workshop == 1 || $finished == 1): echo "readonly='readonly'";endif;?>
                                                   class="form-control" value="<?php echo $product->price_in; ?>"
                                                   id="price_in" placeholder="Precio de entrada">
                                        </div>
                                    </div>
                                    <div class="form-group" style="display: none">
                                        <label for="inputEmail1" class="col-lg-3 control-label">Precio de
                                            Salida*</label>
                                        <div class="col-md-8">
                                            <input type="text"
                                                   name="price_out" <?php if ($workshop == 1 || $finished == 1): echo "readonly='readonly'";endif;?>
                                                   class="form-control" id="price_out"
                                                   value="<?php echo $product->price_out; ?>"
                                                   placeholder="Precio de salida">
                                        </div>
                                    </div>
                                    <div class="form-group" style="display: none;">
                                        <label for="inputEmail1" class="col-lg-3 control-label">Unidad*</label>
                                        <div class="col-md-8">
                                            <input type="text"
                                                   name="unit" <?php if ($workshop == 1 || $finished == 1): echo "readonly='readonly'";endif;?>
                                                   class="form-control" id="unit" value="<?php echo $product->unit; ?>"
                                                   placeholder="Unidad del Producto">
                                        </div>
                                    </div>
                                    <div class="form-group" style="display: none;">
                                        <label for="inputEmail1" class="col-lg-3 control-label">Presentacion</label>
                                        <div class="col-md-8">
                                            <input type="text"
                                                   name="presentation" <?php if ($workshop == 1): echo "readonly='readonly'";endif;?>
                                                   class="form-control" id="inputEmail1"
                                                   value="<?php echo $product->presentation; ?>"
                                                   placeholder="Presentacion del Producto">
                                        </div>
                                    </div>
                                    <div class="form-group" style="display: none;">
                                        <label for="inputEmail1" class="col-lg-3 control-label">Minima en
                                            inventario:</label>
                                        <div class="col-md-8">
                                            <input type="text"
                                                   name="inventary_min" <?php if ($workshop == 1 || $finished == 1): echo "readonly='readonly'";endif;?>
                                                   class="form-control" value="<?php echo $product->inventary_min; ?>"
                                                   id="inputEmail1" placeholder="Minima en Inventario (Default 10)">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-3 control-label">Modelo:</label>
                                        <div class="col-md-8">
                                            <input type="text"
                                                   name="modelo" <?php if ($workshop == 1 || $finished == 1): echo "readonly='readonly'";endif;?>
                                                   class="form-control" value="<?php echo $product->model; ?>"
                                                   id="modelo" value=""
                                                   placeholder="Modelo">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-3 control-label">Serie:</label>
                                        <div class="col-md-8">
                                            <input type="text"
                                                   name="serie" readonly
                                                   value="<?php echo $product->serie; ?>" class="form-control"
                                                   id="serie"
                                                   placeholder="Serie">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-3 control-label">Capacidad:</label>
                                        <div class="col-md-8">
                                            <input type="text"
                                                   name="capacidad" <?php if ($workshop == 1 || $finished == 1): echo "readonly='readonly'";endif;?>
                                                   value="<?php echo $product->capacity; ?>" class="form-control"
                                                   id="capacidad"
                                                   placeholder="Capacidad">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-3 control-label">Altura:</label>
                                        <div class="col-md-8">
                                            <input type="text"
                                                   name="altura" <?php if ($workshop == 1 || $finished == 1): echo "readonly='readonly'";endif;?>
                                                   value="<?php echo $product->height; ?>" class="form-control"
                                                   id="altura"
                                                   placeholder="Altura">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-3 control-label">Combustible:</label>
                                        <div class="col-md-8">
                                            <input type="text"
                                                   name="combustible" <?php if ($workshop == 1 || $finished == 1): echo "readonly='readonly'";endif;?>
                                                   value="<?php echo $product->fuel; ?>" class="form-control"
                                                   id="combustible"
                                                   placeholder="Combustible">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-3 control-label">Fecha de
                                            ingreso:</label>
                                        <div class="col-md-8">
                                            <input type="date"
                                                   name="fechaingreso" <?php if ($workshop == 1 || $finished == 1): echo "readonly='readonly'";endif;?>
                                                   value="<?php echo $product->admissiondate; ?>" class="form-control"
                                                   id="fechaingreso"
                                                   placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-3 control-label">Horometro:</label>
                                        <div class="col-md-8">
                                            <input type="text"
                                                   name="horometro" <?php if ($workshop == 1 || $finished == 1): echo "readonly='readonly'";endif;?>
                                                   class="form-control" value="<?php echo $product->horometer; ?>"
                                                   id="horometro"
                                                   placeholder="Horometro">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-3 control-label">Observacion:</label>
                                        <div class="col-md-8">
                                            <input type="text"
                                                   name="observacion" <?php if ($workshop == 1 || $finished == 1): echo "readonly='readonly'";endif;?>
                                                   class="form-control" value="<?php echo $product->observation; ?>"
                                                   id="observacion"
                                                   placeholder="observacion">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-3 control-label">Tipo</label>
                                        <div class="col-md-8">
                                            <select name="tipo"
                                                    class="form-control" <?php if ($workshop == 1 || $finished == 1): echo "";endif;?>>
                                                <?php if ($product->type == "Venta"): ?>
                                                    <option value="<?php echo $product->type; ?>"
                                                            selected><?php echo $product->type; ?></option>
                                                    <option value="Renta">Renta</option>
                                                    <option value="Servicio">Servicio</option>
                                                <?php elseif ($product->type == "Renta"): ?>
                                                    <option value="<?php echo $product->type; ?>"
                                                            selected><?php echo $product->type; ?></option>
                                                    <option value="Venta">Venta</option>
                                                    <option value="Servicio">Servicio</option>
                                                <?php elseif ($product->type == "Servicio"): ?>
                                                    <option value="<?php echo $product->type; ?>"
                                                            selected><?php echo $product->type; ?></option>
                                                    <option value="Venta">Venta</option>
                                                    <option value="Renta">Renta</option>
                                                <?php else: ?>
                                                    <option value="Venta">Venta</option>
                                                    <option value="Renta">Renta</option>
                                                    <option value="Servicio">Servicio</option>

                                                <?php endif;?>


                                            </select></div>
                                    </div>


                                    <div class="form-group" style="display:none;">
                                        <label for="inputEmail1" class="col-lg-3 control-label">Renta</label>
                                        <div class="col-md-8">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="is_rent" <?php if ($product->is_rent) {
	echo "checked";
}?>>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group" style="display: none">
                                        <label for="inputEmail1" class="col-lg-3 control-label">Esta activo</label>
                                        <div class="col-md-8">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"
                                                           name="is_active" <?php if ($product->is_active) {
	echo "checked";
}?>>
                                                </label>
                                            </div>
                                        </div>
                                    </div>


                                        <div class="form-group">
                                            <div class="col-lg-offset-3 col-lg-8">
                                                <input type="hidden" name="product_id"
                                                       value="<?php echo $product->id; ?>">
                                                <button type="submit" class="btn btn-success">Actualizar Producto
                                                </button>
                                                <a href="./?view=products" class="btn btn-danger">Regresar</a>
                                            </div>
                                        </div>
                                </form>
                                <?php if ($workshop || $finished): ?>
                                <hr>
                                    <h1 style="width: 100%; text-align: center;">Reparaciones</h1>
                                    <br>
                                <?php if ($workshop): ?>

                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <form class="form-horizontal col-md-4" method="post" id="addproduct"
                                              enctype="multipart/form-data" action="" role="form">

                                            <div class="form-group">
                                                <label for="inputEmail1"
                                                       class="col-lg-3 control-label">Reparación:</label>
                                                <div class="col-md-8">
                                                    <input type="text"
                                                           name="reparation"
                                                           class="form-control"
                                                           id="reparation"
                                                           placeholder="Reparación">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputEmail1" class="col-lg-3 control-label">Horas
                                                    consumidas:</label>
                                                <div class="col-md-8">
                                                    <input type="number"
                                                           name="hours"
                                                           class="form-control"
                                                           id="hours"
                                                           placeholder="Horas consumidas">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-lg-offset-3 col-lg-8">
                                                    <input type="hidden" name="product_id"
                                                           value="<?php echo $product->id; ?>">
                                                    <button type="button" onclick="insertReparation()" id="addrep"
                                                            class="btn btn-success">Agregar
                                                    </button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                                <?php endif;?>
                                    <?php if ($workshop || $finished): ?>
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-8">
                                            <table class="table table-sm">
                                                <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Reparación</th>
                                                    <th scope="col">Horas consumidas</th>
                                                    <?php if ($workshop): ?>
                                                    <th scope="col">Borrar</th>
                                                    <?php else: ?>
                                                <?php endif;?>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php if (empty($lista)): ?>

                                                    <tr>
                                                        <td></td>
                                                        <td style="font-weight: bolder;">Aún no se han realizado
                                                            reparaciones.
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                <?php else: ?>
                                                    <?php foreach ($lista as $l): ?>

                                                        <tr>
                                                            <th scope="row"><?php echo $l->id; ?></th>
                                                            <td><?php echo $l->reparation; ?></td>
                                                            <td><?php echo $l->hours; ?> Hrs.</td>
                                                            <?php if ($workshop): ?>

                                                            <td><a class="btn btn-xs btn-danger"
                                                                   onclick="deleteReparation(<?php echo $l->id; ?>)"><i
                                                                            class="fa fa-trash"></i></a></td>
                                                                            <?php else: ?>
                                                <?php endif;?>
                                                <?php if ($finished && Core::$user->kind == 1): ?>
                                                <td><input type="number" name="" id="costoR_<?php echo $l->id; ?>" class="form-control costoR" placeholder="precio" value="<?php echo $l->cost; ?>"></td>
                                              <?php endif;?>
                                                        </tr>

                                                    <?php endforeach;?>
                                                <?php endif;?>
                                                </tbody>
                                            </table>
                                            <?php if ($finished): ?>
                                          <button type="button" style="float:right" class="btn btn-success" onclick="addCostReparation()" name="button">Guardar</button>
                                          <?php endif;?>
                                        </div>
                                        <?php endif;?>

                                        <div class="col-md-2"></div>

                                    </div>
                                    <hr>
                                    <h1 style="width: 100%; text-align: center;">Refacciones</h1>
                                    <br>
                                    <?php if ($workshop): ?>
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <form class="form-horizontal col-md-4" method="post" id="addproduct"
                                              enctype="multipart/form-data" action="index.php?view=" role="form">

                                            <div class="form-group">
                                                <label for="inputEmail1"
                                                       class="col-lg-3 control-label">Refacción:</label>
                                                <div class="col-md-8">
                                                    <input type="text"
                                                           name="refaccion"
                                                           class="form-control"
                                                           id="refaction"
                                                           placeholder="Refacción">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-lg-offset-3 col-lg-8">
                                                    <input type="hidden" name="product_id"
                                                           value="<?php echo $product->id; ?>">
                                                    <button type="button" id="addref" class="btn btn-success">Agregar
                                                    </button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                                <?php endif;?>
                                    <?php if ($workshop || $finished): ?>

                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-8">
                                            <table class="table table-sm">
                                                <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Refacción</th>
                                                    <?php if ($workshop): ?>
                                                    <th scope="col">Borrar</th>
                                                    <?php else: ?>
                                                <?php endif;?>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php if ($list2 == ""): ?>

                                                    <tr>
                                                        <td></td>
                                                        <td style="font-weight: bolder;">Aún no se han agregado
                                                            refacciones.
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                <?php else: ?>
                                                    <?php foreach ($list2 as $l): ?>

                                                        <tr>
                                                            <th scope="row"><?php echo $l->id; ?></th>
                                                            <td><?php echo $l->refaction; ?></td>
                                                            <?php if ($workshop): ?>

                                                            <td><a class="btn btn-xs btn-danger"
                                                                   onclick="deleteRefaction(<?php echo $l->id; ?>)"><i
                                                                            class="fa fa-trash"></i></a></td>
                                                                            <?php else: ?>
                                                <?php endif;?>
                                                <?php if ($finished && Core::$user->kind == 1): ?>
                                                <td style="width: 28%; "><input type="text" id="costoF_<?php echo $l->id; ?>" class="form-control costoF" style=""  name="" placeholder="Precio" value="<?php echo $l->cost; ?>"></td>
                                              <?php endif;?>
                                                        </tr>

                                                    <?php endforeach;?>
                                                <?php endif;?>
                                                </tbody>
                                            </table>
                                            <?php if ($finished): ?>
                                          <button type="button" style="float:right" class="btn btn-success" onclick="addCostRefaction()" name="button">Guardar</button>
                                          <?php endif;?>
                                        </div>
                                        <div class="col-md-2"></div>

                                    </div>
                                    <div class="col-md-2"></div>


                                <?php endif;?>
                                <?php if ($workshop): ?>
                                <a href="./?view=products&is_workshop=1" class="btn btn-danger">Regresar</a>

                                <?php elseif ($finished): ?>
                                <a href="./?view=products&is_ended=1" class="btn btn-danger">Regresar</a>
                                                <?php else: ?>
                                                <a href="./?view=products" class="btn btn-danger">Regresar</a>
                                                <?php endif;?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
                                                <?php endif;?>
    <?php endif;?>
</section>
<script src="../application/core/app/assets/refactions.js"></script>
<script src="../application/core/app/assets/alertify.js"></script>
