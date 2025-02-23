<?php
session_start();

$archivo_json = "productos.json";
$productos = json_decode(file_get_contents($archivo_json), true) ?? [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $categoria = $_POST['categoria'];
    $precio = $_POST['precio'];
    $existencias = $_POST['existencias'];

    // Buscar el producto en el JSON
    foreach ($productos as &$producto) {
        if ($producto['codigo'] === $codigo) {
            $producto['nombre'] = $nombre;
            $producto['descripcion'] = $descripcion;
            $producto['categoria'] = $categoria;
            $producto['precio'] = $precio;
            $producto['existencias'] = $existencias;

            // Manejo de imagen
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
                $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
                $nombre_imagen = $codigo . "." . $extension;
                $ruta_destino = "img/productos/" . $nombre_imagen;

                move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_destino);
                $producto['imagen'] = $nombre_imagen;
            }
            break;
        }
    }

    // Guardar cambios en el JSON
    file_put_contents($archivo_json, json_encode($productos, JSON_PRETTY_PRINT));

    $_SESSION['mensaje'] = "Producto actualizado correctamente.";
    header("Location: ADindex.php");
    exit();
}
?>
