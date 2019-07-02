<?php
require '../model/Conection.php';
$id = $_POST['id'];
$rep = R::load('products_images', (int) $id);
R::trash($rep);
?>