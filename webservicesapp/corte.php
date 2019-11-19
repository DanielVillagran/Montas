<?php

require ('conexion.php');

$url="application/storage/products/";
if($_POST['stock_id']=='admin'){
	$_POST['stock_id']="1";
}
$ventas['lista']="true";
R::exec( "INSERT INTO box (stock_id,created_at) values
 	(".$_POST['stock_id'].",
 	NOW()
)" );
  $id = R::getInsertID();
$lista=R::exec( "UPDATE sell as s
	 left join operation as o on o.sell_id=s.id
	 set s.box_id=".$id." 
	WHERE s.operation_type_id=2 and s.box_id is NULL and s.p_id=1 and s.is_draft=0 and
	o.stock_id = ".$_POST['stock_id']." and s.user_id =".$_POST['user_id']);
echo json_encode($ventas);

?>