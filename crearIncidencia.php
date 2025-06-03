<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: inicioSesion.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Crear Incidencia</title>
</head>
<body>
    <h2>Crear nueva incidencia</h2>
    <form action="procesoIncidencia.php" method="POST">
        <label>Título:</label><br>
        <input type="text" name="Titulo" required><br><br>

        <label>Descripción:</label><br>
        <textarea name="Descripcion" required></textarea><br><br>

        <label>Prioridad:</label><br>
        <select name="Prioridad" required>
            <option value="baja">Baja</option>
            <option value="media">Media</option>
            <option value="alta">Alta</option>
            
        <label>Categoria:</label><br>
	<select name="Categoria" required>
    		<option value="hardware">Hardware</option>
    		<option value="software">Software</option>
    		<option value="redes">Redes</option>
    		<option value="otros">Otros</option>
    		
</select><br><br>

        </select><br><br>

        <input type="submit" value="Crear incidencia">
    </form>

    <p><a href="panel.php">Volver al panel</a></p>
</body>
</html>

