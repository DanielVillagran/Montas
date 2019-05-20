<?php

if(count($_POST)>0){
	$user = new PersonData();
	if(isset($_POST["no"])&&$_POST["no"]!="")
	$user->no = $_POST["no"];
if(isset($_POST["name"])&&$_POST["name"]!="")
	$user->name = $_POST["name"];
if(isset($_POST["lastname"])&&$_POST["lastname"]!="")
	$user->lastname = $_POST["lastname"];
if(isset($_POST["address1"]) &&$_POST["address1"]!="")
	$user->address1 = $_POST["address1"];
if(isset($_POST["email1"])&&$_POST["email1"]!="")
	$user->email1 = $_POST["email1"];
if(isset($_POST["phone1"])&&$_POST["phone1"]!="")
	$user->phone1 = $_POST["phone1"];
if(isset($_POST["phone2"])&&$_POST["phone2"]!="")
	$user->phone2 = $_POST["phone2"];
if(isset($_POST["phone3"])&&$_POST["phone3"]!="")
	$user->phone3 = $_POST["phone3"];
if(isset($_POST["credit_limit"])&&$_POST["credit_limit"]!="")
	$user->credit_limit = $_POST["credit_limit"];


	$user->is_active_access = isset($_POST["is_active_access"])?1:0;
	$user->has_credit = isset($_POST["has_credit"])?1:0;
	$user->password = sha1(md5($_POST["password"]));

	$user->add_client();

print "<script>window.location='index.php?view=clients';</script>";


}


?>