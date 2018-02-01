<?php
// Include config file
require_once 'config.php';

// Define variables and initialize with empty values
$name = $composition = $quantity = "";
$name_err = $composition_err = $quantity_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Por favor introduce un nombre.";
    } elseif(!filter_var(trim($_POST["name"]), FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z'-.\s ]+$/")))){
        $name_err = 'Introduce un nombre válido.';
    } else{
        $name = $input_name;
    }

    // Validate composition
    $input_composition = trim($_POST["composition"]);
    if(empty($input_composition)){
        $composition_err = 'Por favor introduce una potencia.';
    } else{
        $composition = $input_composition;
    }

    // Validate quantity
    $input_quantity = trim($_POST["quantity"]);
    if(empty($input_quantity)){
        $quantity_err = "Por favor introduce una cantidad.";
    } elseif(!ctype_digit(strval($input_quantity)){
        $quantity_err = 'Introduce una cantidad valida.';
    } else{
        $quantity = $input_quantity;
    }

    // Check input errors before inserting in database
    if(empty($name_err) && empty($composition_err) && empty($quantity_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO homeo (name, composition, quantity) VALUES (?, ?, ?)";

        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sss", $param_name, $param_composition, $param_quantity);

            // Set parameters
            $param_name = $name;
            $param_composition = $composition;
            $param_quantity = $quantity;

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Error. Por favor inténtalo de nuevo.";
            }
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Registro</title>
    <link rel="stylesheet" href="bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 700px;
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
                        <h2>Crear Registro</h2>
                    </div>
                    <p>Por favor rellene este formulario.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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
                        <div class="form-group <?php echo (!empty($quantity_err)) ? 'has-error' : ''; ?>">
                            <label>Cantidad</label>
                            <input type="text" name="quantity" class="form-control" value="<?php echo $quantity; ?>">
                            <span class="help-block"><?php echo $quantity_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Guardar">
                        <a href="index.php" class="btn btn-default">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
