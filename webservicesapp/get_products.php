<?php

require 'conexion.php';

$url = "application/storage/products/monta.jpg";
if ($_POST['product'] != '') {
	$lista = R::find("product", "name like '%{$_POST['product']}%'");
} else {
	$lista = R::find("product", " is_active=1 AND is_rent=" . $_POST['is_rent']);
}
//"is_active=1 AND is_rent=" . $_POST['is_rent']

$products['list'] = "";
$products['status'] = true;
$server = "http://brayammorando.com/Chaps/storage/products/";
$contador = 1;
foreach ($lista as $key) {
	$elemento = false;
	$elemento = R::getAll("SELECT * from products_images where product_id='" . $key['serie'] . "' order by principal desc,id desc limit 1");
	//var_dump($elemento);

	//$elemento = R::convertToBeans('myResult', $result);
	//var_dump($elemento[0]['ima']);
	if ($elemento) {
		$key['image'] = "application/storage/products/" . $elemento[0]['img'];
	} else {
		$key['image'] = $url;
	}
	if ($contador == 1) {
		$products['list'] .= '<div class="row">';
	}
	if (sizeof($key['description']) > 100) {
		$key['description'] = substr($key['description'], 0, 97) . "...";
	}
	$products['list'] .= ' <div class="col-lg-3 col-md-6" onclick="window.location.href=\'renta.html?montcarga=' . $key['id'] . '\'">
                    <div class="item text-center mb-sm50" style="height:100% !important;">
                        <div class="img-overlay bg-img" data-overlay-dark="7" data-background="img/services-strategy.jpg"></div>
                        <img class="img-services" src="' . $key['image'] . '" alt="">
                        <h6>' . $key['name'] . ' ' . $key['model'] . ' <br>' . $key['serie'] . '</h6>
                        <p>' . str_pad($key['description'], 100, "  ") . '</p>
                    </div>
                </div>';

	if ($contador % 4 == 0) {
		$products['list'] .= '</div><br><div class="row">';
	}
	$contador++;

}

echo json_encode($products);
?>