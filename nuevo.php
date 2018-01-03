<?php
if($_POST){


  $con = @mysqli_connect('localhost', 'maria', 'maria', 'drugstore');

  if (!$con) {
      echo "Error: " . mysqli_connect_error();
  	exit();
  }

  $name = $_POST['name'];
  $composition = $_POST['composition'];
  $quantity = $_POST['quantity'];
  $brand = $_POST['brand'];
  $date = date('Y-m-d H:i:s');
  echo $date;

  $sql = "INSERT INTO homeo (name, composition, quantity, brand, inserted, updated)
  VALUES ('{$name}', '{$composition}', '{$quantity}', '{$brand}', '{$date}', '{$date}')";
  //$query 	= mysqli_query($con, $sql);

  if(mysqli_query($con, $sql)){
    echo "Records inserted successfully.";
  } else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
  }

  echo $query;
}
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>
      Nuevo
    </title>
    <link rel="stylesheet" href="css/bootstrap.css">
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="row">
            div.
          </div>
          <form id="buscador" name="buscador" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <div class="form-group">
              <label >Nombre</label>
              <input class="form-control" name="name" type="text" placeholder="Nombre..." autofocus >
            </div>
            <div class="form-group">
              <label >Composición</label>
              <input class="form-control" name="composition" type="text" placeholder="Composición..." autofocus >
            </div>
            <div class="form-group">
              <label >Cantidad</label>
              <input class="form-control" name="quantity" type="text" placeholder="Cantidad..." autofocus >
            </div>
            <div class="form-group">
              <label >Marca</label>
              <input class="form-control" name="brand" type="text" placeholder="Marca..." autofocus >
            </div>

              <input type="submit" name="Guardar" class="btn btn-success" value="Guardar">
              <a href="index.php" class="btn btn-danger">Cancelar</a>
          </form>

        </div>
      </div>
    </div>
  </body>
</html>
