<?php
require '../model/Conection.php';
$id = $_POST['id'];
$costo = $_POST['cost'];
$rep = R::dispense('refactions');
$rep->cost = $costo;
$rep->id = $id;
$res=R::store($rep);
if(isset($res)){
  $result =true;
}
  echo $result;

?>
