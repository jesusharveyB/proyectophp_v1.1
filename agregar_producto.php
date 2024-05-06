<?php
include_once("./conexion.php");

$codigo = $_POST["codigo"] ?? "";
$nombre = $_POST["nombre"] ?? "";
$precio = $_POST["precio"] ?? "";
$cantidad = $_POST["cantidad"] ?? "";

// Validar que los campos no estén vacíos
if (empty($codigo) || empty($nombre) || empty($precio) || empty($cantidad)) {
    // Manejar el error (por ejemplo, mostrar un mensaje de error)
    echo "Todos los campos son obligatorios.";
    exit();
}

// Insertar los datos en la tabla
$sql = "INSERT INTO producto (codigo, nombre, precio, cantidad) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssii", $codigo, $nombre, $precio, $cantidad);

if ($stmt->execute()) {
    echo "Producto agregado correctamente.";
} else {
    echo "Error al agregar el producto: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
