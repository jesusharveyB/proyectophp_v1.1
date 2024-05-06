<?php
session_start();

// Verificar si el usuario ya está autenticado
if (isset($_SESSION["user"])) {
    header("Location: index.php");
    exit();
}

// Verificar si se ha enviado el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = "usuario"; // Cambia por el nombre de usuario real
    $password = "contraseña"; // Cambia por la contraseña real

    if ($_POST["username"] == $username && $_POST["password"] == $password) {
        $_SESSION["user"] = $username;
        header("Location: index.php");
        exit();
    } else {
        $error_message = "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
</head>

<body>
    <h1>Iniciar Sesión</h1>
    <?php if (isset($error_message)) : ?>
        <p><?= $error_message ?></p>
    <?php endif; ?>
    <form method="post">
        <label for="username">Usuario:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br>
        <button type="submit">Iniciar Sesión</button>
    </form>
</body>

</html>
