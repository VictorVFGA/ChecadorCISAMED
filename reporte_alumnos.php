<!DOCTYPE html>
<html>
<head>
    <title>Asistencia del día</title>
    <link rel="stylesheet" href="estilos/estilos_asistencia.css">
    <link rel="icon" href="/logo.jpeg" type="image/jpeg">
</head>
<body>
    <div class="container">
    <?php
    // Incluir el archivo de conexión
    include('conexion.php');

    // Consulta para obtener el número de personas que han entrado en el día
    $query_reporte = "SELECT datos_alumno.NombreAlum, datos_alumno.IDAlumn, asistencia_alum.asi_dia_hora 
                    FROM datos_alumno 
                    JOIN asistencia_alum 
                    ON datos_alumno.IDAlumn = asistencia_alum.IDAlumn 
                    WHERE DATE(asi_dia_hora) = CURDATE();";
    $result_reporte = $conexion->query($query_reporte);

    if ($result_reporte && $result_reporte->num_rows > 0) {
        echo "<h2>Reporte de Asistencia del Día</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Nombre</th><th>ID</th><th>Fecha y Hora</th></tr>";
        
        while ($fila_reporte = $result_reporte->fetch_assoc()) {
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
        echo '<form method="POST" action="des_csv_asistencia_alumnos.php">';
        $result_reporte->data_seek(0); // Reiniciar el puntero del resultado
        while ($fila_reporte = $result_reporte->fetch_assoc()) {
            echo '<input type="hidden" name="NombreAlum[]" value="' . htmlspecialchars($fila_reporte["NombreAlum"]) . '">';
            echo '<input type="hidden" name="IDAlumn[]" value="' . htmlspecialchars($fila_reporte["IDAlumn"]) . '">';
            echo '<input type="hidden" name="asi_dia_hora[]" value="' . htmlspecialchars($fila_reporte["asi_dia_hora"]) . '">';
        }
        echo '<input type="submit" value="Descargar CSV">';
        echo '</form>';

       // echo '<a href="checador.php"><button>Regresar</button></a>';
    } else {
        echo "<p>No se encontraron entradas hoy.</p>";
    }

    // Cerrar la conexión a la base de datos
    $conexion->close();
    ?>
    </div>
</body>
</html>
