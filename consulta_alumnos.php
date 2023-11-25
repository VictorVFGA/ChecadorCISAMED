<!DOCTYPE html>
<html>
<head>
    <title>Consulta de Asistencia por Alumno</title>
    <link rel="stylesheet" href="estilos/estilos_consultaEmpleados.css">
    <link rel="icon" href="/logo.jpeg" type="image/jpeg">
</head>
<body>
    <div class="container">
        <h2>Consulta por Alumno</h2>
        <form method="POST" action="">
            <label for="alumno">Selecciona un alumno:</label>
            <select id="alumno" name="alumno_consulta">
                <?php
                // Incluir el archivo de conexión
                include('conexion.php');

                // Consulta para obtener los nombres de los alumnos
                $query_nombres = "SELECT DISTINCT NombreAlum, IDAlumn FROM datos_alumno";
                $result_nombres = $conexion->query($query_nombres);

                if ($result_nombres && $result_nombres->num_rows > 0) {
                    while ($fila_nombre = $result_nombres->fetch_assoc()) {
                        echo "<option value='" . $fila_nombre["IDAlumn"] . "'>" . $fila_nombre["NombreAlum"] . "</option>";
                    }
                }
                ?>
            </select>
            
            <label for="mes">Selecciona un mes:</label>
            <select id="mes" name="mes_consulta">
                <?php
                // Obtener los meses disponibles
                $query_meses = "SELECT DISTINCT DATE_FORMAT(asi_dia_hora, '%M %Y') as mes FROM asistencia_alum";
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

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['alumno_consulta'])) {
                $id_alumno = $_POST['alumno_consulta'];
                $mes_consulta = $_POST['mes_consulta'];

                // Consulta para obtener los registros de asistencia del alumno y mes seleccionados
                $sql = "SELECT datos_alumno.NombreAlum, datos_alumno.IDAlumn, asistencia_alum.asi_dia_hora 
                        FROM datos_alumno 
                        JOIN asistencia_alum ON datos_alumno.IDAlumn = asistencia_alum.IDAlumn 
                        WHERE datos_alumno.IDAlumn = '$id_alumno' AND DATE_FORMAT(asistencia_alum.asi_dia_hora, '%m %Y') = '$mes_consulta'";

                $result_asistencia = $conexion->query($sql);

                if ($result_asistencia && $result_asistencia->num_rows > 0) {
                    echo "<h2>Resultados para el alumno y mes seleccionados:</h2>";
                    echo "<table border='1'>";
                    echo "<tr><th>Nombre</th><th>ID</th><th>Fecha y Hora</th></tr>";
                    while ($fila_asistencia = $result_asistencia->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $fila_asistencia["NombreAlum"] . "</td>";
                        echo "<td>" . $fila_asistencia["IDAlumn"] . "</td>";
                        echo "<td>" . $fila_asistencia["asi_dia_hora"] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "<br>";
                    echo "<br>";

                    // Agregar botón para descargar CSV
                    echo '<form method="POST" action="des_csv_alumnos.php">';
                    $result_asistencia->data_seek(0); // Reiniciar el puntero del resultado
                    while ($fila_asistencia = $result_asistencia->fetch_assoc()) {
                        echo '<input type="hidden" name="NombreAlum[]" value="' . htmlspecialchars($fila_asistencia["NombreAlum"]) . '">';
                        echo '<input type="hidden" name="IDAlumn[]" value="' . htmlspecialchars($fila_asistencia["IDAlumn"]) . '">';
                        echo '<input type="hidden" name="asi_dia_hora[]" value="' . htmlspecialchars($fila_asistencia["asi_dia_hora"]) . '">';
                    }
                    echo '<input type="submit" value="Descargar CSV">';
                    echo '</form>';
                } else {
                    echo "<p>No se encontraron registros para el alumno y mes seleccionados.</p>";
                }
            }
        }

        // Cerrar la conexión a la base de datos
        $conexion->close();
        ?>
    </div>
</body>
</html>
