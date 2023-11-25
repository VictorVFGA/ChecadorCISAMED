<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Asistencia</title>
    <link rel="stylesheet" href="estilos/estilos_consulta.css">
    <link rel="icon" href="/logo.jpeg" type="image/jpeg">
</head>
<body>
    <div class="container">
        <h2>Consulta por Fecha</h2>
        <form method="POST" action="">
            <label for="fecha">Selecciona una fecha:</label>
            <input type="date" id="fecha" name="fecha_consulta" value="<?php echo date('Y-m-d'); ?>">
            <br>
            <br>
            <input type="submit" value="Consultar"> 
        </form>
        <br>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include('conexion.php'); // Incluir el archivo de conexión

            if ($conexion) {
                if (isset($_POST['fecha_consulta'])) {
                    $fecha = $_POST['fecha_consulta'];

                    $sql = "SELECT datos_alumno.NombreAlum, datos_alumno.IDAlumn, asistencia_alum.asi_dia_hora 
                            FROM datos_alumno 
                            JOIN asistencia_alum ON datos_alumno.IDAlumn = asistencia_alum.IDAlumn 
                            WHERE DATE(asistencia_alum.asi_dia_hora) = '$fecha'";

                    $result_dias = $conexion->query($sql);

                    if ($result_dias && $result_dias->num_rows > 0) {
                        echo "<h2>Resultados:</h2>";
                        echo "<table border='1'>";
                        echo "<tr><th>Nombre</th><th>ID</th><th>Fecha y Hora</th></tr>";
                        while ($fila_reporte = $result_dias->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $fila_reporte["NombreAlum"] . "</td>";
                            echo "<td>" . $fila_reporte["IDAlumn"] . "</td>";
                            echo "<td>" . $fila_reporte["asi_dia_hora"] . "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                        echo "<br>";
                        echo "<br>";

                        // Agregar botón para descargar CSV
                        echo '<form method="POST" action="des_csv_asiDiaAlum.php">';
                        $result_dias->data_seek(0); // Reiniciar el puntero del resultado
                        while ($fila_reporte = $result_dias->fetch_assoc()) {
                            echo '<input type="hidden" name="NombreAlum[]" value="' . htmlspecialchars($fila_reporte["NombreAlum"]) . '">';
                            echo '<input type="hidden" name="IDAlumn[]" value="' . htmlspecialchars($fila_reporte["IDAlumn"]) . '">';
                            echo '<input type="hidden" name="asi_dia_hora[]" value="' . htmlspecialchars($fila_reporte["asi_dia_hora"]) . '">';
                        }
                        echo '<input type="submit" value="Descargar CSV">';
                        echo '</form>';
                    } else {
                        echo "<p>No se encontraron registros para la fecha seleccionada.</p>";
                    }
                }
            } else {
                echo "<p>Error en la conexión a la base de datos.</p>";
            }

            $conexion->close();
        }
        ?>
    </div>
</body>
</html>
