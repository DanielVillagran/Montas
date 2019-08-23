$(document).ready(function () {

});

function insertReparation() {
    var reparations = $("#reparation").val();
    var hours = $("#hours").val();
    var product_id = $("#product_id").val();
    if (reparations != "" && hours != "") {
        $.ajax({
            url: "../application/core/app/view/insertreparations.php",
            type: 'POST',
            data: {
                'reparations': reparations,
                'hours': hours,
                'product_id': product_id,

            },
            success(data) {
                alertify.success('Se agrego correctamente.');
                location.reload();
            }


        });
    } else {
        alertify.error('Por favor, ingrese valores a los campos');

    }


}

$('#addref').one('click', function () {
    var refaction = $("#refaction").val();
    var product_id = $("#product_id").val();


    if (refaction != "") {
        console.log("entro");
        $.ajax({
            url: "../application/core/app/view/insertrefactions.php",
            type: 'POST',
            data: {
                'refaction': refaction,
                'product_id': product_id,

            },
            success(data) {
                alertify.success('Se agrego correctamente.');
                location.reload();
            }


        });
    } else {
        alertify.error('Por favor, ingrese valores a los campos');

    }

});


function deleteReparation(id) {
    alertify.confirm('Desea eliminar el registro?', 'Si lo elimina, no se podrá recuperar', function () {

            $.ajax({
                url: "../application/core/app/view/deleterefactions.php",
                type: 'POST',
                data: {
                    'id': id,

                },
                success(data) {
                    alertify.success('Registro eliminado');
                    location.reload();
                }
            });


        }
        , function () {
            alertify.error('No se realizo ninguna acción.')
        });

}

function validateFiles(qty) {
    var files = document.getElementById('image[]');
    var cargados = files.files.length;

    if (cargados + qty > 6) {
        alertify.error('No se pueden cargar mas de 6 imágenes.')
        files.value = '';
    } else {

    }
}

function addCostReparation() {
    var costos = $('.costoR').map(function () {
        return [[this.id, this.value]];
    }).get();

    $.each(costos, function (index, value) {
        let idtxt = value[0];
        let id = idtxt.replace("costoR_", "");
        let costo = value[1];

        $.ajax({
            url: "../application/core/app/view/updateCostReparations.php",
            type: 'POST',
            data: {
                'id': id,
                'cost': costo,

            },
            success(data) {
                alertify.success('Costos agregados');
                location.reload();
            }
        });

    });


}

function addCostRefaction() {
    var costos = $('.costoF').map(function () {
        return [[this.id, this.value]];
    }).get();

    $.each(costos, function (index, value) {
        let idtxt = value[0];
        let id = idtxt.replace("costoF_", "");
        let costo = value[1];

        $.ajax({
            url: "../application/core/app/view/updateCostRefactions.php",
            type: 'POST',
            data: {
                'id': id,
                'cost': costo,

            },
            success(data) {
                alertify.success('Costos agregados');
                location.reload();
            }
        });

    });


}

function deleteImage(id) {
    alertify.confirm('Desea eliminar la imagen?', 'Si la elimina, no se podrá recuperar', function () {

            $.ajax({
                url: "../application/core/app/view/deleteImage.php",
                type: 'POST',
                data: {
                    'id': id,

                },
                success(data) {
                    alertify.success('Imagen eliminada');
                    location.reload();
                }
            });


        }
        , function () {
            alertify.error('No se realizo ninguna acción.')
        });

}

function deleteAllImage(id) {
    alertify.confirm('Desea eliminar todas las imagenes?', 'Si las elimina, no se podrán recuperar', function () {

            $.ajax({
                url: "../application/core/app/view/deleteAllImage.php",
                type: 'POST',
                data: {
                    'id': id,

                },
                success(data) {
                    alertify.success('Imagenes eliminadas');
                    location.reload();
                }
            });


        }
        , function () {
            alertify.error('No se realizo ninguna acción.')
        });

}

function deleteRefaction(id) {
    alertify.confirm('Desea eliminar el registro?', 'Si lo elimina, no se podrá recuperar', function () {

            $.ajax({
                url: "../application/core/app/view/deleterefactions.php",
                type: 'POST',
                data: {
                    'id': id,

                },
                success(data) {
                    alertify.success('Registro eliminado');
                    location.reload();
                }
            });


        }
        , function () {
            alertify.error('No se realizo ninguna acción.')
        });

}

function liberate_product(id) {
    alertify.confirm('Desea terminar el producto?', 'Si lo termina, no se podrán revertir los cambios',
        function () {

            $.ajax({
                url: "../application/core/app/view/tosell.php",
                type: 'POST',
                data: {
                    'id': id

                },
                success(data) {
                    alertify.success('Se terminó correctamente.');
                    location.reload();
                }


            });
        }, function () {
            alertify.error('No se realizo ninguna acción.')
        });

}

function activate_product(id) {
    alertify.prompt('Ingrese el valor del producto', "",
        function (evt, val) {

            if (val != '') {

                $.ajax({
                    url: "../application/core/app/view/toactive.php",
                    type: 'GET',
                    data: {
                        'id': id,
                        'val': val

                    },
                    success(data) {
                        alertify.success('Se activó correctamente.');
                        location.reload();
                    }


                });
            } else {
                alertify.error('El valor no puede ser vacio.')
            }
        },
        function () {
            alertify.error('No se realizo ninguna acción.')
        });

}

function closeAlert(id) {
    $.ajax({
        url: "../application/core/app/view/closeAlert.php",
        type: 'POST',
        data: {
            'id': id

        },
        success(data) {
            location.reload();
        }


    });
}

function closeAlert2(id, pid) {

    $('#modal').modal('show');

    $.ajax({
        url: "../application/core/app/view/getProductData.php",
        type: 'GET',
        data: {
            'id': pid

        },
        success(data) {
            var datos = JSON.parse(data);

            $('#serie').val(datos[0].serie);
            $('#serie').attr('readonly', true);
            $('#modelo').attr('readonly', true);
            $('#marca').attr('readonly', true);
            $('#modelo').val(datos[0].model);
            $('#marca').val(datos[0].name);
            $('#cliente').val(datos[0].cliente_name);
        }


    });
}

function readURL1(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#img1').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
    console.log(input.files[0]);
}

function readURL2(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#img2').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#horom").change(function () {
    console.log(this);
    readURL1(this);
});
$("#equ").change(function () {
    readURL2(this);
});


function createReturn(pid){

    var fd = new FormData();
    fd.append( 'img1', document.getElementById('horom').files[0]);
    fd.append( 'img2', document.getElementById('equ').files[0]);
    fd.append( 'id', pid);
    fd.append( 'cliente', $('#cliente').val());
    fd.append( 'horometro', $('#horo').val());
    fd.append( 'tecnico', $('#tec').val());
    if($('#a1').prop('checked')){
        fd.append( 'a1', true );

    }else{
        fd.append( 'a1', false );

    }
    if($('#a2').prop('checked')){
        fd.append( 'a2', true );

    }else{
        fd.append( 'a2', false );

    }
    if($('#a3').prop('checked')){
        fd.append( 'a3', true );

    }else{
        fd.append( 'a3', false );

    }
    if($('#a4').prop('checked')){
        fd.append( 'a4', true );

    }else{
        fd.append( 'a4', false );

    }
    if($('#a5').prop('checked')){
        fd.append( 'a5', true );

    }else{
        fd.append( 'a5', false );

    }
    fd.append( 'ob1', $('#ob1').val());
    fd.append( 'ob2', $('#ob2').val());
    fd.append( 'ob3', $('#ob3').val());
    fd.append( 'ob4', $('#ob4').val());
    fd.append( 'ob5', $('#ob5').val());

    $.ajax({
        url: "../application/core/app/view/returns.php",
        type: "POST",
        data: fd,
        contentType:false,
        processData:false,
        success: function (data) {

                location.reload();

        }


    });

}
function getHistorial(id){
  $('#historial').modal('show');
  $.ajax({
      url: "../application/core/app/view/getHistorial.php",
      type: "GET",
      data: {"id":id},
      success: function (data) {
        var datos = JSON.parse(data);
      $('#fechas').empty();

for (var i = 0; i < datos.length; i++) {
  $('#fechas').append('<button type="button" style="width:100%; margin-bottom:2%;" class="btn btn-primary" onclick="showDatos('+datos[i].id+')" data-toggle="modal" data-target="#modal">'+datos[i].created+'</button><br> ');

}

      }


  });
}

function showDatos(id){

  $.ajax({
      url: "../application/core/app/view/getReturns.php",
      type: "GET",
      data: {"id":id},
      success: function (data) {
        var datos  = JSON.parse(data);

        $('#modal').modal('show');
for (var i = 0; i < datos.length; i++) {
   $('#marca').val(datos[i].name);
   $('#modelo').val(datos[i].model);
   $('#serie').val(datos[i].serie);
   $('#horo').val(datos[i].horometro);
   $('#cliente').val(datos[i].cliente);

   $('#tec').val(datos[i].tecnico);
   $('#ob1').val(datos[i].obs_ace1);
   $('#ob2').val(datos[i].obs_ace2);
   $('#ob3').val(datos[i].obs_ace3);
   $('#ob4').val(datos[i].obs_r1);
   $('#ob5').val(datos[i].obs_r2);

console.log(datos[i].aceite_motor);
$("#img1").attr("src","storage/products/"+datos[i].img1);
$("#img2").attr("src","storage/products/"+datos[i].img2);





}


      }
  });
}
