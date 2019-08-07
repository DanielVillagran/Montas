
<?php
require '../model/Conection.php';
$alerts = R::dispense('alerts');
$alerts->status=0;
$alerts->id=$_POST['id'];
$id=R::store($alerts);


if($id != null){
    echo true;

}else{
    echo false;

}

?>