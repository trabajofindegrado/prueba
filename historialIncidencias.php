<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

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
    <title>Historial de Incidencias</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h2>Historial de incidencias solucionadas</h2>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Título</th>
            <th>Descripción</th>
            <th>Prioridad</th>
            <th>Fecha de creación</th>
            <th>Usuario</th>
            <th>Fecha de cierre</th>
        </tr>

        <?php
        $sql = "SELECT * FROM historialIncidencia ORDER BY FechaCierre DESC";
        $resultado = $conn->query($sql);

        if ($resultado && $resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($fila['Título']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['Descripción']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['Prioridad']) . "</td>";
                echo "<td>" . date('d-m-Y H:i', strtotime($fila['FechaCreación'])) . "</td>";
                echo "<td>" . htmlspecialchars($fila['NombreUsuario']) . "</td>";
                echo "<td>" . date('d-m-Y H:i', strtotime($fila['FechaCierre'])) . "</td>";
                echo "</tr>";

                $sqlComentarios = "SELECT NombreUsuario, Comentario, FechaComentario 
                                   FROM comentarios 
                                   WHERE IdHistorial = ?";
                $stmt = $conn->prepare($sqlComentarios);
                $stmt->bind_param("i", $fila['id']);
                $stmt->execute();
                $comentarios = $stmt->get_result();

                if ($comentarios->num_rows > 0) {
                    echo "<tr><td colspan='6'><strong>Comentarios:</strong><ul>";
                    while ($c = $comentarios->fetch_assoc()) {
                        echo "<li><strong>" . htmlspecialchars($c['NombreUsuario']) . "</strong>: " .
                             htmlspecialchars($c['Comentario']) .
                             " <em>(" . date('d-m-Y H:i', strtotime($c['FechaComentario'])) . ")</em>";
                    }
                    echo "</ul></td></tr>";
                } else {
                    echo "<tr><td colspan='6'><em>No existe ningún comentario.</em></td></tr>";
                }

                $stmt->close();
            }
        } else {
            echo "<tr><td colspan='6'>Sin incidencias cerradas todavía.</td></tr>";
        }

        $conn->close();
        ?>
    </table>

    <p><a href="panel.php" class="btn">Volver a la página principal</a></p>
</body>
</html>

