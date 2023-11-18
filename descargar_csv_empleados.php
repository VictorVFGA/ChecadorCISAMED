<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" &&
    isset($_POST['nombre_emple'], $_POST['Id_emple'], $_POST['fec_hor'])) {
    
    $nombre_emple = $_POST['nombre_emple'];
    $Id_emple = $_POST['Id_emple'];
    $fec_hor = $_POST['fec_hor'];

    if (!empty($nombre_emple) && !empty($Id_emple) && !empty($fec_hor)) {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="reporte_asistencia_empleados.csv"');

        $output = fopen('php://output', 'w');
        fputcsv($output, array("Nombre", "ID", "Fecha y Hora")); // Encabezados

        for ($i = 0; $i < count($nombre_emple); $i++) {
            fputcsv($output, array(
                htmlspecialchars($nombre_emple[$i]),
                htmlspecialchars($Id_emple[$i]),
                htmlspecialchars($fec_hor[$i])
            ));
        }

        fclose($output);
        exit; // ¡Importante! Terminar el script después de la descarga
    } else {
        echo "No hay datos para exportar a CSV.";
    }
} else {
    echo "No se recibieron datos para exportar a CSV.";
}
?>
