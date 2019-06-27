<?php

if(count($_POST)>0){
	$product = ProductData::getById($_POST["product_id"]);

	$product->barcode = $_POST["barcode"];
	$product->name = $_POST["name"];
	$product->price_in = $_POST["price_in"];
	$product->price_out = $_POST["price_out"];
	$product->unit = $_POST["unit"];

  $product->description = $_POST["description"];
  $product->presentation = $_POST["presentation"];
  $product->inventary_min = $_POST["inventary_min"];
  $category_id="NULL";
  if($_POST["category_id"]!=""){ $category_id=$_POST["category_id"];}

  $is_active=0;
  if(isset($_POST["is_active"])){ $is_active=1;}
  $is_rent=0;
  if(isset($_POST["is_rent"])){ $is_rent=1;}
  $product->is_rent=$is_rent;
    if (isset($_POST["modelo"]))
        $product->model = $_POST["modelo"];
    if (isset($_POST["serie"]))
        $product->serie = $_POST["serie"];
    if (isset($_POST["capacidad"]))
        $product->capacity = $_POST["capacidad"];
    if (isset($_POST["altura"]))
        $product->height = $_POST["altura"];
    if (isset($_POST["combustible"]))
        $product->fuel = $_POST["combustible"];
    if (isset($_POST["fechaingreso"]))
        $product->admissiondate = $_POST["fechaingreso"];
    if (isset($_POST["horometro"]))
        $product->horometer = $_POST["horometro"];
    if (isset($_POST["observacion"]))
        $product->observation = $_POST["observacion"];
    if (isset($_POST["tipo"]))
        $product->type = $_POST["tipo"];

  $product->is_active=$is_active;
  $product->category_id=$category_id;

	$product->user_id = $_SESSION["user_id"];
	$product->update();

	if(isset($_FILES["image"])){
		$image = new Upload($_FILES["image"]);
		if($image->uploaded){
			$image->Process("storage/products/");
			if($image->processed){
				$product->image = $image->file_dst_name;
				$product->update_image();
			}
		}
	}

	setcookie("prdupd","true");
	print "<script>window.location='index.php?view=editproduct&id=$_POST[product_id]';</script>";


}


?>