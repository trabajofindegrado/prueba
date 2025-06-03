<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registro de usuario</title>
</head>
<body>
    <h2>Registro de usuario</h2>
    <form action="procesoFormulario.php" method="POST">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Contraseña:</label><br>
        <input type="password" name="password" required><br><br>

        <label>Rol:</label><br>
        <select name="rol">
            <option value="usuario">Usuario</option>
            <option value="admin">Administrador</option>
        </select><br><br>

        <input type="submit" value="Registrar">
    </form>
</body>
</html>
