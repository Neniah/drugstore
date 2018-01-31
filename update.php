<?php
// Include config file
require_once 'config.php';

// Define variables and initialize with empty values
$name = $composition = $quantity = "";
$name_err = $composition_err = $quantity_err = "";

// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];

    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Por favor introduce el nombre.";
    } elseif(!filter_var(trim($_POST["name"]), FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z'-.\s ]+$/")))){
        $name_err = 'El nombre debe ser válido.';
    } else{
        $name = $input_name;
    }

    // Validate composition
    $input_composition = trim($_POST["composition"]);
    if(empty($input_composition)){
        $composition_err = 'Introduce la potencia.';
    } else{
        $composition = $input_composition;
    }

    // Validate quantity
    $input_quantity = trim($_POST["quantity"]);
    if(empty($input_quantity)){
        $quantity_err = "Por favor introduzca la cantidad.";
    } elseif(!ctype_digit($input_quantity)){
        $quantity_err = 'Introduzca una cantidad válidad.';
    } else{
        $quantity = $input_quantity;
    }

    // Check input errors before inserting in database
    if(empty($name_err) && empty($composition_err) && empty($quantity_err)){
        // Prepare an insert statement
        $sql = "UPDATE homeo SET name=?, composition=?, quantity=? WHERE id=?";

        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sssi", $param_name, $param_composition, $param_quantity, $param_id);

            // Set parameters
            $param_name = $name;
            $param_composition = $composition;
            $param_quantity = $quantity;
            $param_id = $id;

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Algo fue mal. Inténtelo de nuevo";
            }
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $mysqli->close();
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM homeo WHERE id = ?";
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("i", $param_id);

            // Set parameters
            $param_id = $id;

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                $result = $stmt->get_result();

                if($result->num_rows == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = $result->fetch_array(MYSQLI_ASSOC);

                    // Retrieve individual field value
                    $name = $row["name"];
                    $composition = $row["composition"];
                    $quantity = $row["quantity"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }

            } else{
                echo "Oops! Algo fue mal. Por favor inténtelo de nuevo.";
            }
        }

        // Close statement
        $stmt->close();

        // Close connection
        $mysqli->close();
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Registro</title>
    <link rel="stylesheet" href="bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Editar Registro</h2>
                    </div>
                    <p>Rellene el formulario.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Nombre</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($composition_err)) ? 'has-error' : ''; ?>">
                            <label>Potencia</label>
                            <input type="text" name="composition" class="form-control" value="<?php echo $composition; ?>">
                            <span class="help-block"><?php echo $composition_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($quantiy_err)) ? 'has-error' : ''; ?>">
                            <label>Cantidad</label>
                            <input type="text" name="quantity" class="form-control" value="<?php echo $quantity; ?>">
                            <span class="help-block"><?php echo $quantity_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Guardar">
                        <a href="index.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
