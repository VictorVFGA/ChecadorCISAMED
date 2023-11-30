<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
    <link rel="stylesheet" href="estilos/estilos_adminInterface.css">
    <link rel="icon" href="/logo.jpeg" type="image/jpeg">
</head>
<body>
    <div class="pagina">
        <div class="container">
            <div id="contenido">
                <?php
                    // Elimina la sección relacionada con la base de datos

                    echo "<h2>Bienvenido empleado</h2>";
                    echo "CISAMED. Portal de contol de asistencia.";
                    echo "<br>";
                    echo "<br>";
                    echo "Elija una de las siguientes opciones:";
                    echo "<br>";
                    echo "<br>";
                ?>
            </div>
        </div>

        <div class="cont2">
            <?php
                // Botones
                echo '<a href="reporte_alumnos.php"><button>Asistencia del día</button></a>';
                echo '<a href="consulta_Dialumnos.php"><button>Consultar por fecha</button></a>';
                echo '<a href="consulta_alumnos.php"><button>Consulta por Alumno</button></a>';
            ?>
            <!-- Nuevo botón de "Cerrar sesión" -->
            <a href="/login.php"><button>Cerrar sesión</button></a>
        </div>
    </div>
</body>
</html>
