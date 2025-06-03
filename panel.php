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
    <title>Centro de incidencias</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h2>Bienvenido, <?php echo $_SESSION['usuario']; ?> (<?php echo $_SESSION['rol']; ?>)</h2>

    <p><a href="crearIncidencia.php" class="btn">Nueva incidencia</a></p>
    <p><a href="listadoIncidencias.php" class="btn">Listado de incidencias</a></p>
    <p><a href="comentario.php" class="btn">Comentarios de soluciones</a></p>
    <p><a href="historialIncidencias.php" class="btn">Historial de incidencias</a></p>
    <p><a href="cerrarSesion.php" class="btn">Cerrar sesión</a></p>
</body>
</html>

