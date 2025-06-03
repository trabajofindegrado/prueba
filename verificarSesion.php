<?php
session_start();
require 'db.php';

$Email = $_POST['Email'];
$Contraseña = $_POST['Contraseña'];

$sql = "SELECT * FROM usuarios WHERE Email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $Email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $usuario = $result->fetch_assoc();

    if (password_verify($Contraseña, $usuario['Contraseña'])) {
        $_SESSION['usuario'] = $usuario['Nombre'];
        $_SESSION['rol'] = $usuario['Rol'];

        header("Location: panel.php");
exit();
    } else {
        echo " Contraseña incorrecta.";
    }
} else {
    echo " No se encontró ningún usuario con el correo que especificas.";
}

$conn->close();
?>

