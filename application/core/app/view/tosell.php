
<?php
require '../model/Conection.php';
$product = R::dispense( 'product' );
$alerts = R::dispense('alerts');
$product->status=1;
$product->id=$_POST['id'];
$id=R::store($product);
$alerts->product_id = $_POST['id'];
$alerts->type =3;
$ale=R::store($alerts);

if($id != null){
    echo true;

}else{
    echo false;

}

?>