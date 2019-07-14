<section class="content">
    <?php

    $categories = CategoryData::getAll();

    ?>
    <div class="row">
        <div class="col-md-12">
            <h1>Nuevo Producto</h1>
            <br>
            <div class="box box-primary">
                <table class="table">
                    <tr>
                        <td>
                            <form class="form-horizontal" method="post" enctype="multipart/form-data" id="addproduct"
                                  action="index.php?view=addproduct" role="form">

                                <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 control-label">Imagen</label>
                                    <div class="col-md-6">
                                        <input type="file" onchange="validarArchivos()" multiple="" name="image[]" id="image[]" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group" style="display: none;">
                                    <label for="inputEmail1" class="col-lg-2 control-label">Codigo de Barras*</label>
                                    <div class="col-md-6">
                                        <input type="text" name="barcode" id="product_code" class="form-control"
                                               id="barcode" placeholder="Codigo de Barras del Producto">
                                    </div>
                                </div>
                                <div class="form-group" style="display: none;">
                                    <label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
                                    <div class="col-md-6">
                                        <input type="text" name="name"  class="form-control" id="name"
                                               placeholder="Nombre del Producto">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 control-label">Categoria</label>
                                    <div class="col-md-6">
                                        <select name="category_id" required class="form-control">
                                            <option value="">-- NINGUNA --</option>
                                            <?php foreach ($categories as $category): ?>
                                                <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                                            <?php endforeach; ?>
                                        </select></div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 control-label">Descripcion</label>
                                    <div class="col-md-6">
                                        <textarea required name="description" class="form-control" id="description"
                                                  placeholder="Descripcion del Producto"></textarea>
                                    </div>
                                </div>
                                <div class="form-group" style="display: none;">
                                    <label for="inputEmail1" class="col-lg-2 control-label">Precio de Entrada*</label>
                                    <div class="col-md-6">
                                        <input type="text" name="price_in"  class="form-control" id="price_in"
                                               placeholder="Precio de entrada">
                                    </div>
                                </div>
                                <div class="form-group" style="display: none;">
                                    <label for="inputEmail1" class="col-lg-2 control-label">Precio de Salida*</label>
                                    <div class="col-md-6">
                                        <input type="text" name="price_out"  class="form-control" id="price_out"
                                               placeholder="Precio de salida">
                                    </div>
                                </div>
                                <div class="form-group" style="display: none;">
                                    <label for="inputEmail1" class="col-lg-2 control-label">Unidad*</label>
                                    <div class="col-md-6">
                                        <input type="text" name="unit" class="form-control" id="unit" value="l"
                                               placeholder="Unidad del Producto">
                                    </div>
                                </div>

                                <div class="form-group" style="display: none;">
                                    <label for="inputEmail1" class="col-lg-2 control-label">Presentacion</label>
                                    <div class="col-md-6">
                                        <input type="text" name="presentation" class="form-control" id="inputEmail1"
                                               placeholder="Presentacion del Producto">
                                    </div>
                                </div>
                                <div class="form-group" style="display: none;">
                                    <label for="inputEmail1" class="col-lg-2 control-label">Minima en
                                        inventario:</label>
                                    <div class="col-md-6">
                                        <input type="text" name="inventary_min" class="form-control" value="0"
                                               id="inputEmail1" placeholder="Minima en Inventario (Default 10)">
                                    </div>
                                </div>

                                <div class="form-group" style="display: none;">
                                    <label for="inputEmail1" class="col-lg-2 control-label">Inventario inicial:</label>
                                    <div class="col-md-6">
                                        <input type="text" name="q" class="form-control" id="inputEmail1" value="1"
                                               placeholder="Inventario inicial">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 control-label">Modelo:</label>
                                    <div class="col-md-6">
                                        <input type="text" required name="modelo" class="form-control" id="modelo" value=""
                                               placeholder="Modelo">
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <label for="inputEmail1" class="col-lg-2 control-label">Serie:</label>
                                    <div class="col-md-6">
                                        <input type="text" required name="serie" class="form-control" id="serie"
                                               placeholder="Serie">
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <label for="inputEmail1" class="col-lg-2 control-label">Capacidad:</label>
                                    <div class="col-md-6">
                                        <input type="text" required name="capacidad" class="form-control" id="capacidad"
                                               placeholder="Capacidad">
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <label for="inputEmail1" class="col-lg-2 control-label">Altura:</label>
                                    <div class="col-md-6">
                                        <input type="text" required name="altura" class="form-control" id="altura"
                                               placeholder="Altura">
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <label for="inputEmail1" class="col-lg-2 control-label">Combustible:</label>
                                    <div class="col-md-6">
                                        <input required type="text" name="combustible" class="form-control" id="combustible"
                                               placeholder="Combustible">
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <label for="inputEmail1" class="col-lg-2 control-label">Fecha de ingreso:</label>
                                    <div class="col-md-6">
                                        <input type="date" value="<?php echo date('Y-m-d')?>" name="fechaingreso" class="form-control" id="fechaingreso"
                                               placeholder="">
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <label for="inputEmail1" class="col-lg-2 control-label">Horometro:</label>
                                    <div class="col-md-6">
                                        <input type="text" required name="horometro" class="form-control" id="horometro"
                                               placeholder="Horometro">
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <label for="inputEmail1" class="col-lg-2 control-label">Observacion:</label>
                                    <div class="col-md-6">
                                        <input type="text" required name="observacion" class="form-control" id="observacion"
                                               placeholder="observacion">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 control-label">Tipo</label>
                                    <div class="col-md-6">
                                        <select required name="tipo" class="form-control">
                                            <option value="">-- NINGUNA --</option>
                                                <option value="Venta">Venta</option>
                                                <option value="Renta">Renta</option>
                                                <option value="Servicio">Servicio</option>
                                        </select></div>
                                </div>


                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button type="submit" class="btn btn-primary">Agregar Producto</button>
                                    </div>
                                </div>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <script>
        function validarArchivos() {
            var files = document.getElementById('image[]');
            if (files.files.length > 6) {
                files.value = '';
                alert('Por favor, seleccione 6 o menos archivos para enviar como evidencia');
            }
            for (var i = 0; i <= files.files.length - 1; i++) {

                var fsize = files.files.item(i).size;      // THE SIZE OF THE FILE.

            }
            if (fsize > 4000000) {
                files.value = '';
                alert('No se pueden subir archivos con pesos mayores a 4MB');
            }

        }
        $(document).ready(function () {
            $("#product_code").keydown(function (e) {
                if (e.which == 17 || e.which == 74) {
                    e.preventDefault();
                } else {
                    console.log(e.which);
                }
            })
        });

    </script>
</section>