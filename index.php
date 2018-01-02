<?php
$con = @mysqli_connect('localhost', 'maria', 'maria', 'drugstore');

if (!$con) {
    echo "Error: " . mysqli_connect_error();
	exit();
}
echo 'Connected to MySQL';


// table
echo '<table>
        <thead>
            <tr>
                <th>NOMBRE</th>
                <th>COMPOSICION</th>
                <th>CANTIDAD</th>
                <th>FECHA</th>
            </tr>
        </thead>
        <tbody>';


// Some Query
$sql 	= 'SELECT * FROM homeo';
$query 	= mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($query))
{
	echo '<tr>';
  echo '<td>'.$row['name'].'</td>';
  echo '<td>'.$row['composition'].'</td>';
  echo '<td>'.$row['quantity'].'</td>';
  echo '<td>'.$row['updated'].'</td>';

  echo '</tr>';
/*
  echo '<tr>
            <td>'.$row['name'].'</td>
            <td>'.$row['composition'].'</td>
            <td>'.$row['quantity'].'</td>
            <td>'.$row['updated']'</td>
        </tr>';
*/
}

// Close connection
mysqli_close ($con);

 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>
      Homeo
    </title>
  </head>
  <body>
    <h1>Homeo</h1>
  </body>
</html>
