<?php
require '../model/Conection.php';
$rent = R::dispense( 'rent' );


//$rent->product_id=$_GET['product_id'];

//$ret = R::exec( 'UPDATE product SET is_rent= 0 WHERE id = '.$_GET['id'] );
//$reg =R::exec( 'UPDATE rent SET status = 0 WHERE id = '.(int) $_GET['id'] );
$rent->return_date = date("Y-m-d");
$rent->id =(int) $_GET['id'];
var_dump($rent);
$reg = R::store($rent);

//$id=R::store($rent);
//var_dump($_GET['id']);
if($reg != null){
    echo $reg;

}else{
    echo false;

}

?>
