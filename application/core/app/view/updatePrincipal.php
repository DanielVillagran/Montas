<?php
require '../model/Conection.php';
$id = $_POST['id'];
$serie = $_POST['serie'];
$lista = R::exec("UPDATE products_images  set principal=0 where product_id='" . $_POST['serie']."'");
$lista = R::exec("UPDATE products_images  set principal=1 where id=" . $_POST['id']);
?>