<?php
require '../model/Conection.php';
$product = R::getAll('SELECT distinct created, id from returns where product_id ='.$_GET['id'] );

$pr = json_encode($product);
echo $pr;
?>
