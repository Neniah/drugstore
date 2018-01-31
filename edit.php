<?php
// including the database connection file
include_once("config.php");

if(isset($_POST['update']))
{

	$id = mysqli_real_escape_string($mysqli, $_POST['id']);

	$name = mysqli_real_escape_string($mysqli, $_POST['name']);
	$quantity = mysqli_real_escape_string($mysqli, $_POST['quantity']);
	$composition = mysqli_real_escape_string($mysqli, $_POST['composition']);

	// checking empty fields
	if(empty($name) || empty($quantity) || empty($composition)) {

		if(empty($name)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}

		if(empty($quantity)) {
			echo "<font color='red'>Quantity field is empty.</font><br/>";
		}

		if(empty($composition)) {
			echo "<font color='red'>Composition field is empty.</font><br/>";
		}
	} else {
		//updating the table
		$result = mysqli_query($mysqli, "UPDATE homeo SET name='$name',quantity='$quantity',composition='$composition' WHERE id=$id");

		//redirectig to the display page. In our case, it is index.php
		header("Location: index.php");
	}
}
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM homeo WHERE id=$id");

while($res = mysqli_fetch_array($result))
{
	$name = $res['name'];
	$quantity = $res['quantity'];
	$composition = $res['composition'];
}
?>
<html>
<head>
	<title>Edit Data</title>
</head>

<body>
	<a href="index.php">Home</a>
	<br/><br/>

	<form name="form1" method="post" action="edit.php">
		<table border="0">
			<tr>
				<td>Name</td>
				<td><input type="text" name="name" value="<?php echo $name;?>"></td>
			</tr>
			<tr>
				<td>Quantity</td>
				<td><input type="text" name="quantity" value="<?php echo $quantity;?>"></td>
			</tr>
			<tr>
				<td>Composition</td>
				<td><input type="text" name="composition" value="<?php echo $composition;?>"></td>
			</tr>
			<tr>
				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
</body>
</html>
