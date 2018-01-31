<html>
<head>
	<title>Add Data</title>
</head>

<body>
<?php
//including the database connection file
include_once("config.php");

if(isset($_POST['Submit'])) {
	$name = mysqli_real_escape_string($mysqli, $_POST['name']);
	$quantity = mysqli_real_escape_string($mysqli, $_POST['quantity']);
	$composition = mysqli_real_escape_string($mysqli, $_POST['composition']);
	$brand = mysqli_real_escape_string($mysqli, $_POST['brand']);

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

		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else {
		// if all the fields are filled (not empty)

		//insert data to database
		$result = mysqli_query($mysqli, "INSERT INTO homeo(name,quantity,composition) VALUES('$name','$quantity','$composition')");

		//display success message
		echo "<font color='green'>Data added successfully.";
		echo "<br/><a href='index.php'>View Result</a>";
	}
}
?>
</body>
</html>
