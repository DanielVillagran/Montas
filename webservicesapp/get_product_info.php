<?php

require 'conexion.php';

$url = "application/storage/products/monta.jpg";
if ($_POST['product'] != '') {
	$lista = R::find("product", "id = {$_POST['product']}");
} else {
	$lista = R::find("product", "is_active=1 AND is_rent=" . $_POST['is_rent']);
}

$products['list'] = "";
$products['status'] = true;
$server = "http://brayammorando.com/Chaps/storage/products/";
foreach ($lista as $key) {
	$products['elemento'] = $key;
	$elemento = false;
	$elemento = R::getAll("SELECT * from products_images where product_id='" . $key['serie'] . "' order by id desc");
	$carousel = "";
	$flag = true;
	$clas = "";
	$listeishon = "";
	$contador = 0;
	foreach ($elemento as $auxiliar) {

		if ($auxiliar['img'] != null) {
			if ($flag) {
				$clas = "active";
				$flag = false;
			}
			$carousel .= '<div class="carousel-item ' . $clas . '">
    <img class="" style="width:40%;" src="application/storage/products/' . $auxiliar['img'] . '" alt="' . $key['serie'] . '">
    </div>';
			$listeishon .= '<li data-target="#carouselExampleControls" data-slide-to="' . $contador . '" class="' . $clas . '"></li>';
			$clas = "";
			$contador++;
		}

	}
	$products['list'] .= ' <div class="col-lg-12 col-md-12">
    <div class="item text-center mb-sm100">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
     <ol class="carousel-indicators">
      ' . $listeishon . '
      </ol>

    <div class="carousel-inner">
    ' . $carousel . '
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
    </div>
    </div>
    </div>';

}

echo json_encode($products);
?>