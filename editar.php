<?php
session_start();
if(empty($_SESSION["user"])){
    header("Location: login.php");
    exit();
}

// Cargar JSON
$archivo_json = "productos.json";
$productos = json_decode(file_get_contents($archivo_json), true) ?? [];

// Verificar si se recibió un código por GET
if (!isset($_GET['codigo'])) {
    echo "Código de producto no recibido.";
    exit();
}

$codigo_producto = $_GET['codigo'];
$producto_encontrado = null;

// Buscar el producto en el JSON
foreach ($productos as $producto) {
    if ($producto['codigo'] === $codigo_producto) {
        $producto_encontrado = $producto;
        break;
    }
}

// Si no se encuentra el producto, mostrar mensaje de error
if (!$producto_encontrado) {
    echo "Producto no encontrado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/ADMINstyles.css">
</head>
<body>
    <h1 class="text-center">Editar Producto</h1>
    <div class="container">

        <form method="POST" action="procesar_edicion.php" enctype="multipart/form-data" class="mt-4">
            <input type="hidden" name="codigo" value="<?php echo $producto_encontrado['codigo']; ?>">

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" required value="<?php echo $producto_encontrado['nombre']; ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <input type="text" name="descripcion" class="form-control" required value="<?php echo $producto_encontrado['descripcion']; ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Categoría</label>
                <select name="categoria" class="form-select">
                    <option value="textil" <?php echo ($producto_encontrado['categoria'] === "textil") ? "selected" : ""; ?>>Textil</option>
                    <option value="promocional" <?php echo ($producto_encontrado['categoria'] === "promocional") ? "selected" : ""; ?>>Promocional</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Precio</label>
                <input type="number" step="0.01" name="precio" class="form-control" required value="<?php echo $producto_encontrado['precio']; ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Existencias</label>
                <input type="number" name="existencias" class="form-control" required value="<?php echo $producto_encontrado['existencias']; ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Imagen actual</label><br>
                <img src="img/productos/<?= $producto_encontrado['imagen']; ?>" width="150">
            </div>

            <div class="mb-3">
                <label class="form-label">Subir nueva imagen (opcional)</label>
                <input type="file" name="imagen" class="form-control">
            </div>

            <button type="submit" class="btn btn-success w-100">Guardar Cambios</button>
        </form>
    </div>
</body>

</html>