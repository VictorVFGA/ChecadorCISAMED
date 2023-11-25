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
                    echo "<h2>Bienvenido administrador</h2>";
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
            <!-- Buttons for Employees -->
            <div class="employee-buttons">
                <?php
                    echo '<a href="reporte_empleados.php"><button>Reporte del día de Empleados</button></a>';
                    echo '<a href="consulta.php"><button>Consulta por fecha (Empleado)</button></a>';
                    echo '<a href="consulta_empleados.php"><button>Consulta por Empleado</button></a>';
                ?>
            </div>

            <!-- Buttons for Students -->
            <div class="student-buttons">
                <?php
                    echo '<a href="reporte_alumnos.php"><button>Reporte del día de Alumnos</button></a>';
                    echo '<a href="consulta_Dialumnos.php"><button>Consulta por fecha (Alumno)</button></a>';
                    echo '<a href="consulta_alumnos.php"><button>Consulta por Alumno</button></a>';
                ?>
            </div>

            <!-- Logout Button -->
            <div class="logout-button">
                <?php
                    echo '<a href="/login.php"><button>Cerrar sesión</button></a>';
                ?>
            </div>
        </div>
    </div>
</body>
</html>

