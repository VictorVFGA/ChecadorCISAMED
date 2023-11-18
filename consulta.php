<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Asistencia</title>
    <link rel="stylesheet" href="estilos/estilos_consulta.css">
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
        <a href="checador.php"><button>Regresar</button></a>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include('conexion.php'); // Incluir el archivo de conexión

            if ($conexion) {
                if (isset($_POST['fecha_consulta'])) {
                    $fecha = $_POST['fecha_consulta'];

                    $sql = "SELECT datos_emple.nombre_emple, datos_emple.Id_emple, regis_ingreso.fec_hor 
                            FROM datos_emple 
                            JOIN regis_ingreso ON datos_emple.Id_emple = regis_ingreso.id_emple 
                            WHERE DATE(regis_ingreso.fec_hor) = '$fecha'";

                    $result_dias = $conexion->query($sql);

                    if ($result_dias && $result_dias->num_rows > 0) {
                        echo "<h2>Resultados:</h2>";
                        echo "<table border='1'>";
                        echo "<tr><th>Nombre</th><th>ID</th><th>Fecha y Hora</th></tr>";
                        while ($fila_reporte = $result_dias->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $fila_reporte["nombre_emple"] . "</td>";
                            echo "<td>" . $fila_reporte["Id_emple"] . "</td>";
                            echo "<td>" . $fila_reporte["fec_hor"] . "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                        echo "<br>";
                        echo "<br>";
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
