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
    $tipo = $_POST["tipo"];
    $sexo = $_POST["sexo"];
    $fecha = $_POST["fecha"];
    $raza = $_POST["raza"];
    $tamaño = $_POST["tamaño"];
    $color = $_POST["color"];
    $trama = $_POST["trama"];
    $foto = file_get_contents($_FILES["foto"]["tmp_name"]); // Leer el contenido de la foto

    // Formatear la fecha al formato YYYY-MM-DD
    $fecha_formateada = date("Y-m-d", strtotime($fecha));

    // Validar la entrada (puedes agregar más validaciones según sea necesario)
    if (!empty($nombre) && !empty($tipo) && !empty($sexo) && !empty($fecha_formateada) && !empty($raza) && !empty($tamaño) && !empty($color) && !empty($trama) && !empty($foto)) {

        // Crear una declaración preparada
        $stmt = $conexion->prepare("INSERT INTO mascotas (nombre, tipo, sexo, fecha, raza, tamaño, color, trama, foto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $nombre, $tipo, $sexo, $fecha_formateada, $raza, $tamaño, $color, $trama, $foto);

        // Ejecutar la declaración preparada
        if ($stmt->execute()) {
            echo "Registro creado con éxito. \n";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Cerrar la declaración preparada
        $stmt->close();
    } else {
        echo "Datos de entrada inválidos.";
    }
}

// Leer (Seleccionar)
$consulta = "SELECT * FROM mascotas";
// $buscador = "WHERE `nombre` LIKE '%put%'";
$resultado = $conexion->query($consulta);

echo "<style>";
echo ".card-container { display: flex; flex-wrap: wrap; justify-content: center; }";
echo ".card { margin: 10px; border: 1px solid #ccc; border-radius: 5px; width: 300px; padding: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }";
echo ".card-body { text-align: left; }";
echo ".card-title { font-size: 18px; font-weight: bold; }";
echo ".card-text { margin-bottom: 5px; }";
echo ".btn-actualizar, .btn-eliminar { background-color: #007bff; color: white; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer; }";
echo ".btn-eliminar { background-color: #dc3545; margin-left: 10px; }";
echo ".btn-actualizar:hover, .btn-eliminar:hover { background-color: #0056b3; }";
echo "</style>";

if ($resultado->num_rows > 0) {
    echo "<div class='card-container'>";
    while ($fila = $resultado->fetch_assoc()) {
        echo '<div class="card">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $fila["nombre"] . '</h5>';
        echo '<p class="card-text">Tipo: ' . $fila["tipo"] . '</p>';
        echo '<p class="card-text">Sexo: ' . $fila["sexo"] . '</p>';
        echo '<p class="card-text">Fecha: ' . $fila["fecha"] . '</p>';
        echo '<p class="card-text">Raza: ' . $fila["raza"] . '</p>';
        echo '<p class="card-text">Tamaño: ' . $fila["tamaño"] . '</p>';
        echo '<p class="card-text">Color: ' . $fila["color"] . '</p>';
        echo '<p class="card-text">Trama: ' . $fila["trama"] . '</p>';
        echo '<img src="data:image/jpeg;base64,' . base64_encode($fila['foto']) . '" width="100" height="100" />';
        echo '<form action="mascotasnos.php" method="POST">';
        echo '<input type="submit" name="actualizar" class="btn-actualizar" value="Actualizar">';
        echo '<input type="submit" name="eliminar" value="Eliminar" class="mx-3 btn-eliminar">';
        echo "<input type='hidden' name='ID' value='" . $fila["ID"] . "'>";
        echo '</form>';
        echo '</div>';
        echo '</div>';
    }
    echo "</div>";
} else {
    echo "No se encontraron registros.";
}
?>
