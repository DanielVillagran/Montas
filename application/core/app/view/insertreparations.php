<?php
require '../model/Conection.php';
$refaction = R::dispense( 'reparations' );
$alerts = R::dispense('alerts');
$refaction->reparation=$_POST['reparations'];
$refaction->hours=$_POST['hours'];
$refaction->product_id=$_POST['product_id'];
$id=R::store($refaction);
$alerts->product_id = $_POST['product_id'];
$alerts->type =2;
$ale=R::store($alerts);

if($id != null){
    echo true;

}else{
    echo false;

}

?>