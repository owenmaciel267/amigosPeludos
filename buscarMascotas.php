<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./styles/style.css">
    <title>Buscar Mascotas</title>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="container">
                <div class="logo">
                    <a href="./index.html"><img src="./media/logo/169b21ec-1dc6-4e95-96d6-8722f994526d.jpg" width="25px" height="25px">PetControl</a>
                </div>
                <div class="menu-toggle">&#9776;</div>
                <div class="nav-items">
                    <ul>
                        <li><a href="./index.html">Inicio</a></li>
                        <li><a href="./mascotas.html">Mis Mascotas</a></li>
                        <li><a href="./nosotros.html">Nosotros</a></li>
                        <li><a href="#">Galería</a></li>
                        <li><a href="./registroUsuarios.html">Registrar</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>  
    <main>
        <section>
            <div class="buscador" style=" margin:30px auto;
    background-color: #ffffff;
    width: 400px;
    height: 150px;
    text-align: center;
    padding-top: 40px;
    border-radius: 5px;
    box-shadow: 1px 1px 20px black;">
                <p>Ingrese el ID de la mascota encontrada</p>
                <form action="buscarMascotas.php" method="POST">
                    <input type="text" name="id" placeholder="ID">
                    <button type="submit" style="border-radius: 5px;
    background-color: #2bf267;">Buscar <i class="bi bi-search"></i></button>
                </form>
            </div>
            <div id="resultados"></div>
        </section>
    </main>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
    <script src="js.js"></script>
</body>
</html>

<?php
include("./config/config.php");

$id = isset($_POST['id']) ? $_POST['id'] : '';

if (!empty($id)) {
    // Consultar ambas tablas con el ID proporcionado
    $queryMascota = $conexion->prepare("SELECT * FROM mascotas WHERE ID = ?");
    $queryMascota->bind_param("i", $id);
    $queryMascota->execute();
    $resultadoMascota = $queryMascota->get_result()->fetch_assoc();

    $queryDue = $conexion->prepare("SELECT * FROM due WHERE ID = ?");
    $queryDue->bind_param("i", $id);
    $queryDue->execute();
    $resultadoDue = $queryDue->get_result()->fetch_assoc();

    // Si ambos resultados no están vacíos, crear la tarjeta combinada
    if ($resultadoMascota && $resultadoDue) {
        echo '<section class="mascotacard" style="    display: flex;
        justify-content: center;
        align-items: center;
        margin: auto;">';
        echo '<div class="animal" style="    width: 400px;
        height: 900px;
        background-color: rgb(249, 249, 249);
        text-align: center;
        border-radius: 20px;
        box-shadow: 1px 1px 20px black;">';
        echo '<div class="ianimal" style="  width: 250px;
        height:250px;
        box-sizing: content-box;
        border-radius: 50%;
        overflow: hidden; 
        margin:5px auto;">';
        echo '<img style="    width: auto;
        height: auto; 
        max-width: 100%;
        max-height: 100%; 
        object-fit: cover;" src="data:image/jpeg;base64,' . base64_encode($resultadoMascota['foto']) . '"  />';
        echo '</div>';
        echo '<h2 class="card-title" style="afont-family: "Poetsen One", sans-serif;">Mascota: ' . $resultadoMascota["nombre"] . '</h2>';
        echo '<hr>';
        echo '<p class="card-text">Tipo: ' . $resultadoMascota["tipo"] . '</p>';
        echo '<hr>';
        echo '<p class="card-text">Sexo: ' . $resultadoMascota["sexo"] . '</p>';
        echo '<hr>';
        echo '<p class="card-text">Fecha: ' . $resultadoMascota["fecha"] . '</p>';
        echo '<hr>';
        echo '<p class="card-text">Raza: ' . $resultadoMascota["raza"] . '</p>';
        echo '<hr>';
        echo '<p class="card-text">Tamaño: ' . $resultadoMascota["tamaño"] . '</p>';
        echo '<hr>';
        echo '<p class="card-text">Color: ' . $resultadoMascota["color"] . '</p>';
        echo '<hr>';
        echo '<p class="card-text">Trama: ' . $resultadoMascota["trama"] . '</p>';
        echo '<hr>';
        echo '<h2 class="card-title">Mascota: DATOS DUEÑO</h2>';
        echo '<hr>';
        echo '<p class="card-text">Dueño: ' . $resultadoDue["nombre"] . ' ' . $resultadoDue["apellido"] . '</p>';
        echo '<hr>';
        echo '<p class="card-text">Email: ' . $resultadoDue["email"] . '</p>';
        echo '<hr>';
        echo '<p class="card-text">Teléfono: ' . $resultadoDue["telefono"] . '</p>';
        echo '<hr>';
        echo '<p class="card-text">Dirección: ' . $resultadoDue["direccion"] . '</p>';
        echo '</div>';
        echo '</section>';
    } else {
        echo '<p>No se encontraron registros para el ID proporcionado.</p>';
    }
} else {
    echo '<p>ID no proporcionado.</p>';
}
?>


<html>
  <body>
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
      <p class="col-md-4 mb-0 text-body-secondary">© 2024 Yo y los dominados</p>
      
      <a href="./index.html" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
        <img src="./media/logo/169b21ec-1dc6-4e95-96d6-8722f994526d.jpg" width="40px" height="40px">
      </a>
      <ul class="nav col-md-4 justify-content-end">
        <li class="nav-item"><a href="./index.html" class="nav-link px-2 text-body-secondary">Inicio</a></li>
        <li class="nav-item"><a href="./mascotas.html" class="nav-link px-2 text-body-secondary">Mis Mascotas</a></li>
            <li class="nav-item"><a href="./nosotros.html" class="nav-link px-2 text-body-secondary">Nosotros</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Galeria</a></li>
            <li class="nav-item"><a href="./registrar.html" class="nav-link px-2 text-body-secondary">Registrar</a></li>
          </ul>
        </footer>
      </div>
    </footer>
   </body>
</html>