<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
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
    background-image: url('Fondo.gif'); 
    background-size: cover;  
    background-repeat: no-repeat; 
    background-position: center center;
}
@media (orientation: landscape) {
    body {
        background-image: url('Fondo.gif');
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
    margin-bottom: 40px;
}
.pagina{
    display: flex;
    flex-direction: column;
}
.cont2{
    margin-bottom: 5px;
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
<div class = "pagina">
<div class="container">
<?php
// Conexión a la base de datos y obtención del ID del empleado más reciente
$conexion = new mysqli("db", "victor", "pass123", "checador");
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
    echo '<button onclick="limpiar()">Aceptar</button>';    
    echo '<button onclick="recargar()">Actualizar</button>';
    echo '<a href="reporte_empleados.php"><button>Asistencia del día</button></a>';
    echo '<a href="consulta.php"><button>Consultar asistencia</button></a>';
?>
</div>
</div>


<script>
function limpiar() {
    document.getElementById('contenido').innerHTML = "";
}
function recargar() {
    location.reload();
}
function generarReporte() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "reporte_empleados.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById('contenido').innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}
</script>

</body>
</html>




