<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require 'db.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: inicioSesion.php");
    exit();
}

$Titulo = $_POST['Titulo'];
$Descripcion = $_POST['Descripcion'];
$Prioridad = $_POST['Prioridad'];
$Categoria = $_POST['Categoría'];
$Estado = 'abierta'; // por defecto
$Fecha_creacion = date('Y-m-d H:i:s');

$sql_id = "SELECT id FROM usuarios WHERE Nombre = ?";
$stmt_id = $conn->prepare($sql_id);
$stmt_id->bind_param("s", $_SESSION['usuario']);
$stmt_id->execute();
$result = $stmt_id->get_result();
$usuario = $result->fetch_assoc();
$Id_usuario = $usuario['id'];

$sql = "INSERT INTO incidencias (Título, Descripción, Estado, Prioridad, Categoria,  FechaCreación, IdUsuario)
        VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssi", $Titulo, $Descripcion, $Estado, $Prioridad, $Categoria,  $Fecha_creacion, $Id_usuario);

if ($stmt->execute()) {
    echo "Incidencia creada, espere a que uno de nuestros técnicos la revise y solucione.";
} else {
    echo "Error al crear la incidencia: " . $conn->error;
}

$conn->close();
?>

