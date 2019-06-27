<?php

if (count($_POST) > 0) {
    $product = new ProductData();
    if (isset($_POST["barcode"]))
        $product->barcode = $_POST["barcode"];
    if (isset($_POST["name"]))
        $product->name = $_POST["name"];
    if (isset($_POST["price_in"]))
        $product->price_in = $_POST["price_in"];
    if (isset($_POST["price_out"]))
        $product->price_out = $_POST["price_out"];
    if (isset($_POST["unit"]))
        $product->unit = $_POST["unit"];
    if (isset($_POST["description"]))
        $product->description = $_POST["description"];
    if (isset($_POST["presentation"]))
        $product->presentation = $_POST["presentation"];
    //$product->inventary_min = $_POST["inventary_min"];
    $category_id = "NULL";
    if ($_POST["category_id"] != "") {
        $category_id = $_POST["category_id"];
    }
    $inventary_min = "\"\"";
    if ($_POST["inventary_min"] != "") {
        $inventary_min = $_POST["inventary_min"];
    }

    $product->category_id = $category_id;
    $product->inventary_min = $inventary_min;
    $product->user_id = $_SESSION["user_id"];
    $is_rent = 0;
    if (isset($_POST["is_rent"])) {
        $is_rent = 1;
    }
    $product->is_rent = $is_rent;

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


    if (isset($_FILES["image"])) {
        $image = new Upload($_FILES["image"]);
        if ($image->uploaded) {
            $image->Process("storage/products/");
            if ($image->processed) {
                $product->image = $image->file_dst_name;
                $prod = $product->add_with_image();
            }
        } else {

            $prod = $product->add();
        }
    } else {
        $prod = $product->add();

    }


    if ($_POST["q"] != "" || $_POST["q"] != "0") {
        $op = new OperationData();
        $op->product_id = $prod[1];
        $op->stock_id = StockData::getPrincipal()->id;
        $op->operation_type_id = OperationTypeData::getByName("entrada")->id;
        $op->price_in = $_POST["price_in"];
        $op->price_out = $_POST["price_out"];
        $op->q = $_POST["q"];
        $op->sell_id = "NULL";
        $op->is_oficial = 1;
        $op->add();
    }

    print "<script>window.location='index.php?view=products';</script>";


}


?>