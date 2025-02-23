<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card img {
            object-fit: cover;
            height: 300px;
        }
    </style>

    <link rel="stylesheet" href="css/ADMINstyles.css">

</head>
<?php
session_start();
if(empty($_SESSION["user"])){
    header("Location: login.php");
    exit();
}

?>
<body>

    <header>
        <div class="overlay">
            <div class="row d-flex">
                <div class="col-lg-12">
                    <img src="img/recursos/White.png" alt="Logo de la Tienda">
                </div>
                <div class="col-lg-12">
                    <a class="btn btn-editar" href="agregar.php">Agregar Productos</a>
                    <a class="btn btn-danger" href="logout.php">Cerrar Session</a>
                </div>
            </div>
        </div>
    </header>

    <h1 class="text-center mb-4">Catálogo de Productos</h1>

    <div class="container mt-5 mb-5">

        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-12">
                <h5>Filtrar por Categoría</h5>
                <ul class="list-group">
                    <li class="list-group-item"><a href="ADindex.php" class="text-decoration-none">Todos</a></li>
                    <li class="list-group-item"><a href="ADindex.php?categoria=textil" class="text-decoration-none">Textil</a></li>
                    <li class="list-group-item"><a href="ADindex.php?categoria=promocional" class="text-decoration-none">Promocional</a></li>
                </ul>
            </div>


            <div class="col-lg-9 col-md-8 col-sm-12">
                <div class="row g-4">
                    <?php
                    if (file_exists("productos.json")) {
                        $contenido = file_get_contents("productos.json");
                        $productos = json_decode($contenido, true) ?? [];

                        // Capturar filtro de categoría desde la URL
                        $categoria_filtro = $_GET['categoria'] ?? '';

                        foreach ($productos as $producto) {
                            // Filtrar productos por categoría
                            if (!empty($categoria_filtro) && $producto['categoria'] !== $categoria_filtro) {
                                continue;
                            }

                            $ubicacion = "img/productos/" . $producto['imagen'];
                            echo "<div class='col-lg-4 col-md-6 col-sm-12'>";
                            echo "<div class='card'>";
                            echo "<img class='card-img-top' src='$ubicacion' alt='Imagen del producto'>";
                            echo "<div class='card-body'>";
                            echo "<h5 class='card-title'>" . $producto['nombre'] . "</h5>";
                            echo "<p class='card-text'>" . $producto['descripcion'] . "</p>";
                            echo "<p class='card-text'><strong>Precio:</strong> $" . $producto['precio'] . "</p>";
                            echo "<p class='card-text'><strong>Existencias:</strong> " . $producto['existencias'] . "</p>";
                            echo "<p class='card-text'><strong>Codigo:</strong> " . $producto['codigo'] . "</p>";

                            //botones editar y eliminar
                            echo "<a href='editar.php?codigo=" . $producto['codigo'] . "' class='btn btn-editar btn-sm'>Editar</a> ";
                            echo "<a href='eliminar.php?codigo=" . $producto['codigo'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Seguro que quieres eliminar este producto?\");'>Eliminar</a>";


                            echo "</div></div></div>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>