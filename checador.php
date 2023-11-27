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

                // Obtener el registro más reciente de empleados
                $query_latest_emple = "SELECT id_emple, fec_hor FROM regis_ingreso ORDER BY id_reg DESC LIMIT 1";
                $result_latest_emple = $conexion->query($query_latest_emple);

                // Obtener el registro más reciente de alumnos
                $query_latest_alum = "SELECT IDAlumn, asi_dia_hora FROM asistencia_alum ORDER BY idAsist DESC LIMIT 1";
                $result_latest_alum = $conexion->query($query_latest_alum);

                // Verificar cuál de los dos registros es más reciente
                if ($result_latest_emple && $result_latest_alum) {
                    $latest_emple = $result_latest_emple->fetch_assoc();
                    $latest_alum = $result_latest_alum->fetch_assoc();

                    $hora_registro_emple = strtotime($latest_emple["fec_hor"]);
                    $hora_registro_alum = strtotime($latest_alum["asi_dia_hora"]);
                    $hora_actual = time();

                    // Verificar cuál es el registro más reciente y si cumple con el tiempo máximo
                    if (($hora_actual - $hora_registro_emple < 30) && ($hora_registro_emple > $hora_registro_alum)) {
                        // Consulta para obtener el nombre del empleado
                        $query_nombre_emple = "SELECT DISTINCT datos_emple.nombre_emple
                                               FROM datos_emple
                                               JOIN regis_ingreso ON datos_emple.Id_emple = regis_ingreso.id_emple
                                               WHERE datos_emple.Id_emple = '{$latest_emple["id_emple"]}'";
                        $result_nombre_emple = $conexion->query($query_nombre_emple);

                        echo '<div id="contenido">';
                        if ($result_nombre_emple && $result_nombre_emple->num_rows > 0) {
                            $fila_nombre_emple = $result_nombre_emple->fetch_assoc();
                            echo "<h2>Hola, bienvenido: </h2>";
                            echo  $fila_nombre_emple["nombre_emple"];
                            echo "<br>";
                            echo "<br>";
                            echo "Ingreso registrado: " . $latest_emple["fec_hor"];
                            echo "<br>";
                            echo "<br>";

                        } else {
                            echo "<h2>Bienvenido visitante</h2>";
                            echo "ID tarjeta:" .$latest_emple["id_emple"];
                            echo "<br>";
                            echo "<br>";
                            echo "Ingreso registrado: " . $latest_emple["fec_hor"];
                            echo "<br>";
                            echo "<br>";
                        }
                        echo '</div>';
                    } elseif ($hora_actual - $hora_registro_alum < 30) {
                        // Consulta para obtener el nombre del alumno
                        $query_nombre_alum = "SELECT DISTINCT datos_alumno.NombreAlum
                                              FROM datos_alumno
                                              JOIN asistencia_alum ON datos_alumno.IDAlumn = asistencia_alum.IDAlumn
                                              WHERE datos_alumno.IDAlumn = '{$latest_alum["IDAlumn"]}'";
                        $result_nombre_alum = $conexion->query($query_nombre_alum);

                        echo '<div id="contenido">';
                        if ($result_nombre_alum && $result_nombre_alum->num_rows > 0) {
                            $fila_nombre_alum = $result_nombre_alum->fetch_assoc();
                            echo "<h2>Hola, bienvenido: </h2>";
                            echo  $fila_nombre_alum["NombreAlum"];
                            echo "<br>";
                            echo "<br>";
                            echo "Ingreso registrado: " . $latest_alum["asi_dia_hora"];
                            echo "<br>";
                            echo "<br>";

                        } else {
                            echo "<h2>Bienvenido visitante</h2>";
                            echo "ID tarjeta:" .$latest_alum["IDAlumn"];
                            echo "<br>";
                            echo "<br>";
                            echo "Ingreso registrado: " . $latest_alum["asi_dia_hora"];
                            echo "<br>";
                            echo "<br>";
                        }
                        echo '</div>';
                    } else {
                        echo '<div id="contenido">CISAMED: <br>Esperando Usuarios</div>';
                    }
                } else {
                    echo "No se encontró ningún registro.";
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
