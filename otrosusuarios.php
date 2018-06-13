<?php
include("seguridad.php");
if (isset($_SESSION['logeado'])) {
    echo "<a href='login.php'>Volver a mis Datos Personales</a>";
    echo " ";
    echo "|";
    echo " ";
    echo "<a href='cerrarsession.php'>Cerrar Sesión</a>";
    echo "<br>";
    echo "<br>";

    $dbhost = "localhost";
    $user_db = "endika";
    $pass_db = "endika";
    $database = "intranet_sad";
    $mysql = new mysqli($dbhost, $user_db, $pass_db,$database);
    if ($mysql->connect_error) {
        echo "Error en la conexion";

    } else {
        $sql1 = "SELECT *  FROM usuarios";
        $res1 = $mysql->query($sql1);
        if ($res1) {
            while ($resultadoConsulta = $res1->fetch_assoc()) {
                if (isset($resultadoConsulta)) {
                    echo "ID:";
                    echo " ";
                    echo $resultadoConsulta["id"];
                    echo "<br>";
                    echo "Nombre:";
                    echo " ";
                    echo $resultadoConsulta["nombre"];
                    echo "<br>";
                    echo "Apellido 1:";
                    echo " ";
                    echo $resultadoConsulta["apellido1"];
                    echo "<br>";
                    echo "Apellido 2:";
                    echo " ";
                    echo $resultadoConsulta["apellido2"];
                    echo "<br>";
                    echo "Telefono:";
                    echo " ";
                    echo $resultadoConsulta["telefono"];
                    echo "<br>";
                    echo "Login:";
                    echo " ";
                    echo $resultadoConsulta["login"];
                    echo "<br>";
                    echo "Password (Hasheada):";
                    echo " ";
                    echo $resultadoConsulta["pass"];
                    echo "<br>";
                    echo "Rol en la Empresa:";
                    echo " ";
                    echo $resultadoConsulta["rol"];
                    echo "<br>";
                }
                echo "<br>";
                echo "<br>";
            }

        };

    }
}
?>