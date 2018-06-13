<?php
include("seguridad.php");
if (isset($_SESSION['logeado'])) {
    $dbhost = "localhost";
    $user_db = "endika";
    $pass_db = "endika";
    $database = "intranet_sad";
    $mysql = new mysqli($dbhost, $user_db, $pass_db, $database);
    if ($mysql->connect_error) {
        echo "Error en la conexion";
        echo "<br>";
        echo "<br>";
        echo "<a href='cerrarsession.php'>Volver a Intentarlo</a>";
    }
    $idtiempo = $_SESSION['idtiempo'];
    $tiemposalida = "UPDATE intranet_sad.conexiones SET tiempo_entrada=tiempo_entrada, tiempo_salida=CURRENT_TIMESTAMP 
                      WHERE id_tiempo=$idtiempo";
    $mysql->query($tiemposalida);
    session_unset();
    session_destroy();
    header("Location:index.php");
}
?>