<?php
require '../model/Conection.php';
$return = R::dispense( 'returns' );
$return->product_id = $_POST['id'];
$return->horometro = $_POST['horometro'];
$return->tecnico = $_POST['tecnico'];
$return->cliente = $_POST['cliente'];
$return->aceiteMotor = $_POST['a1'];
$return->aceiteTrans = $_POST['a2'];
$return->aceiteHid = $_POST['a3'];
$return->anticongelanteR = $_POST['a4'];
$return->anticongelanteRecu = $_POST['a5'];
$return->obsAce1 = $_POST['ob1'];
$return->obsAce2 = $_POST['ob2'];
$return->obsAce3 = $_POST['ob3'];
$return->obsR1 = $_POST['ob4'];
$return->obsR2 = $_POST['ob5'];
$hoy = date_create('now')->format('YmdHis'); // works in php 5.2 and higher


if(!empty($_FILES['img1'])){
$nombre_tmp1 = $_FILES['img1']['tmp_name'];
$nombre1 = $hoy .$_FILES['img1']['name'];

move_uploaded_file($_FILES['img1']['tmp_name'], "../../../storage/products/".$nombre1);
$return->img1 = $nombre1;

}

if(!empty($_FILES['img2'])){
  $nombre_tmp2 = $_FILES['img2']['tmp_name'];
  $nombre2 =   $hoy .$_FILES['img2']['name'];
  move_uploaded_file($_FILES['img2']['tmp_name'], "../../../storage/products/".$nombre2);
  $return->img2 = $nombre2;

}


$id = R::store($return);

$result = R::exec('UPDATE alerts set status = 0 where id =' . $_POST['alert']);

if($result == 1){
    echo true;

}else{
    echo false;
}
?>
