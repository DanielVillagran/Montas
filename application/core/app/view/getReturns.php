<?php
require '../model/Conection.php';
$product = R::getAll('SELECT r.*, p.* from returns r INNER JOIN product p on p.id = r.product_id where r.id ='.$_GET['id'] );

$pr = json_encode($product);
echo $pr;
?>
