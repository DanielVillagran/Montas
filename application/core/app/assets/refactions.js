$( document ).ready(function() {

});
function insertReparation() {
    var reparations = $("#reparation").val();
    var hours = $("#hours").val();
    var product_id = $("#product_id").val();
    if(reparations!= "" && hours !=""){
        $.ajax({
            url:"../application/core/app/view/insertreparations.php",
            type:'POST',
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
    }else{
        alertify.error('Por favor, ingrese valores a los campos');

    }


}
$('#addref').one('click', function () {
     var refaction = $("#refaction").val();
    var product_id = $("#product_id").val();



    if(refaction!= ""){
        console.log("entro");
        $.ajax({
            url:"../application/core/app/view/insertrefactions.php",
            type:'POST',
            data: {
                'refaction': refaction,
                'product_id': product_id,

            },
            success(data) {
                alertify.success('Se agrego correctamente.');
                location.reload();
            }




        });
    }else{
        alertify.error('Por favor, ingrese valores a los campos');

    }

});




function deleteReparation(id){
    alertify.confirm('Desea eliminar el registro?', 'Si lo elimina, no se podrá recuperar', function(){

            $.ajax({
                url:"../application/core/app/view/deleterefactions.php",
                type:'POST',
                data: {
                    'id': id,

                },
                success(data) {
                    alertify.success('Registro eliminado') ;
                    location.reload();
                }
            });


        }
        , function(){ alertify.error('No se realizo ninguna acción.')});

}
function validateFiles(qty) {
    var files = document.getElementById('image[]');
    var cargados = files.files.length;

    if(cargados+ qty > 6){
        alertify.error('No se pueden cargar mas de 6 imágenes.')
        files.value = '';
    }else{

    }
}
function addCostReparation(){
  var costos = $('.costoR').map(function() {
    return [[this.id, this.value]];
}).get();

$.each(costos, function( index, value ) {
  let idtxt = value[0];
  let id = idtxt.replace("costoR_", "");
  let costo = value[1];

  $.ajax({
      url:"../application/core/app/view/updateCostReparations.php",
      type:'POST',
      data: {
          'id': id,
          'cost': costo,

      },
      success(data) {
          alertify.success('Costos agregados') ;
          location.reload();
      }
  });

});


}
function addCostRefaction(){
  var costos = $('.costoF').map(function() {
    return [[this.id, this.value]];
}).get();

$.each(costos, function( index, value ) {
  let idtxt = value[0];
  let id = idtxt.replace("costoF_", "");
  let costo = value[1];

  $.ajax({
      url:"../application/core/app/view/updateCostRefactions.php",
      type:'POST',
      data: {
          'id': id,
          'cost': costo,

      },
      success(data) {
          alertify.success('Costos agregados') ;
          location.reload();
      }
  });

});


}
function deleteImage(id){
    alertify.confirm('Desea eliminar la imagen?', 'Si la elimina, no se podrá recuperar', function(){

            $.ajax({
                url:"../application/core/app/view/deleteImage.php",
                type:'POST',
                data: {
                    'id': id,

                },
                success(data) {
                    alertify.success('Imagen eliminada') ;
                    location.reload();
                }
            });


        }
        , function(){ alertify.error('No se realizo ninguna acción.')});

}
function deleteAllImage(id){
    alertify.confirm('Desea eliminar todas las imagenes?', 'Si las elimina, no se podrán recuperar', function(){

            $.ajax({
                url:"../application/core/app/view/deleteAllImage.php",
                type:'POST',
                data: {
                    'id': id,

                },
                success(data) {
                    alertify.success('Imagenes eliminadas') ;
                    location.reload();
                }
            });


        }
        , function(){ alertify.error('No se realizo ninguna acción.')});

}
function deleteRefaction(id){
    alertify.confirm('Desea eliminar el registro?', 'Si lo elimina, no se podrá recuperar', function(){

            $.ajax({
                url:"../application/core/app/view/deleterefactions.php",
                type:'POST',
                data: {
                    'id': id,

                },
                success(data) {
                    alertify.success('Registro eliminado') ;
                    location.reload();
                }
            });


        }
        , function(){ alertify.error('No se realizo ninguna acción.')});

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

          if(val != ''){

            $.ajax({
                url: "../application/core/app/view/toactive.php",
                type: 'GET',
                data: {
                    'id': id,
                    'val' : val

                },
                success(data) {
                    alertify.success('Se activó correctamente.');
                    location.reload();
                }




            });
          }else{
              alertify.error('El valor no puede ser vacio.')
          }
        },
        function () {
            alertify.error('No se realizo ninguna acción.')
        });

}
