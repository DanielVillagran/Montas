<?php
require '../model/Conection.php';
$rent = R::dispense( 'rent' );


//$rent->product_id=$_GET['product_id'];

$ret = R::exec( 'UPDATE product SET is_rent= 0 WHERE id = '.$_GET['id'] );
//$reg =R::exec( 'UPDATE rent SET status = 0, return_date = '.date("Y-m-d") .' WHERE id = '.$_GET['id'] );

//$id=R::store($rent);

if($ret != null){
    echo $_GET['id'];

}else{
    echo false;

}

?>
