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



<form id="buscador" name="buscador" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    <input name="name" type="text" placeholder="Nombre..." autofocus >
    <input name="composition" type="text" placeholder="Composición..." autofocus >
    <input name="quantity" type="text" placeholder="Cantidad..." autofocus >
    <input name="brand" type="text" placeholder="Marca..." autofocus >

    <input type="submit" name="Guardar" class="" value="Guardar">
</form>
