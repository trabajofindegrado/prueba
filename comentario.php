<?php
session_start();
require 'db.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: inicioSesion.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Comentarios de soluciones</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h2>Comentarios sobre soluciones de incidencias</h2>

    <?php
    // Obtener historial de incidencias cerradas
    $sql = "SELECT id, Título FROM historialIncidencia ORDER BY FechaCierre DESC";
    $result = $conn->query($sql);

    while ($fila = $result->fetch_assoc()) {
        echo "<h3>" . htmlspecialchars($fila['Título']) . "</h3>";

        // Comentarios para esta incidencia
        $sqlComentarios = "SELECT NombreUsuario, Comentario, FechaComentario FROM comentarios WHERE IdHistorial = ?";
        $stmt = $conn->prepare($sqlComentarios);
        $stmt->bind_param("i", $fila['id']);
        $stmt->execute();
        $comentarios = $stmt->get_result();

        if ($comentarios->num_rows > 0) {
            echo "<ul>";
            while ($c = $comentarios->fetch_assoc()) {
                echo "<li><strong>" . htmlspecialchars($c['NombreUsuario']) . ":</strong> " . 
                     htmlspecialchars($c['Comentario']) . " <em>(" . $c['FechaComentario'] . ")</em></li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No hay comentarios aún.</p>";
        }

        // Formulario para agregar comentario
        echo '
        <form action="comentarioNuevo.php" method="POST">
            <input type="hidden" name="IdHistorial" value="' . $fila['id'] . '">
            <textarea name="Comentario" rows="3" cols="50" placeholder="Escribe tu comentario..." required></textarea><br>
            <input type="submit" value="Añadir comentario" class="btn">
        </form><hr>';
    }

    $conn->close();
    ?>

    <p><a href="panel.php" class="btn">Volver a la página principal</a></p>
</body>
</html>

