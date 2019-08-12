<?php
require '../model/Conection.php';
$rent = R::dispense( 'rent' );


//$rent->product_id=$_GET['product_id'];

//$ret = R::exec( 'UPDATE product SET is_rent= 0 WHERE id = '.$_GET['id'] );
$fecha = date("Y-m-d H:i:s");
var_dump($fecha);

$reg =R::exec( 'UPDATE rent SET status = 0, return_date = "'.$fecha.'" WHERE product_id = '.$_GET['id']);
//echo 'UPDATE rent SET status = 0, return_date = '.$fecha.' WHERE product_id = '.$_GET['id'];

//var_dump($_GET['id']);
if($reg != null){
    echo $reg;

}else{
    echo false;

}

?>
