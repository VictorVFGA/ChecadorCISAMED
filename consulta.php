<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Asistencia</title>
</head>
<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-image: url('FondoRegistros.gif'); 
    background-size: cover;  
    background-repeat: no-repeat; 
    background-position: center center;
}
@media (max-width: 768px) {
    body {
        background-image: url('FondoRegistros.gif');
    }
}

.container {
    background-color: #fff;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    text-align: center;
    max-width: 600px;
    width: 80%;
    margin-bottom: 10px;
}
.pagina{
    display: flex;
    flex-direction: column;
}
.cont2{
    margin-bottom: 5px;
    text-align: center;
}
input[type="submit"], button {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    margin: 0 5px;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover, button:hover {
    background-color: #0056b3;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table, th, td {
    border: 1px solid #ccc;
}

th, td {
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

    </style>
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
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "checador";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        if (isset($_POST['fecha_consulta'])) {
            $fecha = $_POST['fecha_consulta'];

            $sql = "SELECT datos_emple.nombre_emple, datos_emple.Id_emple, regis_ingreso.fec_hor 
                    FROM datos_emple 
                    JOIN regis_ingreso ON datos_emple.Id_emple = regis_ingreso.id_emple 
                    WHERE DATE(regis_ingreso.fec_hor) = '$fecha'";

            $result_dias = $conn->query($sql);

            if ($result_dias->num_rows > 0) {
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

            $conn->close();
        }
    }
    ?>
</div>
</html>
