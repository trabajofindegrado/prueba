<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
</head>
<body>
    <h2>Iniciar sesión</h2>
    <form action="verificarSesion.php" method="POST">
        <label>Email:</label><br>
        <input type="email" name="Email" required><br><br>

        <label>Contraseña:</label><br>
        <input type="password" name="Contraseña" required><br><br>

        <input type="submit" value="Entrar">
    </form>
</body>
</html>

