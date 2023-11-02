<!DOCTYPE html>
<html>
<head>
    <title>Asistencia del día</title>
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
}

button {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    margin: 0 5px;
    transition: background-color 0.3s ease;
}

button:hover {
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
<?php
// Conexión a la base de datos
$conexion = new mysqli("db", "victor", "pass123", "checador");

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