<?php
session_start();

$archivo_json = "productos.json";
$productos = json_decode(file_get_contents($archivo_json), true) ?? [];

if (!isset($_GET['codigo'])) {
    $_SESSION['mensaje'] = "Código de producto no proporcionado.";
    header("Location: index.php");
    exit();
}

$codigo = $_GET['codigo'];
$nuevo_array = [];

// Buscar y eliminar el producto
foreach ($productos as $producto) {
    if ($producto['codigo'] === $codigo) {
        // Eliminar la imagen asociada
        $ruta_imagen = "imagenes/" . $producto['imagen'];
        if (file_exists($ruta_imagen)) {
            unlink($ruta_imagen);
        }
        continue; // Omitir este producto en el nuevo array
    }
    $nuevo_array[] = $producto;
}

// Guardar el nuevo array sin el producto eliminado
file_put_contents($archivo_json, json_encode($nuevo_array, JSON_PRETTY_PRINT));

$_SESSION['mensaje'] = "Producto eliminado correctamente.";
header("Location: ADindex.php");
exit();
?>
    