<!DOCTYPE html>
<html>
<head>
    <title>Consulta de Asistencia por Empleado</title>
    <link rel="stylesheet" href="estilos/estilos_consultaEmpleados.css">
</head>
<body>
    <div class="container">
        <h2>Consulta por Empleado</h2>
        <form method="POST" action="">
            <label for="empleado">Selecciona un empleado:</label>
            <select id="empleado" name="empleado_consulta">
                <?php
                // Incluir el archivo de conexión
                include('conexion.php');

                // Consulta para obtener los nombres de los empleados
                $query_nombres = "SELECT DISTINCT nombre_emple, Id_emple FROM datos_emple";
                $result_nombres = $conexion->query($query_nombres);

                if ($result_nombres && $result_nombres->num_rows > 0) {
                    while ($fila_nombre = $result_nombres->fetch_assoc()) {
                        echo "<option value='" . $fila_nombre["Id_emple"] . "'>" . $fila_nombre["nombre_emple"] . "</option>";
                    }
                }
                ?>
            </select>
            
            <label for="mes">Selecciona un mes:</label>
            <select id="mes" name="mes_consulta">
                <?php
                // Obtener los meses disponibles
                $query_meses = "SELECT DISTINCT DATE_FORMAT(fec_hor, '%M %Y') as mes FROM regis_ingreso";
                $result_meses = $conexion->query($query_meses);

                if ($result_meses && $result_meses->num_rows > 0) {
                    while ($fila_mes = $result_meses->fetch_assoc()) {
                        echo "<option value='" . date('m Y', strtotime($fila_mes["mes"])) . "'>" . $fila_mes["mes"] . "</option>";
                    }
                }
                ?>
            </select>

            <br>
            <br>
            <input type="submit" value="Consultar"> 
        </form>
        <br>
        <a href="checador.php"><button>Regresar</button></a>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['empleado_consulta'])) {
                $id_empleado = $_POST['empleado_consulta'];
                $mes_consulta = $_POST['mes_consulta'];

                // Consulta para obtener los registros de asistencia del empleado y mes seleccionados
                $sql = "SELECT datos_emple.nombre_emple, datos_emple.Id_emple, regis_ingreso.fec_hor 
                        FROM datos_emple 
                        JOIN regis_ingreso ON datos_emple.Id_emple = regis_ingreso.id_emple 
                        WHERE datos_emple.Id_emple = '$id_empleado' AND DATE_FORMAT(regis_ingreso.fec_hor, '%m %Y') = '$mes_consulta'";

                $result_asistencia = $conexion->query($sql);

                if ($result_asistencia && $result_asistencia->num_rows > 0) {
                    echo "<h2>Resultados para el empleado y mes seleccionados:</h2>";
                    echo "<table border='1'>";
                    echo "<tr><th>Nombre</th><th>ID</th><th>Fecha y Hora</th></tr>";
                    while ($fila_asistencia = $result_asistencia->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $fila_asistencia["nombre_emple"] . "</td>";
                        echo "<td>" . $fila_asistencia["Id_emple"] . "</td>";
                        echo "<td>" . $fila_asistencia["fec_hor"] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "<br>";
                    echo "<br>";

                    // Agregar botón para descargar CSV
                    echo '<form method="POST" action="descargar_csv_empleados.php">';
                    $result_asistencia->data_seek(0); // Reiniciar el puntero del resultado
                    while ($fila_asistencia = $result_asistencia->fetch_assoc()) {
                        echo '<input type="hidden" name="nombre_emple[]" value="' . htmlspecialchars($fila_asistencia["nombre_emple"]) . '">';
                        echo '<input type="hidden" name="Id_emple[]" value="' . htmlspecialchars($fila_asistencia["Id_emple"]) . '">';
                        echo '<input type="hidden" name="fec_hor[]" value="' . htmlspecialchars($fila_asistencia["fec_hor"]) . '">';
                    }
                    echo '<input type="submit" value="Descargar CSV">';
                    echo '</form>';
                } else {
                    echo "<p>No se encontraron registros para el empleado y mes seleccionados.</p>";
                }
            }
        }

        // Cerrar la conexión a la base de datos
        $conexion->close();
        ?>
    </div>
</body>
</html>
