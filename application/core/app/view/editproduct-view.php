<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.4/build/alertify.min.js"></script>
<!--<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.4/build/css/alertify.min.css"/>-->
<link rel="stylesheet" href="/application/core/app/assets/css/alertify.css"/>

<style>
    .alertify-notifier{
        color: white !important;
        font-weight: bolder !important;
    }
</style>
<section class="content">
    <?php
    require '../application/core/app/model/Conection.php';
    $lista=R::find( 'reparations', ' product_id =  "'.$_GET["id"].'"');
    $list2=R::find( 'refactions', ' product_id =  "'.$_GET["id"].'"');


    $product = ProductData::getById($_GET["id"]);
    if (isset($_GET["is_workshop"])) {
        $workshop = $_GET["is_workshop"];

    } else {
        $workshop = 0;
    }
    $categories = CategoryData::getAll();

    if ($product != null):
        ?>
        <div class="row">
            <div class="col-md-12">
                <h1><?php echo $product->name ?>
                    <small>Editar Producto</small>
                </h1>
                <?php if (isset($_COOKIE["prdupd"])): ?>
                    <p class="alert alert-info">La informacion del producto se ha actualizado exitosamente.</p>
                    <?php setcookie("prdupd", "", time() - 18600); endif; ?>
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
                                            <input type="file" <?php if ($workshop == 1): echo "disabled"; endif; ?>
                                                   name="image" id="name" placeholder="">
                                            <?php if ($product->image != ""): ?>
                                                <br>
                                                <img style="max-height: 350px; width: 100%;"
                                                     src="storage/products/<?php echo $product->image; ?>"
                                                     class="img-responsive">
                                            <?php endif; ?>
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
                                    <div class="form-group" style="display: none">
                                        <label for="inputEmail1" class="col-lg-3 control-label">Nombre*</label>
                                        <div class="col-md-8">
                                            <input type="text" name="name" class="form-control" id="name"
                                                   value="<?php echo $product->name; ?>"
                                                   placeholder="Nombre del Producto">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-3 control-label">Categoria</label>
                                        <div class="col-md-8">
                                            <select name="category_id"
                                                    class="form-control" <?php if ($workshop == 1): echo "disabled"; endif; ?>>
                                                <option value="">-- NINGUNA --</option>
                                                <?php foreach ($categories as $category): ?>
                                                    <option value="<?php echo $category->id; ?>" <?php if ($product->category_id != null && $product->category_id == $category->id) {
                                                        echo "selected";
                                                    } ?>><?php echo $category->name; ?></option>
                                                <?php endforeach; ?>
                                            </select></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-3 control-label">Descripcion</label>
                                        <div class="col-md-8">
                                            <textarea
                                                    name="description" <?php if ($workshop == 1): echo "disabled"; endif; ?> class="form-control"
                                                    id="description"
                                                    placeholder="Descripcion del Producto"><?php echo $product->description; ?></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group" style="display: none">
                                        <label for="inputEmail1" class="col-lg-3 control-label">Precio de
                                            Entrada*</label>
                                        <div class="col-md-8">
                                            <input type="text"
                                                   name="price_in" <?php if ($workshop == 1): echo "disabled"; endif; ?>
                                                   class="form-control" value="<?php echo $product->price_in; ?>"
                                                   id="price_in" placeholder="Precio de entrada">
                                        </div>
                                    </div>
                                    <div class="form-group" style="display: none">
                                        <label for="inputEmail1" class="col-lg-3 control-label">Precio de
                                            Salida*</label>
                                        <div class="col-md-8">
                                            <input type="text"
                                                   name="price_out" <?php if ($workshop == 1): echo "disabled"; endif; ?>
                                                   class="form-control" id="price_out"
                                                   value="<?php echo $product->price_out; ?>"
                                                   placeholder="Precio de salida">
                                        </div>
                                    </div>
                                    <div class="form-group" style="display: none;">
                                        <label for="inputEmail1" class="col-lg-3 control-label">Unidad*</label>
                                        <div class="col-md-8">
                                            <input type="text"
                                                   name="unit" <?php if ($workshop == 1): echo "disabled"; endif; ?>
                                                   class="form-control" id="unit" value="<?php echo $product->unit; ?>"
                                                   placeholder="Unidad del Producto">
                                        </div>
                                    </div>
                                    <div class="form-group" style="display: none;">
                                        <label for="inputEmail1" class="col-lg-3 control-label">Presentacion</label>
                                        <div class="col-md-8">
                                            <input type="text"
                                                   name="presentation" <?php if ($workshop == 1): echo "disabled"; endif; ?>
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
                                                   name="inventary_min" <?php if ($workshop == 1): echo "disabled"; endif; ?>
                                                   class="form-control" value="<?php echo $product->inventary_min; ?>"
                                                   id="inputEmail1" placeholder="Minima en Inventario (Default 10)">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-3 control-label">Modelo:</label>
                                        <div class="col-md-8">
                                            <input type="text"
                                                   name="modelo" <?php if ($workshop == 1): echo "disabled"; endif; ?>
                                                   class="form-control" value="<?php echo $product->model; ?>"
                                                   id="modelo" value=""
                                                   placeholder="Modelo">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-3 control-label">Serie:</label>
                                        <div class="col-md-8">
                                            <input type="text"
                                                   name="serie" <?php if ($workshop == 1): echo "disabled"; endif; ?>
                                                   value="<?php echo $product->serie; ?>" class="form-control"
                                                   id="serie"
                                                   placeholder="Serie">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-3 control-label">Capacidad:</label>
                                        <div class="col-md-8">
                                            <input type="number"
                                                   name="capacidad" <?php if ($workshop == 1): echo "disabled"; endif; ?>
                                                   value="<?php echo $product->capacity; ?>" class="form-control"
                                                   id="capacidad"
                                                   placeholder="Capacidad">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-3 control-label">Altura:</label>
                                        <div class="col-md-8">
                                            <input type="text"
                                                   name="altura" <?php if ($workshop == 1): echo "disabled"; endif; ?>
                                                   value="<?php echo $product->height; ?>" class="form-control"
                                                   id="altura"
                                                   placeholder="Altura">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-3 control-label">Combustible:</label>
                                        <div class="col-md-8">
                                            <input type="text"
                                                   name="combustible" <?php if ($workshop == 1): echo "disabled"; endif; ?>
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
                                                   name="fechaingreso" <?php if ($workshop == 1): echo "disabled"; endif; ?>
                                                   value="<?php echo $product->admissiondate; ?>" class="form-control"
                                                   id="fechaingreso"
                                                   placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-3 control-label">Horometro:</label>
                                        <div class="col-md-8">
                                            <input type="text"
                                                   name="horometro" <?php if ($workshop == 1): echo "disabled"; endif; ?>
                                                   class="form-control" value="<?php echo $product->horometer; ?>"
                                                   id="horometro"
                                                   placeholder="Horometro">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-3 control-label">Observacion:</label>
                                        <div class="col-md-8">
                                            <input type="text"
                                                   name="observacion" <?php if ($workshop == 1): echo "disabled"; endif; ?>
                                                   class="form-control" value="<?php echo $product->observation; ?>"
                                                   id="observacion"
                                                   placeholder="observacion">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-3 control-label">Tipo</label>
                                        <div class="col-md-8">
                                            <select name="tipo"
                                                    class="form-control" <?php if ($workshop == 1): echo "disabled"; endif; ?>>
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

                                                <?php endif; ?>


                                            </select></div>
                                    </div>


                                    <div class="form-group" style="display:none;">
                                        <label for="inputEmail1" class="col-lg-3 control-label">Renta</label>
                                        <div class="col-md-8">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="is_rent" <?php if ($product->is_rent) {
                                                        echo "checked";
                                                    } ?>>
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
                                                    } ?>>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <?php if ($workshop != 1): ?>
                                        <hr>
                                        <h1 style="width: 100%; text-align: center;">Reparaciones</h1>
                                        <br>
                                        <div class="form-group">
                                            <div class="col-lg-offset-3 col-lg-8">
                                                <input type="hidden" name="product_id"
                                                       value="<?php echo $product->id; ?>">
                                                <button type="submit" class="btn btn-success">Actualizar Producto
                                                </button>
                                                <a href="./?view=products" class="btn btn-danger">Regresar</a>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                    <?php endif; ?>
                                </form>
                                <?php if($workshop):?>
                                <div class="row">
                                    <div class="col-md-2"></div>
                                <form class="form-horizontal col-md-4" method="post" id="addproduct"
                                      enctype="multipart/form-data" action="" role="form">

                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-3 control-label">Reparación:</label>
                                        <div class="col-md-8">
                                            <input type="text"
                                                   name="reparation"
                                                   class="form-control"
                                                   id="reparation"
                                                   placeholder="Reparación">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail1" class="col-lg-3 control-label">Horas consumidas:</label>
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
                                            <button type="button" onclick="insertReparation()" id="addrep" class="btn btn-success">Agregar
                                            </button>
                                        </div>
                                    </div>

                                </form>

                                </div>
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-8">
                                        <table class="table table-sm">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Reparación</th>
                                                <th scope="col">Horas consumidas</th>
                                                <th scope="col">Borrar</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php if(empty($lista)):?>

                                                <tr>
                                                    <td></td>
                                                    <td style="font-weight: bolder;">Aún no se han realizado reparaciones.</td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            <?php else:?>
                                            <?php foreach ($lista as $l): ?>

                                            <tr>
                                                <th scope="row"><?php echo $l->id;?></th>
                                                <td><?php echo $l->reparation;?></td>
                                                <td><?php echo $l->hours;?> Hrs.</td>
                                                <td><a class="btn btn-xs btn-danger" onclick="deleteReparation(<?php echo $l->id;?>)"><i class="fa fa-trash"></i></a></td>
                                            </tr>

                                            <?php endforeach;?>
                                            <?php endif;?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-2"></div>

                                </div>
                                    <hr>
                                    <h1 style="width: 100%; text-align: center;">Refacciones</h1>
                                    <br>
                                <div class="row">
                                <div class="col-md-2"></div>
                                    <form class="form-horizontal col-md-4" method="post" id="addproduct"
                                          enctype="multipart/form-data" action="index.php?view=" role="form">

                                        <div class="form-group">
                                            <label for="inputEmail1" class="col-lg-3 control-label">Refacción:</label>
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
                                                <button type="button"  id="addref" class="btn btn-success">Agregar
                                                </button>
                                            </div>
                                        </div>

                                    </form>
                                </div>

                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-8">
                                            <table class="table table-sm">
                                                <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Refacción</th>
                                                    <th scope="col">Borrar</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php if($list2 == ""):?>

                                                    <tr>
                                                        <td></td>
                                                        <td style="font-weight: bolder;">Aún no se han agregado refacciones.</td>
                                                        <td></td>
                                                    </tr>
                                                <?php else:?>
                                                    <?php foreach ($list2 as $l): ?>

                                                        <tr>
                                                            <th scope="row"><?php echo $l->id;?></th>
                                                            <td><?php echo $l->refaction;?></td>
                                                            <td><a class="btn btn-xs btn-danger" onclick="deleteRefaction(<?php echo $l->id;?>)"><i class="fa fa-trash"></i></a></td>
                                                        </tr>

                                                    <?php endforeach;?>
                                                <?php endif;?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-2"></div>

                                    </div>
                                    <div class="col-md-2"></div>
                                    <a href="./?view=products" class="btn btn-danger">Regresar</a>


                                <?php endif;?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    <?php endif; ?>
</section>
<script src="/application/core/app/assets/refactions.js"></script>
<script src="/application/core/app/assets/alertify.js"></script>
