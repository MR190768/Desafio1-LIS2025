<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $users = json_decode(file_get_contents("usuarios.json"), true);

    session_start();
    foreach ($users as $user) {
        if ($user["username"] === $username && $user["password"] === $password) {
            $_SESSION["user"] = $username;
            header("Location: ADindex.php");
            exit();
        } else {
            $_SESSION["mensje"] == "Usuario o contraseña no validos";
            header("Location: login.php");
            exit();
        }
    }
}
