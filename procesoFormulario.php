<?php
require 'db.php';

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$rol = $_POST['rol'];

$sql = "INSERT INTO usuarios (Nombre, Email, Contraseña, Rol) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $nombre, $email, $password, $rol);

if ($stmt->execute()) {
    echo "Usuario registrado con éxito.";
} else {
    echo "Error al registrar usuario: " . $conn->error;
}

$conn->close();
?>

