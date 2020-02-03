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
				$("#desc").empty().append(utf8_decode( data.elemento.description.toUpperCase()));
				$("#rowproductos").append(data.list);
				$("#capacidad").empty().append(data.elemento.capacity);
				$("#altura").empty().append(data.elemento.height);
				$("#combustible").empty().append(data.elemento.fuel);

			}
		});
});
function utf8_decode (strData) { 
  var tmpArr = []
  var i = 0
  var c1 = 0
  var seqlen = 0

  strData += ''

  while (i < strData.length) {
    c1 = strData.charCodeAt(i) & 0xFF
    seqlen = 0

    // https://en.wikipedia.org/wiki/UTF-8#Codepage_layout
    if (c1 <= 0xBF) {
      c1 = (c1 & 0x7F)
      seqlen = 1
    } else if (c1 <= 0xDF) {
      c1 = (c1 & 0x1F)
      seqlen = 2
    } else if (c1 <= 0xEF) {
      c1 = (c1 & 0x0F)
      seqlen = 3
    } else {
      c1 = (c1 & 0x07)
      seqlen = 4
    }

    for (var ai = 1; ai < seqlen; ++ai) {
      c1 = ((c1 << 0x06) | (strData.charCodeAt(ai + i) & 0x3F))
    }

    if (seqlen === 4) {
      c1 -= 0x10000
      tmpArr.push(String.fromCharCode(0xD800 | ((c1 >> 10) & 0x3FF)))
      tmpArr.push(String.fromCharCode(0xDC00 | (c1 & 0x3FF)))
    } else {
      tmpArr.push(String.fromCharCode(c1))
    }

    i += seqlen
  }

  return tmpArr.join('')
}
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
