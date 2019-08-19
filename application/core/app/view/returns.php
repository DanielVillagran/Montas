<?php
require '../model/Conection.php';
$return = R::dispense( 'returns' );
$return->marca = $_POST['marca'];
$return->modelo = $_POST['modelo'];
$return->serie = $_POST['serie'];

$id = R::store($return);
?>
