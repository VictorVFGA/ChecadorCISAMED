<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir el archivo de conexión a la base de datos
    include('conexion.php');

    // Obtener los datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consultar la base de datos para verificar las credenciales y obtener el rol
    $query = "SELECT * FROM datos_emple WHERE username = '$username' AND id_emple = '$password'";
    $result = $conexion->query($query);

    if ($result && $result->num_rows > 0) {
        // Credenciales válidas, redirigir según el rol
        $fila = $result->fetch_assoc();
        if ($fila['rol'] == 'empleado') {
            header("Location: empleadoInterface.php");
            exit(); // Terminar la ejecución del script después de la redirección
        } elseif ($fila['rol'] == 'admin') {
            header("Location: adminInterface.php");
            exit(); // Terminar la ejecución del script después de la redirección
        } else {
            echo "<script>alert('Rol no reconocido.');</script>";
        }
    } else {
        // Credenciales incorrectas
        echo "<script>alert('Usuario o contraseña incorrectos.');</script>";
    }

    // Cerrar la conexión a la base de datos
    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="estilos/estilos_login.css">
    <link rel="icon" href="/logo.jpeg" type="image/jpeg">
</head>
<body>
    <div class="pagina">
        <div class="container">
            <h2>Iniciar Sesión</h2>
            
            <form method="post" action="">
                <label for="username">Usuario:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Iniciar Sesión</button>
            </form>
            
            <!-- Botón para regresar a /checador.php -->
            <a href="/checador.php"><button>Regresar</button></a>
        </div>
    </div>
</body>
</html>
