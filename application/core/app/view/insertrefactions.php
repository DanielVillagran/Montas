<?php
require '../model/Conection.php';
$refaction = R::dispense( 'refactions' );
$refaction->refaction=$_POST['refaction'];
$refaction->product_id=$_POST['product_id'];
$id=R::store($refaction);

if($id != null){
    echo true;

}else{
    echo false;

}

?>
