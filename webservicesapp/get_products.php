<?php

require 'conexion.php';

$url = "application/storage/products/monta.jpg";
if ($_POST['product'] != '') {
	$lista = R::find("product", "name like '%{$_POST['product']}%'");
} else {
	$lista = R::find("product", "is_active=1 AND is_rent=" . $_POST['is_rent']);
}

$products['list'] = "";
$products['status'] = true;
$server = "http://brayammorando.com/Chaps/storage/products/";
foreach ($lista as $key) {
	$products['list'] .= ' <div class="col-lg-3 col-md-6">
                    <div class="item text-center mb-sm50">
                        <div class="img-overlay bg-img" data-overlay-dark="7" data-background="img/services-strategy.jpg"></div>
                        <img class="img-services" src="' . $url . '" alt="">
                        <h6>' . $key['name'] . ' ' . $key['model'] . ' ' . $key['serie'] . '</h6>
                        <p>' . $key['description'] . '</p>
                    </div>
                </div>';

}

echo json_encode($products);
?>