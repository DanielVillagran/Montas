<?php
require '../model/Conection.php';
$rent = R::dispense( 'rent' );
$up =R::exec( 'UPDATE product SET is_rent= 1 WHERE id = '.$_GET['product_id'] );
$alerts = R::dispense('alerts');
$alerts->product_id = $_GET['product_id'];
$alerts->type =5;
$ale=R::store($alerts);

$rent->product_id=$_GET['product_id'];
$rent->cliente_name=$_GET['nombre'];
$rent->cliente_address=$_GET['direccion'];
$rent->cliente_phone=$_GET['telefono'];
$rent->type=$_GET['tipo'];
if(isset($_GET['f_start'])){

    $f_date =  $_GET['f_start'];
    $timestamps = date('Y-m-d H:i:s', strtotime($f_date));
    $rent->date_start=$timestamps;


}
if(isset($_GET['f_end'])){
    $e_date =  $_GET['f_end'];
    $timestampe = date('Y-m-d H:i:s', strtotime($e_date));
    $rent->date_end=$timestampe;


}

$id=R::store($rent);

if($id != null){
    echo true;

}else{
    echo false;

}

?>
