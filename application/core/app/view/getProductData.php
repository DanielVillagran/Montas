<?php
require '../model/Conection.php';
$product = R::getAll('SELECT p.*, r.* FROM product p inner join rent r on r.product_id = p.id WHERE r.status = 1 and p.id ='.$_GET['id']);

$pr = json_encode($product);
echo $pr;
?>
