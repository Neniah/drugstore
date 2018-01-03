


<?php
  $con = @mysqli_connect('localhost', 'maria', 'maria', 'drugstore');
  if (!$con) {
      echo "Error: " . mysqli_connect_error();
  	exit();
  } else{

  }
//echo "Connected to database";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Homeo</title>
    <link rel="stylesheet" href="css/bootstrap.css">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Homeopatía</a>
  <div class="" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="nuevo.php">Nuevo</a>
      </li>
    </ul>
  </div>
</nav>
    <div class="container">


      <br>
      <form id="buscador" name="buscador" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
          <input id="buscar" name="buscar" type="search" placeholder="Buscar aquí..." autofocus >
          <input type="submit" name="buscador" class="boton peque aceptar" value="buscar">
      </form>
      <br>

      <?php
      if($_POST){

        $busqueda = trim($_POST['buscar']);

        $con = @mysqli_connect('localhost', 'maria', 'maria', 'drugstore');

        if (!$con) {
            echo "Error: " . mysqli_connect_error();
        	exit();
        }

        $sql = "SELECT * FROM homeo WHERE name LIKE '%" .$busqueda. "%' ORDER BY name";
        $query 	= mysqli_query($con, $sql);
        // table
        echo '<table class="table">
                <thead class="thead-light">
                    <tr>
                        <th>NOMBRE</th>
                        <th>COMPOSICION</th>
                        <th>CANTIDAD</th>
                        <th>FECHA</th>
                    </tr>
                </thead>
                <tbody>';
        while ($row = mysqli_fetch_array($query))
        {
          echo '<tr>';
          echo '<td>'.$row['name'].'</td>';
          echo '<td>'.$row['composition'].'</td>';
          echo '<td>'.$row['quantity'].'</td>';
          echo '<td>'.$row['updated'].'</td>';
          echo '</tr>';
        }

      }
       ?>
      <div class="col-md-8">

      </div>
    </div>
  </body>
</html>
