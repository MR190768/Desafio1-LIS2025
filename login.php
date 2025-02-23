<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif, sans-serif;
            background: rgb(153, 47, 4);
            background: radial-gradient(circle, rgba(153, 47, 4, 1) 0%, rgba(0, 1, 144, 1) 100%);
            margin: 0;
            padding: 0;
        }
    </style>
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 p-5">
                <div class="card">
                    <?php
                    session_start();
                    $error = $_SESSION['mensaje'] ?? [];
                    session_unset();
                    if (!empty($error)) {
                        echo "<div class='alert alert-danger'>";
                        echo "<p>".$error."</p>";
                        echo "</div>";
                    }

                    ?>
                    <div class="card-header text-center">
                        <img src="img/recursos/Black.png" alt="Logo de la Tienda" style="height: 225px; width: 250px;">
                        <h3 class="mt-3">Iniciar sesión</h3>
                    </div>
                    <div class="card-body">
                        <form action="procesar_login.php" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">Usuario:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Entrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>