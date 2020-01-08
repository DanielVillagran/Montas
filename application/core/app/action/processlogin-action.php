<?php

// define('LBROOT',getcwd()); // LegoBox Root ... the server root
// include("core/controller/Database.php");

if (!isset($_SESSION["user_id"])) {
	$user = $_POST['username'];
	$pass = sha1(md5($_POST['password']));

	$base = new Database();
	$con = $base->connect();
	$sql = "select * from user where (email= \"" . $user . "\" or username= \"" . $user . "\") and password= \"" . $pass . "\" and status=1";
//print $sql;
	$query = $con->query($sql);
	$found = false;
	$userid = null;
	$user_kind = "";
	while ($r = $query->fetch_array()) {
		$found = true;
		$userid = $r['id'];
		$user_kind = $r['kind'];
	}

	if ($found == true) {
		$_SESSION['user_id'] = $userid;
		print "Cargando ... $user";
		if ($user_kind != 1) {
			print "<script>window.location='index.php?view=alerts';</script>";
		} else {
			print "<script>window.location='index.php?view=home';</script>";
		}
	} else {
		print "<script>alert('Usuario o contraseña incorrectos.'); window.location='index.php?view=login';</script>";
	}

} else {

	print "<script>window.location='index.php?view=alerts';</script>";

}
?>