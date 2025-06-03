<?php
session_start();
require 'db.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: inicioSesion.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Comentario'], $_POST['IdHistorial'])) {
    $idHistorial = $_POST['IdHistorial'];
    $comentario = $_POST['Comentario'];
    $usuario = $_SESSION['usuario'];

    $sql = "INSERT INTO comentarios (IdHistorial, NombreUsuario, Comentario)
            VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $idHistorial, $usuario, $comentario);

    if ($stmt->execute()) {
        header("Location: comentario.php");
        exit();
    } else {
        echo "No pudo guardarse el comentario por: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>

