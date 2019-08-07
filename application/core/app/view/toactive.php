
<?php
require '../model/Conection.php';
$id = $_GET['id'];
$lista= R::getAll( 'SELECT SUM(cost) AS costo FROM reparations WHERE product_id = '.$id );
$list2= R::getAll( 'SELECT SUM(cost) AS costo FROM refactions WHERE product_id = '.$id );
$reparaciones = $lista[0]['costo'];
$refacciones = $list2[0]['costo'];
$precio = $_GET['val'];
$total = $reparaciones+ $refacciones + $precio;

$product = R::dispense( 'product' );
$alerts = R::dispense('alerts');

$product->is_active=true;
$product->id=$id;
$product->price_out= $total;
$id=R::store($product);
$alerts->product_id = $_POST['id'];
$alerts->type =4;
$ale=R::store($alerts);

if($id != null){
    echo true;

}else{
    echo false;

}

?>
