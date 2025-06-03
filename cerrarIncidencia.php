<?php
session_start();
require 'db.php';

if ($_SESSION['rol'] !== 'admin') {
    echo "Acceso prohibido para usuarios.";
    exit();
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql_select = "SELECT i.Título, i.Descripción, i.Prioridad, i.FechaCreación, i.IdUsuario, u.Nombre 
                   FROM incidencias i 
                   JOIN usuarios u ON i.IdUsuario = u.id 
                   WHERE i.id = ?";
    $stmt_select = $conn->prepare($sql_select);
    $stmt_select->bind_param("i", $id);
    $stmt_select->execute();
    $resultado = $stmt_select->get_result();

    if ($resultado->num_rows === 1) {
        $incidencia = $resultado->fetch_assoc();

        $sql_insert = "INSERT INTO historialIncidencia 
            (Título, Descripción, Prioridad, FechaCreación, IdUsuario, NombreUsuario, FechaCierre)
            VALUES (?, ?, ?, ?, ?, ?, NOW())";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param(
            "ssssis",
            $incidencia['Título'],
            $incidencia['Descripción'],
            $incidencia['Prioridad'],
            $incidencia['FechaCreación'],
            $incidencia['IdUsuario'],
            $incidencia['Nombre']
        );
        $stmt_insert->execute();
        $stmt_insert->close();

        $sql_delete = "DELETE FROM incidencias WHERE id = ?";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bind_param("i", $id);
        $stmt_delete->execute();
        $stmt_delete->close();

        header("Location: listadoIncidencias.php");
        exit();
    } else {
        echo "No se ha localizado la incidencia.";
    }

    $stmt_select->close();
} else {
    echo "Identifiación de incidencia.";
}

$conn->close();
?>

