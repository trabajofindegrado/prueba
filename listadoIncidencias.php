<?php
session_start();
require 'db.php';

if ($_SESSION['rol'] !== 'admin') {
    echo "Acceso prohibido para usuarios.";
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Listado de Incidencias</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h2>Listado de incidencias</h2>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Título</th>
            <th>Descripción</th>
            <th>Estado</th>
            <th>Prioridad</th>
            <th>Categoría</th>
            <th>Fecha de creación</th>
            <th>Usuario</th>
            <th>Solucionar Incidencia</th>
        </tr>

        <?php
        $sql = "SELECT i.id, i.Título, i.Descripción, i.Estado, i.Prioridad, i.Categoría, i.FechaCreación, u.Nombre  
                FROM incidencias i 
                JOIN usuarios u ON i.IdUsuario = u.id";

        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($fila['Título']) . "</td>";
    echo "<td>" . htmlspecialchars($fila['Descripción']) . "</td>";
    echo "<td>" . htmlspecialchars($fila['Estado']) . "</td>";
    echo "<td>" . htmlspecialchars($fila['Prioridad']) . "</td>";
    echo "<td>" . htmlspecialchars($fila['Categoría']) . "</td>";
    echo "<td>" . date('d-m-Y H:i', strtotime($fila['FechaCreación'])) . "</td>";
    echo "<td>" . htmlspecialchars($fila['Nombre']) . "</td>";

    	if ($fila['Estado'] === 'abierta') {
        	echo "<td>
    			<form action='cerrarIncidencia.php' method='POST' style='display:inline;'>
        		<input type='hidden' name='id' value='" . $fila['id'] . "'>
        		<input type='submit' value='Cerrar' onclick='return confirm(\"¿Estás seguro de que quieres cerrar esta incidencia?\");'>
    			</form>
		</td>";

    } else {
        echo "<td>-</td>";
    }

    echo "</tr>";
}

        } else {
            echo "<tr><td colspan='6'>No hay incidencias registradas.</td></tr>";
        }

        $conn->close();
        ?>
    </table>

    <p><a href="panel.php">Volver al panel</a></p>
</body>
</html>


