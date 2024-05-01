       
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
                $stmt = $conexion->prepare("INSERT INTO mascotas (nombre, apellido, email, telefono, direccion) VALUES (?, ?, ?, ?, ?)");
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
        $consulta = "SELECT * FROM mascotas";
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
                        echo '<form action="mascotasnos.php" method="POST">';

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