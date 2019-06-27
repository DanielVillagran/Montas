<?php
require '../model/Conection.php';
$id = $_POST['id'];
$rep = R::load('refactions', (int) $id);
R::trash($rep);
?>