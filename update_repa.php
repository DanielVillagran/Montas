
<?php
require 'Conection.php';
$lista= R::getAll( 'SELECT *,DATEDIFF(now(),date_start) as fecha from rent where status=1' );

foreach ($lista as $key ) {
	
	if($key['fecha']%6==0){

		$alerts = R::dispense('alerts');
		$alerts->product_id = $key['product_id'];
		$alerts->type =6;
		$ale=R::store($alerts);
	}
}



?>
