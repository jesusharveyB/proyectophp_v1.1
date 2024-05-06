<?php
include_once "./conexion.php";

$codigo = $_GET['codigo'] ?? '';

if (empty($codigo)) {
    // Manejar el error
    echo "Código de producto no válido.";
    exit();
}

// Eliminar el producto de la base de datos
$sql = "DELETE FROM producto WHERE codigo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $codigo);

if ($stmt->execute()) {
    echo "Producto eliminado correctamente.";
} else {
    echo "Error al eliminar el producto: " . $stmt->error;
}

$stmt->close();
$conn->close();

// Redirigir de vuelta a la página principal
header("Location: home.php");
exit();
?>
