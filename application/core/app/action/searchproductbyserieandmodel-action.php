<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.4/build/alertify.min.js"></script>
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.4/build/css/alertify.min.css"/>
<?php


?>

<?php if ((isset($_GET["product_name"]) && $_GET["product_name"] != "") || (isset($_GET["product_code"]) && $_GET["product_code"] != "")): ?>
    <?php
    $go = $_GET["go"];
    $search = "";
    if ($go == "code") {
        $search = $_GET["product_code"];
    } else if ($go == "name") {
        $search = $_GET["product_name"];
    }
    $products = ProductData::getLikeSerie($search);
    if (count($products) > 0) {
        ?>
        <h3>Resultados de la Busqueda</h3>
        <div class="box box-primary">
            <table class="table table-bordered table-hover">
                <thead>
                <th>Codigo</th>
                <th>Serie</th>
                <th>Modelo</th>
                <th>Disponible</th>
                <th></th>
                </thead>
                <?php
                $products_in_cero = 0;
                foreach ($products as $product):
//$q= OperationData::getQByStock($product->id,StockData::getPrincipal()->id);
                    ?>
                    <?php
                    if (true):?>

                        <tr class="<?php if ($product->is_rent == 1) {
                            echo "danger";
                        } ?>">
                            <td style="width:80px;"><?php echo $product->id; ?></td>
                            <td><?php echo $product->serie; ?></td>
                            <td><?php echo $product->model; ?></td>
                            <td>
                                <?php if ($product->is_rent == 1): ?>
                                    <span><i class="fa fa-ban"></i></span>

                                <?php else: ?>
                                    <span><i class="fa fa-check-circle-o"></i></span>

                                <?php endif; ?>


                            </td>
                            <td style="">
                                <?php if ($product->is_rent == 0): ?>
                                    <input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                            data-target="#exampleModalCenter_<?php echo $product->id; ?>">Rentar
                                    </button>
                                <?php else: ?>
                                    <form method="post" action="index.php?view=addtocart">
                                        <input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
                                        <button type="button" onclick="devolver(<?php echo $product->id; ?>)"
                                                class="btn btn-warning">Recibir
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>

                    <?php else:$products_in_cero++;
                        ?>
                    <?php endif; ?>

                    <div class="modal fade" id="exampleModalCenter_<?php echo $product->id; ?>" tabindex="-1"
                         role="dialog"
                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle"><h3>Datos del cliente</h3></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" id="formrent" action="">
                                        <input type="hidden" id="product_id" value="<?php echo $product->id; ?>">
                                        <label for="">Nombre del cliente</label>
                                        <input type="text" class="form-control" name="name"
                                               id="name_<?php echo $product->id; ?>" placeholder="Nombre"><br>
                                        <label for="">Teléfono</label>

                                        <input type="text" class="form-control" name="phone"
                                               id="phone_<?php echo $product->id; ?>" placeholder="Teléfono"><br>
                                        <label for="">Dirección</label>

                                        <input type="text" class="form-control" id="address_<?php echo $product->id; ?>"
                                               name="address"
                                               placeholder="Dirección"><br>
                                        <label for="">Tipo de renta</label>
                                        <select name="" id="rent_type_<?php echo $product->id; ?>"
                                                onchange="showHide(<?php echo $product->id; ?>)"
                                                class="form-control select">
                                            <option value="">Seleccione un tipo de renta</option>
                                            <option value="1">Indefinido</option>
                                            <option value="3">Por mes</option>
                                            <option value="2">Por fecha</option>
                                        </select>
                                        <br>
                                        <div id="meses_<?php echo $product->id; ?>" style="display: none;">
                                            <label for="">Cantidad de meses</label>
                                            <input type="number" onkeyup="setTotal(<?php echo $product->id; ?>)"
                                                   id="mes_<?php echo $product->id; ?>" placeholder="Numero de meses"
                                                   class="form-control">
                                        </div>
                                        <br>
                                        <div id="costos_<?php echo $product->id; ?>" style="display: none;">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="" id="label">Costo por día</label>
                                                    <input type="number" id="costo_<?php echo $product->id; ?>"
                                                           onkeyup="setTotal(<?php echo $product->id; ?>)"
                                                           placeholder="Costo por dia" class="form-control">

                                                </div>
                                                <div class="col-md-6">

                                                    <label for="">Costo de flete</label>
                                                    <input type="number" id="flete_<?php echo $product->id; ?>"
                                                           onkeyup="setTotal(<?php echo $product->id; ?>)"
                                                           placeholder="Flete" class="form-control">
                                                </div>
                                            </div>

                                        </div>
                                        <br>

                                        <div id="fecha_<?php echo $product->id; ?>" class="fecha"
                                             style="display: none;">
                                            <label for="">Fecha de renta</label><br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="">Desde</label>
                                                    <input id="f_start_<?php echo $product->id; ?>" onchange="setTotal(<?php echo $product->id; ?>)" type="date"></div>
                                                <div class="col-md-6">
                                                    <label for="">Hasta</label>
                                                    <input id="f_end_<?php echo $product->id; ?>" onchange="setTotal(<?php echo $product->id; ?>)"  type="date"></div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="row">
                                                <div class="col-md-9"></div>
                                                <div class="col-md-3">
                                                    <label for="">Total</label>
                                                    <input type="text"  readonly class="form-control"
                                                           id="total_<?php echo $product->id; ?>">
                                                </div>
                                            </div>
                                        </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar
                                    </button>
                                    <button type="button" id="rent" onclick="sendForm(<?php echo $product->id; ?>)"
                                            class="btn btn-primary">Rentar
                                    </button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </table>

        </div>
        <?php if ($products_in_cero > 0) {
            echo "<p class='alert alert-warning'>Se omitieron <b>$products_in_cero productos</b> que no tienen existencias en el inventario. <a href='index.php?view=inventary&stock=" . StockData::getPrincipal()->id . "'>Ir al Inventario</a></p>";
        } ?>

        <?php
    } else {
        echo "<br><p class='alert alert-danger'>No se encontro el producto</p>";
    }
    ?>
    <hr><br>
<?php else:
    ?>
<?php endif; ?>
<script src="../application/core/app/assets/alertify.js"></script>

<script>
    $("#rent").attr("disabled", true);
    function showHide(id) {
        if ($('#rent_type_' + id).val() == 2) {
            $('#fecha_' + id).show();
            $('#costos_' + id).show();
            $('#mes_' + id).val('');
            $('#flete_' + id).val('');
            $('#meses_' + id).hide();

            $('#costo_' + id).val('');
            $('#total_' + id).val('');
            $('#f_start_' + id).val('');
            $('#f_end_' + id).val('');
            $('#label').text('Costo por dia');



        } else if ($('#rent_type_' + id).val() == 1) {
            $('#fecha_' + id).hide();
            $('#costos_' + id).show();
            $('#meses_' + id).hide();
            $('#mes_' + id).val('');
            $('#flete_' + id).val('');
            $('#costo_' + id).val('');
            $('#total_' + id).val('');
            $('#f_start_' + id).val('');
            $('#f_end_' + id).val('');
            $('#label').text('Costo por mes');


        } else {
            $('#fecha_' + id).hide();
            $('#costos_' + id).show();
            $('#meses_' + id).show();
            $('#mes_' + id).val('');
            $('#flete_' + id).val('');
            $('#costo_' + id).val('');
            $('#total_' + id).val('');
            $('#f_start_' + id).val('');
            $('#f_end_' + id).val('');
            $('#label').text('Costo por mes');


        }


    }

    function setTotal(id) {


        var meses = $('#mes_' + id).val();
        var flete = $('#flete_' + id).val();
        var costo = $('#costo_' + id).val();
        if (flete == '') {
            flete = 0.0;
        }
        if (costo == '') {
            costo = 0.0;
        }
        if (meses == '') {
            meses = 1;
        }


        var f_start = $('#f_start_' + id).val();
        var f_end = $('#f_end_' + id).val();

var total;
        if(f_start != '' && f_end != ''){
            var d1 = f_start.split("-");
            var d2 = f_end.split("-");
            var total;

            var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
            var firstDate = new Date(f_start);
            var secondDate = new Date(f_end);


            var diffDays = Math.round(Math.abs((firstDate.getTime() - secondDate.getTime())/(oneDay)));
            console.log(diffDays);

            // if(d2[2] < d1[2]){
            //     alert("La fecha de fin no puede ser menor a la fecha de inicio");
            //     $('#f_start_' + id).val('');
            //     $('#f_end_' + id).val('');
            // }else{
            //
            // }
            // if(d1[2] == d2[2]){
            //     dias  = 1;
            // }else{
            //     dias = d2[2] - d1[2];
            // }

            if(firstDate > secondDate){
                alertify.error('La fecha de fin no puede ser menor a la fecha de inicio');
                $('#f_start_' + id).val('');
                $('#f_end_' + id).val('');


            }else{
                total = parseInt(diffDays) * (parseFloat(flete) + parseFloat(costo));

            }


        }else{
            total = parseInt(meses) * (parseFloat(flete) + parseFloat(costo));
        }






        $('#total_' + id).val(total);
        if($('#total_' + id).val() != '' && $('#total_' + id).val() != 0 ){
            $('#rent').removeAttr("disabled");

        }
    }

    // $('#fecha').on('change', function () {
    //     if ($('.select').val() == 2) {
    //     } else {
    //         $('.fecha').hide();
    //     }
    // })

    function sendForm(p) {

        var nombre = $('#name_' + p).val();
        var direccion = $('#address_' + p).val();
        var telefono = $('#phone_' + p).val();
        var tipo = $('#rent_type_' + p).val();
        var p_id = $('#product_id').val();
        var f_start = $('#f_start_' + p).val();
        var f_end = $('#f_end_' + p).val();
        var total = $('#total_' + p).val();


        // if($('#f_start')){
        //     f_start = $('#f_start').val();
        // }else{
        //
        // }
        // if($('#f_end')){
        //    f_end  = $('#f_end').val();
        // }else{
        //
        // }

        if (tipo == 2) {
            console.log('ebtra vacui');
            $.ajax({
                url: "../application/core/app/view/rent.php",
                type: 'GET',
                data: {
                    'product_id': p,
                    'nombre': nombre,
                    'direccion': direccion,
                    'telefono': telefono,
                    'tipo': tipo,
                    'f_start': f_start,
                    'f_end': f_end,
                    'total': total

                },
                success(data) {
                    console.log(data);
                    alertify.success('Producto rentado correctamente');

                    //alert(data);
                    location.reload();
                }


            });

        } else {
            console.log('entra lleno')
            $.ajax({
                url: "../application/core/app/view/rent.php",
                type: 'GET',
                data: {
                    'product_id': p,
                    'nombre': nombre,
                    'direccion': direccion,
                    'telefono': telefono,
                    'tipo': tipo,
                    'total': total

                },
                success(data) {
                    console.log(data);
                    alertify.success('Producto rentado correctamente');
                    //alert(data);
                    location.reload();
                }


            });
        }

    }

    function devolver(p_id) {

        alertify.confirm('Desea reactivar el producto?', '',
            function () {

                $.ajax({
                    url: "../application/core/app/view/reactive.php",
                    type: 'GET',
                    data: {
                        'id': p_id

                    },
                    success(data) {
                        $.ajax({
                            url: "../application/core/app/view/returnDate.php",
                            type: 'GET',
                            data: {
                                'id': data

                            },
                            success(data) {
                                alertify.success('Se reactivó correctamente.');
                                console.log(data);
                                location.reload();
                            }


                        });
                        //location.reload();
                    }


                });
            }, function () {
                alertify.error('No se realizo ninguna acción.')
            });

    }

</script>


