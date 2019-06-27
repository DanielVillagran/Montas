<?php
require '../model/Conection.php';
$refaction = R::dispense( 'reparations' );
$refaction->reparation=$_POST['reparations'];
$refaction->hours=$_POST['hours'];
$refaction->product_id=$_POST['product_id'];
$id=R::store($refaction);

if($id != null){
    echo true;

}else{
    echo false;

}

?>