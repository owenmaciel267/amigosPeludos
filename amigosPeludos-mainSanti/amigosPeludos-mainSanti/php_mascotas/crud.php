<?php
    include("../config/config.php");
    $ID= "";
    $id_eliminar = "";
    $nuevoNombre = "";
    $nuevoTelefono = "";
    $nuevoEmail = "";
    $nuevoMensaje = "";
    
    // si apreté botón Actualizar
            if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["actualizar"])) {
                $ID = $_POST["ID"];
                // $nuevoNombre = $_POST["nuevoNombre"];
                // $nuevoTelefono = $_POST["nuevoTelefono"];
                // $nuevoEmail = $_POST["nuevoEmail"];
                // $nuevoMensaje = $_POST["nuevoMensaje"];

                $stmt = $conexion->prepare("SELECT * FROM pedidos WHERE ID=?");
                $stmt->bind_param("i", $ID);
                
                if ($stmt->execute()) {
                    $stmt->bind_result($ID, $nuevoNombre, $nuevoTelefono, $nuevoEmail, $nuevoMensaje);
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
                $nuevoTelefono = $_POST["nuevo-Telefono"];
                $nuevoEmail = $_POST["nuevo-Email"];
                $nuevoMensaje = $_POST["nuevo-Mensaje"];

                   // Validar la entrada
                   if (!empty($ID) && !empty($nuevoNombre) && !empty($nuevoTelefono) && !empty($nuevoEmail)  && !empty($nuevoMensaje)) {
                    // Crear una declaración preparada
                    $stmt = $conexion->prepare("UPDATE pedidos SET nombre=?, telefono=?, email=?, mensaje=? WHERE ID=?");
                    $stmt->bind_param("ssssi", $nuevoNombre, $nuevoTelefono, $nuevoEmail,$nuevoMensaje,$ID);

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
                    $stmt = $conexion->prepare("DELETE FROM pedidos WHERE ID=?");
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
    <link rel="stylesheet" href="../css/style.css">
    <!-- favicon -->
    <link rel="shortcut icon" href="../logo/logo11.png" type="image/x-icon">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    <title>Tabla pedidos</title>
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
                    <form action="./crud.php" method="POST" class="row g-3 mb-3">
                    <div class="col">

                        <label for="ID" class="form-label">ID de Usuario:</label>
							<input type="number" name="ID" id="ID" class="form-control" value="<?php echo  $ID; ?>"  required readonly>

                    </div>
                    <!-- <input type="hidden" name="ID" value="<//?php echo $ID; ?>"> -->
                    <div class="col">

                        <label for="nuevo-Nombre" class="form-label">Nuevo Nombre:</label>
						<input type="text" name="nuevo-Nombre" id="nuevo-Nombre" class="form-control" value="<?php echo  $nuevoNombre; ?>"  required >

                    </div>
                    <div class="col">
                        <label for="nuevo-Telefono" class="form-label">numero telefono:</label>
						<input type="number" name="nuevo-Telefono" id="nuevo-Telefono" class="form-control" value="<?php echo  $nuevoTelefono; ?>"  required >

                    </div>
                    <div class="col">

                        

                        <label for="nuevo-Email" class="form-label">Nuevo email:</label>
						<input type="text" name="nuevo-Email" id="nuevo-Email" class="form-control" value="<?php echo  $nuevoEmail; ?>"  required >

                    </div>
                    <div class="col">

                        <label for="nuevo-Mensaje" class="form-label">Nuevo Mensaje:</label>
						<input type="text" name="nuevo-Mensaje" id="nuevo-Mensaje" class="form-control" value="<?php echo  $nuevoMensaje; ?>"  required >

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
					<form action="crud.php" method="post" class="row g-3 mb-3">
						<div class="col">
							<label for="id_eliminar" class="form-label">ID de Usuario:</label>
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
        include("../config/config.php");

            $ID = "";
            $id_eliminar = "";
            $nuevoNombre = "";
            $nuevoTelefono = "";
            $nuevoEmail = "";
            $nuevoMensaje = "";

        // Crear (Insertar)
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["create"])) {

            $nombre = $_POST["nombre"];
            $telefono = $_POST["telefono"];
            $email = $_POST["email"];
            $mensaje = $_POST["mensaje"];
            
            // ValIDar la entrada (puedes agregar más valIDaciones según sea necesario)
            if (!empty($nombre) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        
                        // Crear una declaración preparada
                $stmt = $conexion->prepare("INSERT INTO pedidos (nombre, telefono, email, mensaje) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $nombre, $telefono, $email, $mensaje );

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
        $consulta = "SELECT * FROM pedidos";
        // $buscador = "WHERE `nombre` LIKE '%put%'";
        $resultado = $conexion->query($consulta);

        if ($resultado->num_rows > 0) {
            echo "<br>";
            echo '<table class=" table table-dark table-striped table-hover">';
            // echo    "<caption> TABLA ENCABEZADO </caption>";
            echo "<tr>";
                echo    '<th scope="col">ID</th>';
                echo    '<th scope="col">nombre</th>';
                echo    '<th scope="col">telefono</th>';
                echo    '<th scope="col">email</th>';
                echo    '<th scope="col">mensaje</th>';
                echo    '<th scope="col">activIDad</th>';
            echo "</tr>";
            echo '<tbody>';
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo   '<td scope="row"> ' . $fila["ID"] . "</td>"; // generalmente no mostramos públicamente el ID
                    echo    "<td> " . $fila["nombre"] . "</td>";
                    echo    "<td> " . $fila["telefono"] . "</td>";
                    echo    "<td> " . $fila["email"] . "</td>";
                    echo    "<td> " . $fila["mensaje"] . "</td>";
                    echo "<td>";
                        echo "<form action='crud.php' method='POST'>";

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