
<?php
require '../model/Conection.php';
$product = R::dispense( 'product' );
$product->is_active=true;
$product->id=$_POST['id'];
$id=R::store($product);

if($id != null){
    echo true;

}else{
    echo false;

}

?>