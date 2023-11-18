<!DOCTYPE html>
<html>
<head>
    <title>Asistencia del día</title>
    <link rel="stylesheet" href="estilos/estilos_asistencia.css">
</head>
<body>
    <div class="container">
    <?php
    // Incluir el archivo de conexión
    include('conexion.php');

    // Consulta para obtener el número de personas que han entrado en el día
    $query_reporte = "SELECT datos_emple.nombre_emple, datos_emple.Id_emple, regis_ingreso.fec_hor 
                    FROM datos_emple JOIN regis_ingreso 
                    ON datos_emple.Id_emple = regis_ingreso.id_emple 
                    WHERE DATE(fec_hor) = CURDATE();";
    $result_reporte = $conexion->query($query_reporte);

    if ($result_reporte && $result_reporte->num_rows > 0) {
        echo "<h2>Reporte de Asistencia del Día</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Nombre</th><th>ID</th><th>Fecha y Hora</th></tr>";
        
        while ($fila_reporte = $result_reporte->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila_reporte["nombre_emple"] . "</td>";
            echo "<td>" . $fila_reporte["Id_emple"] . "</td>";
            echo "<td>" . $fila_reporte["fec_hor"] . "</td>";
            echo "</tr>";
        }
        
        echo "</table>";
        echo "<br>";
        echo "<br>";
        echo '<a href="checador.php"><button>Regresar</button></a>';
    } else {
        echo "<p>No se encontraron entradas hoy.</p>";
        echo '<a href="checador.php"><button>Regresar</button></a>';
    }

    // Cerrar la conexión a la base de datos
    $conexion->close();
    ?>
    </div>
</body>
</html>
