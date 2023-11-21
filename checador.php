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
                // Incluir el archivo de conexión a la base de datos
                include('conexion.php');

                // Obtener el ID del empleado más reciente
                $query_latest_id = "SELECT id_emple FROM regis_ingreso ORDER BY id_reg DESC LIMIT 1";
                $result_latest_id = $conexion->query($query_latest_id);

                if ($result_latest_id && $result_latest_id->num_rows > 0) {
                    $fila_latest_id = $result_latest_id->fetch_assoc();
                    $id_empleado = $fila_latest_id["id_emple"];

                    // Consulta para obtener el nombre del empleado
                    $query_nombre = "SELECT DISTINCT datos_emple.nombre_emple
                                     FROM datos_emple
                                     JOIN regis_ingreso ON datos_emple.Id_emple = regis_ingreso.id_emple
                                     WHERE datos_emple.Id_emple = '$id_empleado'";
                    $result_nombre = $conexion->query($query_nombre);
                    $query_hora = "SELECT fec_hor FROM regis_ingreso WHERE id_emple = '$id_empleado' ORDER BY id_reg DESC LIMIT 1";
                    $result_hora = $conexion->query($query_hora);

                    echo '<div id="contenido">';
                    if ($result_nombre && $result_nombre->num_rows > 0) {
                        $fila_nombre = $result_nombre->fetch_assoc();
                        echo "<h2>Hola, bienvenido: </h2>";
                        echo  $fila_nombre["nombre_emple"];
                        echo "<br>";
                        echo "<br>";
                        $fila_hora = $result_hora->fetch_assoc(); 
                        echo "Ingreso registrado: " . $fila_hora["fec_hor"];
                        echo "<br>";
                        echo "<br>";

                    } else {
                        echo "<h2>Bienvenido visitante</h2>";
                        echo "ID tarjeta:" .$id_empleado ;
                        echo "<br>";
                        echo "<br>";
                        $fila_hora = $result_hora->fetch_assoc(); 
                        echo "Ingreso registrado: " . $fila_hora["fec_hor"];
                        echo "<br>";
                        echo "<br>";
                    }
                    echo '</div>';

                } else {
                    echo "No se encontró ningún ID de empleado.";
                }

                // Cerrar la conexión a la base de datos
                $conexion->close();
            ?>
        </div>

        <div class="cont2">
            <?php
                // Elimina la línea correspondiente al botón "Aceptar"
                echo '<button onclick="recargar()">Actualizar</button>';
                echo '<a href="reporte_empleados.php"><button>Asistencia del día</button></a>';
                echo '<a href="consulta.php"><button>Consultar por fecha</button></a>';
                echo '<a href="consulta_empleados.php"><button>Consulta por Empleado</button></a>';
            ?>
        </div>
    </div>

    <script>
        function limpiar() {
            document.getElementById('contenido').innerHTML = "";
        }

        function recargar() {
            // Recarga la página después de 4 segundos
            setTimeout(function() {
                location.reload();
            }, 3000);
        }

        // Llama a recargar() al cargar la página
        window.onload = recargar;
    </script>
</body>
</html>
