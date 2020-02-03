var server="http://vmcomp.com.mx/montacargas";
//server="";

$(document).ready(function(){
	console.log("Esta perrada");
	
	$.ajax({
		url: server+"/webservicesapp/get_products.php",
		type: "POST",
		data: {"product": "",
				"is_rent":0},
		dataType: "json",
		beforeSend: function() {
			console.log("Que desmadre");
		},
		success: function(data) {
			//swal.close();
				//console.log(data);
				console.log(data);
				$("#rowproductos").append(data.list);
			}
		});
});
$("#buscar").keyup(function(event){
	$.ajax({
		url: server+"/webserviceapp/get_products.php",
		type: "POST",
		data: {"product": $("#buscar").val()},
		dataType: "json",
		beforeSend: function() {
			swal({
				title: "Cargando",
				showConfirmButton: false,
				imageUrl: "/images/loader.gif"
			});
		},
		success: function(data) {
				//console.log(data);
				swal.close();
				console.log(data);
				$("#rowproductos").empty().append(data.list);
			}
		});

});

function addCommas(nStr) {
	nStr += '';
	var x = nStr.split('.');
	var x1 = x[0];
	var x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}
