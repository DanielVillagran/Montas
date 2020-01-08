<section class="content">
<div class="row">
	<div class="col-md-12">
	<h1>Agregar Usuario</h1>
	<br>
		<form class="form-horizontal" method="post" id="addproduct" action="index.php?view=adduser" role="form">


  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
    <div class="col-md-6">
      <input type="text" name="name" class="form-control" id="name" placeholder="Nombre">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Apellido*</label>
    <div class="col-md-6">
      <input type="text" name="lastname" required class="form-control" id="lastname" placeholder="Apellido">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nombre de usuario*</label>
    <div class="col-md-6">
      <input type="text" name="username" class="form-control" required id="username" placeholder="Nombre de usuario">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Email*</label>
    <div class="col-md-6">
      <input type="text" name="email" class="form-control" id="email" placeholder="Email">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Contrase&ntilde;a</label>
    <div class="col-md-6">
      <input type="password" name="password" onchange="check_if_coincide()" class="form-control" id="inputEmail1" placeholder="Contrase&ntilde;a">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Verificar Contrase&ntilde;a</label>
    <div class="col-md-6">
      <input type="password" name="password2" onchange="check_if_coincide()" class="form-control" id="inputEmail1" placeholder="Contrase&ntilde;a">
    </div>
  </div>

<?php if (isset($_GET["kind"]) && $_GET["kind"] == "2" || $_GET["kind"] == "3"): ?>
  <div style="display: none;" class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Almacen</label>
    <div class="col-md-6">
    <?php
$clients = StockData::getAll();
?>
    <select name="stock_id" class="form-control" required>
    <?php foreach ($clients as $client): ?>
      <option value="<?php echo $client->id; ?>"><?php echo $client->name; ?></option>
    <?php endforeach;?>
      </select>
    </div>
  </div>
<?php endif;?>
<input type="hidden" name="kind" value="<?php echo $_GET["kind"]; ?>">
  <p class="alert alert-info">* Campos obligatorios</p>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <div id="elemento" style="display: none;">
        <label class="label label-danger">Las Contrase&ntilde;as no coinciden</label>
      </div>
      <div id="boton">
      <button type="submit" class="btn btn-primary">Agregar Usuario</button>
      </div>
    </div>
  </div>
</form>
	</div>
</div>
</section>
<script type="text/javascript">
  function check_if_coincide() {
      var pass1=$("input[name='password']").val();
      var pass2=$("input[name='password2']").val();
      if(pass1!=pass2){
        $("#elemento").show();
        $("#boton").hide();
      }else{
         $("#elemento").hide();
        $("#boton").show();
      }
  }
</script>