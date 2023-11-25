<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
    <link rel="stylesheet" href="estilos/estilos_checador.css">
    
    
    <link rel="icon" href="/ima.png" type="image/png">
</head>
<body>
    <div class="pagina">
        <div class="container">
            <?php
                // Set the default time zone to America/Mexico_City
                date_default_timezone_set('America/Mexico_City');

                // Incluir el archivo de conexión a la base de datos
                include('conexion.php');

                // Obtener el ID del empleado más reciente
                $query_latest_id = "SELECT id_emple, fec_hor FROM regis_ingreso ORDER BY id_reg DESC LIMIT 1";
                $result_latest_id = $conexion->query($query_latest_id);

                if ($result_latest_id && $result_latest_id->num_rows > 0) {
                    $fila_latest_id = $result_latest_id->fetch_assoc();
                    $id_empleado = $fila_latest_id["id_emple"];
                    $hora_registro = strtotime($fila_latest_id["fec_hor"]);
                    $hora_actual = time();

                    // Verificar si el registro es reciente (dentro de 1 minuto)
                    if ($hora_actual - $hora_registro < 30) {
                        // Consulta para obtener el nombre del empleado
                        $query_nombre = "SELECT DISTINCT datos_emple.nombre_emple
                                         FROM datos_emple
                                         JOIN regis_ingreso ON datos_emple.Id_emple = regis_ingreso.id_emple
                                         WHERE datos_emple.Id_emple = '$id_empleado'";
                        $result_nombre = $conexion->query($query_nombre);

                        echo '<div id="contenido">';
                        if ($result_nombre && $result_nombre->num_rows > 0) {
                            $fila_nombre = $result_nombre->fetch_assoc();
                            echo "<h2>Hola, bienvenido: </h2>";
                            echo  $fila_nombre["nombre_emple"];
                            echo "<br>";
                            echo "<br>";
                            echo "Ingreso registrado: " . $fila_latest_id["fec_hor"];
                            echo "<br>";
                            echo "<br>";

                        } else {
                            echo "<h2>Bienvenido visitante</h2>";
                            echo "ID tarjeta:" .$id_empleado ;
                            echo "<br>";
                            echo "<br>";
                            echo "Ingreso registrado: " . $fila_latest_id["fec_hor"];
                            echo "<br>";
                            echo "<br>";
                        }
                        echo '</div>';
                    } else {
                        echo '<div id="contenido">CISAMED: <br>Esperando Usuarios</div>';
                    }
                } else {
                    echo "No se encontró ningún ID de empleado.";
                }

                // Cerrar la conexión a la base de datos
                $conexion->close();
            ?>
        </div>

        <div class="cont2">
            <?php
                // Mostrar solo el botón de iniciar sesión
                echo '<button onclick="iniciarSesion()">Iniciar Sesión</button>';
            ?>
        </div>
    </div>

    <script>
        function limpiar() {
            document.getElementById('contenido').innerHTML = "";
        }

        function recargar() {
            // Recarga la página después de 3 segundos
            setTimeout(function() {
                location.reload();
            }, 3000);
        }

        // Llama a recargar() al cargar la página
        window.onload = recargar;

        // Función para redirigir a login.php al hacer clic en "Iniciar Sesión"
        function iniciarSesion() {
            // Redirigir a login.php
            window.location.href = 'login.php';
        }
    </script>
</body>
</html>

