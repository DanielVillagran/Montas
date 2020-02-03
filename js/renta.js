var server="http://vmcomp.com.mx/montacargas";
//server="";
var monta="";
$(document).ready(function(){
	monta=window.location.href.split("montcarga=")[1];	
	$.ajax({
		url: server+"/webservicesapp/get_product_info.php",
		type: "POST",
		data: {"product":monta ,
				"is_rent":1},
		dataType: "json",
		beforeSend: function() {
		},
		success: function(data) {
			//swal.close();
				//console.log(data);
				console.log(data);
				$("#producto").empty().append(data.elemento.name.toUpperCase()+" "+data.elemento.model.toUpperCase()
					+" "+data.elemento.serie.toUpperCase());
				$("#desc").empty().append(data.elemento.description.toUpperCase());
				$("#rowproductos").append(data.list);
				$("#capacidad").empty().append(data.elemento.capacity);
				$("#altura").empty().append(data.elemento.height);
				$("#combustible").empty().append(data.elemento.fuel);

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
