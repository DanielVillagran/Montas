
<?php
require '../model/Conection.php';
$product = R::dispense( 'product' );
$product->status=1;
$product->id=$_POST['id'];
$id=R::store($product);

if($id != null){
    echo true;

}else{
    echo false;

}

?>