<?php
  include("./config/config.php");

    $ID= "";
    $id_eliminar = "";
    $nuevoNombre = "";
    $nuevoApellido = "";
    $nuevoEmail = "";
    $nuevoTelefono = "";
    $nuevoDireccion = "";
    
    // si apreté botón Actualizar
            if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["actualizar"])) {
                $ID = $_POST["ID"];
                // $nuevoNombre = $_POST["nuevoNombre"];
                // $nuevoTelefono = $_POST["nuevoTelefono"];
                // $nuevoEmail = $_POST["nuevoEmail"];
                // $nuevoMensaje = $_POST["nuevoMensaje"];

                $stmt = $conexion->prepare("SELECT * FROM due WHERE ID=?");
                $stmt->bind_param("i", $ID);
                
                if ($stmt->execute()) {
                    $stmt->bind_result($ID, $nuevoNombre, $nuevoNombre, $nuevoEmail, $nuevoTelefono, $nuevoTelefono, $nuevoDireccion );
                    while ($stmt->fetch()) {
                        // Los datos del usuario se cargarán en los campos del formulario
                    }
                } else {
                    echo "Error: " . $stmt->error;
                }
            }
            
            // Si apreta eliminar
            if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["eliminar"])) {
                $id_eliminar = $_POST["ID"];
            }
         
            // si aprieto el botón Update
            if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update"])) {
                $ID = $_POST["ID"];
                $nuevoNombre = $_POST["nuevo-Nombre"];
                $nuevoApellido = $_POST["nuevo-Apellido"];
                $nuevoEmail = $_POST["nuevo-Email"];
                $nuevoTelefono = $_POST["nuevo-Telefono"];
                $nuevoDireccion = $_POST["nuevo-direccion"];
                   // Validar la entrada
                   if (!empty($ID) && !empty($nuevoNombre) && !empty($nuevoApellido) && !empty($nuevoEmail)  && !empty($nuevoTelefono)  && !empty($nuevoDireccion)  ) {
                    // Crear una declaración preparada
                    $stmt = $conexion->prepare("UPDATE due SET nombre=?, telefono=?, email=?, mensaje=? WHERE ID=?");
                    $stmt->bind_param("sssisi", $nuevoNombre, $nuevoApellido, $nuevoEmail,$nuevoTelefono, $nuevoDireccion, $ID);

                    // Ejecutar la declaración preparada
                    if ($stmt->execute()) {
                                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                Registro actualizado con éxito.
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>";
                        } else {
                        echo "Error: " . $stmt->error;
                    }

                    // Cerrar la declaración preparada
                    $stmt->close();
                } else {
                    echo "Datos de entrada inválidos.";
                }
            }
            
            
            if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete"])) {
                $Id = $_POST["id_eliminar"];
            
                // Validar la entrada
                if (!empty($Id)) {
                    // Crear una declaración preparada
                    $stmt = $conexion->prepare("DELETE FROM due WHERE ID=?");
                    $stmt->bind_param("i", $Id);
            
                    // Ejecutar la declaración preparada
                    if ($stmt->execute()) {
                                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                Registro eliminado con éxito.
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>";
                    } else {
                        echo "Error: " . $stmt->error;
                    }
            
                    // Cerrar la declaración preparada
                    $stmt->close();
                } else {
                    echo "Datos de entrada inválidos.";
                }
            }
            
         
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="wIDth=device-wIDth, initial-scale=1.0">
    <!-- Style -->
    <!-- favicon -->
    <link rel="shortcut icon" href="../logo/logo11.png" type="image/x-icon">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <title>Tabla due</title>
</head>
    <body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-black" style="background-color: #e3f2fd;">
        <a class="navbar-brand" href="index.html">
            <img src="../recursos/logo/logo.webp " class="mx-3" style="width: 40px; ">
        </a>
        <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon  "></span>
        </button>
        <div class=" collapse navbar-collapse justify-content-end mx-3" id="navbarScroll">
            <ul class="navbar-nav ms-auto mt-2 mt-lg-0 justify-content-end">
                <li class="nav-item">
                    <a class="nav-link active" href="../index.html" aria-current="page">Inicio <span class="visually-hidden">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../html/nosotros.html">Sobre</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../html/productos.html">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../html/contacto.html">Contactarnos</a>
                </li>
              
            </ul>
        </div>
    </nav>
        
        
        
        <div class="container-fluID mb-2 shadow bg-black">
            <div class="row justify-content-center align-items-center g-2">
                <div class="col">
                    <!-- Formulario para actualizar un usuario -->
                    <h2 class="text-white">Actualizar Usuario</h2>
                    <form action="duenos.php" method="POST" class="row g-3 mb-3">
                    <div class="col">

                        <label for="ID" class="form-label text-light bg-dark">ID de Usuario:</label>
						<input type="number" name="ID" id="ID" class="form-control" value="<?php echo  $ID; ?>"  required readonly>

                    </div>
                    <!-- <input type="hidden" name="ID" value="<//?php echo $ID; ?>"> -->
                    <div class="col">

                        <label for="nuevo-Nombre" class="form-label text-light bg-dark">Nuevo Nombre:</label>
						<input type="text" name="nuevo-Nombre" id="nuevo-Nombre" class="form-control" value="<?php echo  $nuevoNombre; ?>"  required >

                    </div>
                    <div class="col">
                        <label for="nuevo-Telefono" class="form-label text-light bg-dark">numero Apellido:</label>
						<input type="number" name="nuevo-Telefono" id="nuevo-Telefono" class="form-control" value="<?php echo  $nuevoApellido; ?>"   required readonly >

                    </div>
                    <div class="col">

                        <label for="nuevo-Email" class="form-label text-light bg-dark">Nuevo email:</label>
						<input type="text" name="nuevo-Email" id="nuevo-Email" class="form-control" value="<?php echo  $nuevoEmail; ?>"  required >

                    </div>
                    <div class="col">

                        <label for="nuevo-Telefono" class="form-label text-light bg-dark">Nuevo Telefono:</label>
						<input type="text" name="nuevo-Telefono" id="nuevo-Telefono" class="form-control" value="<?php echo  $nuevoTelefono; ?>"  required >

                    </div>
                    <div class="col">

                        <label for="nuevo-direccion" class="form-label text-light bg-dark">Nuevo Direccion:</label>
						<input type="text" name="nuevo-direccion" id="nuevo-direccion" class="form-control" value="<?php echo  $nuevoDireccion; ?>"  required >

                    </div>
                    
                        <input type="submit" name="update" value="update" class="btn-actualizar">

                    </form>
                    </div>
            </div>
        </div>
        <div class="     my-2 shadow bg-black container-fluid">
			<div class="row justify-content-center align-items-center g-2">
				<div class="col">
					<!-- Formulario para eliminar un usuario -->
					<h2 class="text-white">Eliminar Usuario</h2>
					<form action="duenos.php" method="POST" class="row g-3 mb-3">
						<div class="col">
							<label for="id_eliminar" class="form-label text-light bg-dark">ID de Usuario:</label>
							<input type="number" name="id_eliminar" id="id_eliminar" class="form-control" value="<?php echo  $id_eliminar; ?>"  required readonly>
						</div>
							<input type="submit" name="delete" value="delete" class="btn-actualizar">
					</form>
				</div>
			</div>
		</div>
    </body>

</html>
     



        
<?php
     include("./config/config.php");


            $ID = "";
            $id_eliminar = "";
            $nuevoNombre = "";
            $nuevoTelefono = "";
            $nuevoEmail = "";
            $nuevoMensaje = "";

        // Crear (Insertar)
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["create"])) {

            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $email = $_POST["email"];
            $telefono = $_POST["telefono"];
            $direccion = $_POST["direccion"];
            
            // ValIDar la entrada (puedes agregar más valIDaciones según sea necesario)
            if (!empty($nombre) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        
                        // Crear una declaración preparada
                $stmt = $conexion->prepare("INSERT INTO due (nombre, apellido, email, telefono, direccion) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("sssis", $nombre, $apellido,$email, $telefono, $direccion);

                // Ejecutar la declaración preparada
                if ($stmt->execute()) {
                    echo "Registro creado con éxito. \n";
                } else {
                    echo "Error: " . $stmt->error;
                }

                // Cerrar la declaración preparada
                $stmt->close();
            } else {
                echo "Datos de entrada inválIDos.";
            }
        }

        // Leer (Seleccionar)
        $consulta = "SELECT * FROM due";
        // $buscador = "WHERE `nombre` LIKE '%put%'";
        $resultado = $conexion->query($consulta);

        if ($resultado->num_rows > 0) {
            echo "<br>";
            echo '<table class=" table table-dark table-striped table-hover">';
            // echo    "<caption> TABLA ENCABEZADO </caption>";
            echo "<tr>";
                echo    '<th scope="col">ID</th>';
                echo    '<th scope="col">nombre</th>';
                echo    '<th scope="col">apellido</th>';
                echo    '<th scope="col">email</th>';
                echo    '<th scope="col">telefono</th>';
                echo    '<th scope="col">direccion</th>';
                echo    '<th scope="col">actividad</th>';
            echo "</tr>";
            echo '<tbody>';
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo   '<td scope="row"> ' . $fila["ID"] . "</td>"; // generalmente no mostramos públicamente el ID
                    echo    "<td> " . $fila["nombre"] . "</td>";
                    echo    "<td> " . $fila["apellido"] . "</td>";
                    echo    "<td> " . $fila["email"] . "</td>";
                    echo    "<td> " . $fila["telefono"] . "</td>";
                    echo    "<td> " . $fila["direccion"] . "</td>";
                    echo "<td>";
                        echo '<form action="duenos.php" method="POST">';

                            echo '<input type="submit" name="actualizar"  class="btn-actualizar" value="actualizar">';  
                            echo '<input type="submit" name="eliminar" value="eliminar" class="mx-3 btn-eliminar">';
                            echo "<input type='hidden' name='ID' value='" . $fila["ID"] . "'>"; 
                        echo "</form>"; 
                    echo "</td>";
                    echo "</tr>" ;
                }
                echo '</tbody>';
                echo "</table>";
            } else {
                echo "No se encontraron registros.";
            }


        // include("config/config.php");
        
            // Actualizar
            // include("config/config.php");
            


?> 