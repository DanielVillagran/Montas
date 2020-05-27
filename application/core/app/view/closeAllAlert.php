
<?php
require '../model/Conection.php';
$alerts = R::exec('UPDATE alerts set status=0 WHERE type!=6');

    echo true;


?>