<?php
require '../model/Conection.php';
$id = $_POST['id'];
$rep = R::load('reparations', (int) $id);
R::trash($rep);
?>