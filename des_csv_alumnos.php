<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Configurar el encabezado para indicar que se trata de un archivo CSV
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="reporte_asistencia_alumnos.csv"');

    // Crear un puntero de salida para escribir en el archivo CSV
    $output = fopen('php://output', 'w');

    // Escribir el encabezado del CSV
    fputcsv($output, array('Nombre', 'ID', 'Fecha y Hora'));

    // Recorrer los datos y escribir en el archivo CSV
    for ($i = 0; $i < count($_POST['NombreAlum']); $i++) {
        $row = array(
            $_POST['NombreAlum'][$i],
            $_POST['IDAlumn'][$i],
            $_POST['asi_dia_hora'][$i]
        );
        fputcsv($output, $row);
    }

    // Cerrar el puntero de salida
    fclose($output);
}
?>
