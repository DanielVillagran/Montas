<?php
class ProductData {
	public static $tablename = "product";
	public static $imgtable = "products_images";

	public function ProductData(){
		$this->barcode = "";
		$this->description = "";
		$this->inventary_min = "";
		$this->category_id = "";
		$this->name = "";
		$this->price_in = 0.0;
		$this->price_out = 0.0;
		$this->unit = "";
		$this->user_id = "";
		$this->image = "";
		$this->presentation = "0";
		$this->created_at = "NOW()";
		$this->model ="";
		$this->serie ="";
		$this->capacity ="";
		$this->height ="";
		$this->fuel ="";
		$this->admissiondate ="";
		$this->horometer ="";
		$this->observation ="";
		$this->type ="";
		$this->status =0;
	}

	public function getCategory(){ return CategoryData::getById($this->category_id);}

	public function add(){
		$sql = "insert into ".self::$tablename." (barcode,name,description,price_in,price_out,user_id,presentation,unit,category_id,inventary_min,created_at,is_rent,model,serie,capacity,height,fuel,admissiondate,horometer,observation,type,status) ";
		$sql .= "value (\"$this->barcode\",\"$this->name\",\"$this->description\",0.0,0.0,$this->user_id,\"$this->presentation\",\"$this->unit\",$this->category_id,$this->inventary_min,NOW(),\"$this->is_rent\",\"$this->model\",\"$this->serie\",$this->capacity,$this->height,$this->fuel,\"$this->admissiondate\",$this->horometer,\"$this->observation\",\"$this->type\", $this->status)";
		return Executor::doit($sql);
	}
	public function add_with_image(){
		$sql = "insert into ".self::$tablename." (barcode,image,name,description,price_in,price_out,user_id,presentation,unit,category_id,inventary_min,is_rent,model,serie,capacity,height,fuel,admissiondate,horometer,observation,type,status) ";
		$sql .= "value (\"$this->barcode\",\"$this->image\",\"$this->name\",\"$this->description\",0.0,0.0,$this->user_id,\"$this->presentation\",\"$this->unit\",$this->category_id,$this->inventary_min,\"$this->is_rent\",\"$this->model\",\"$this->serie\",$this->capacity,$this->height,$this->fuel,\"$this->admissiondate\",$this->horometer,\"$this->observation\",\"$this->type\", $this->status)";
		return Executor::doit($sql);
	}
    public function product_images(){
        $sql = "insert into ".self::$imgtable." (product_id, img) ";
        $sql .= "value (\"$this->serie\",\"$this->image\")";
        return Executor::doit($sql);
    }


	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto ProductData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set barcode=\"$this->barcode\",name=\"$this->name\",price_in=\"$this->price_in\",price_out=\"$this->price_out\",unit=\"$this->unit\",presentation=\"$this->presentation\",category_id=$this->category_id,inventary_min=\"$this->inventary_min\",description=\"$this->description\",is_active=\"$this->is_active\",is_rent=\"$this->is_rent\" ,model=\"$this->model\",serie=\"$this->serie\",capacity=\"$this->capacity\",height=\"$this->height\",fuel=\"$this->fuel\",admissiondate=\"$this->admissiondate\",horometer=\"$this->horometer\",observation=\"$this->observation\",type=\"$this->type\" where id=$this->id";
        Executor::doit($sql);
	}

	public function del_category(){
		$sql = "update ".self::$tablename." set category_id=NULL where id=$this->id";
		Executor::doit($sql);
	}


	public function update_image(){
		$sql = "update ".self::$imgtable." set product_id=\"$this->serie\" where product_id=\"$this->serie\"";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ProductData());

	}
    public static function getBySerie($serie){
        $sql = "select * from ".self::$imgtable." where product_id like '%$serie%'";
        $query = Executor::doit($sql);
        return Model::many($query[0],new ProductData());

    }



	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductData());
	}
    public static function getWorkshop(){
        $sql = "select * from ".self::$tablename." where status=0";;
        $query = Executor::doit($sql);
        return Model::many($query[0],new ProductData());
    }

	public static function getAllByCategoryId($id){
		$sql = "select * from ".self::$tablename." where category_id=$id";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductData());
	}

	public static function getAllByPage($start_from,$limit){
		$sql = "select * from ".self::$tablename." where id>=$start_from limit $limit";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductData());
	}


	public static function getLike($p){
		$sql = "select * from ".self::$tablename." where barcode like '%$p%' or name like '%$p%' or id like '%$p%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductData());
	}



	public static function getAllByUserId($user_id){
		$sql = "select * from ".self::$tablename." where user_id=$user_id order by created_at desc";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductData());
	}

}

?>