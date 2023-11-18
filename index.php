<?php
if (isset($_GET['data'])) {
    $data = $_GET['data'];

    $conn = new mysqli("db", "victor", "pass123", "checador");

    if ($conn->connect_error) {
        die("Error en la conexión: " . $conn->connect_error);
    }
    
    $sql = "INSERT INTO regis_ingreso (id_emple) VALUES ('$data')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Los datos fueron insertados en la tabla regis_ingreso de manera correcta";
    } else {
        //echo "Error al insertar los datos en la tabla regis_ingreso: " . $conn->error;s
        $sql_asistencia = "INSERT INTO asistencia_alum (IDAlum) VALUES ('$data')";
        if ($conn->query($sql_asistencia) === TRUE) {
            //echo "Los datos se insertaron en la tabla asistencia_alum de manera correcta";
        } else {
            echo "Error al insertar los datos en la tabla asistencia_alum: " . $conn->error;
        }
    }

    $conn->close();
} else {
    echo "No Recibí data en la URL";
}

?>