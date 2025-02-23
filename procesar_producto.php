<?php
session_start();

$codigo = $_POST['codigo'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$categoria = $_POST['categoria'];
$precio = $_POST['precio'];
$existencias = $_POST['existencias'];

// Capturar la imagen
$imagen_nombre = $_FILES['imagen']['name'];
$imagen_tmp = $_FILES['imagen']['tmp_name'];

$errores = [];

// Validar código con regex
function codigo_producto($var) {
    return preg_match('/^PROD[0-9]{4}$/', $var);
}

if (!codigo_producto($codigo)) {
    $errores[] = "El código debe seguir el formato PROD0001.";
}


$archivo_json = "productos.json";
$productos = [];

if (file_exists($archivo_json)) {
    $contenido = file_get_contents($archivo_json);
    $productos = json_decode($contenido, true) ?? [];
}



// Verificar si el código ya existe
foreach ($productos as $producto) {
    if ($producto['codigo'] === $codigo) {
        $errores[] = "El producto con ese código ya está registrado.";
        break;
    }
}

// Validar datos
if (!is_numeric($precio) || $precio <= 0) {
    $errores[] = "El precio debe ser un número positivo.";
}
if (!is_numeric($existencias) || $existencias < 0) {
    $errores[] = "Las existencias deben ser mayores o iguales a 0.";
}

//Si hay errores, volver a agregar.php con los datos
if (!empty($errores)) {
    $_SESSION['data'] = [
        'codigo' => $codigo,
        'nombre' => $nombre,
        'descripcion' => $descripcion,
        'categoria' => $categoria,
        'precio' => $precio,
        'existencias' => $existencias
    ];
    $_SESSION['errores'] = $errores;
    header('Location: agregar.php');
    exit();
}

// Manejo de la imagen con numeración
$imagen_nombre = $codigo . "." . pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
$ruta_destino = "img/productos/" . $imagen_nombre;
move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_destino);

// Agregar el nuevo producto al JSON
$nuevo_producto = [
    "codigo" => $codigo,
    "nombre" => $nombre,
    "descripcion" => $descripcion,
    "categoria" => $categoria,
    "precio" => $precio,
    "existencias" => $existencias,
    "imagen" => $imagen_nombre
];

$productos[] = $nuevo_producto;
file_put_contents($archivo_json, json_encode($productos, JSON_PRETTY_PRINT));

unset($_SESSION['data']);
unset($_SESSION['errores']);

header("Location: ADindex.php");
exit();
