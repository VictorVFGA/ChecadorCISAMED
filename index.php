<?php
if (isset($_GET['data'])) {
    $data = $_GET['data'];

    $conn = new mysqli("db", "victor", "pass123", "checador");

    if ($conn->connect_error) {
        die("Error en la conexión: " . $conn->connect_error);
    }

    // Verifica si el valor ya existe en la tabla 
    $check_existing_query2 = "SELECT id_emple FROM datos_emple WHERE id_emple = '$data'";
    $result_existing2 = $conn->query($check_existing_query2);
    $check_existing_query = "SELECT IDAlumn FROM datos_alumno WHERE IDAlumn = '$data'";
    $result_existing = $conn->query($check_existing_query);

    if ($result_existing2->num_rows > 0) {
        $sql_regis_ingreso = "INSERT INTO regis_ingreso (id_emple) VALUES ('$data');";
        echo "Valor de data: " . $data . PHP_EOL;
        if ($conn->query($sql_regis_ingreso) === TRUE) {
            echo "Inserte correctamente";
        } else {
                echo "Error al insertar: " . $conn->error;
        }
    
    } else if($result_existing->num_rows > 0){
        $sql_asistencia = "INSERT INTO asistencia_alum (IDAlumn) VALUES ('$data')";
        echo "Valor de data: " . $data . PHP_EOL;
        if($conn->query($sql_asistencia) === TRUE){
            echo "Inserte correctamente";
        }else{
            echo "Error al insertar: " . $conn->error;
        }
    }
    else {
        echo "Error al insertar los datos en ambas tablas: " . $conn->error;
    }
    $conn->close();
} else {
    echo "No recibí data en la solicitud.";
}
?>
