$( document ).ready(function() {

});
function insertReparation() {
    var reparations = $("#reparation").val();
    var hours = $("#hours").val();
    var product_id = $("#product_id").val();
    if(reparations!= "" && hours !=""){
        $.ajax({
            url:"/application/core/app/view/insertreparations.php",
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
            url:"/application/core/app/view/insertrefactions.php",
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