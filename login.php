<?php
include("no_sqli.php");
session_start();
$logueocorrecto = 0;

// PARAMETROS PARA SEGURIDAD DE LA APP
if (isset($_POST["login"]) && isset($_POST["pass"])) {
    $login = no_sqli($_POST["login"]);
    $pass = no_sqli(sha1($_POST["pass"]));
} elseif (isset($_SESSION['logeado'])) {
    $login = $_SESSION["logeado"];
    $pass = $_SESSION["passwi"];
}

// SI EXITE UN LOGIN Y UN PASSWORD...
if (isset($login) && isset($pass)) {
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

    $sql = "SELECT count(*) AS num
                  FROM usuarios 
                  WHERE login='$login'AND pass='$pass'";
    $res = $mysql->query($sql);
    if ($res) {
        $fila = $res->fetch_assoc();
        if ($fila['num'] > 0) {
            $logueocorrecto = 1;
        }
    }

    // CONSULTAS DE DATOS
    $sql1 = "SELECT *  FROM usuarios
                  WHERE login='$login'AND pass='$pass'";
    $res1 = $mysql->query($sql1);

    //INSERTAR TIEMPO
    $resultadoConsulta = $res1->fetch_assoc();
    $id_usuario = $resultadoConsulta['id'];

    // SI EL LOGUEO ES CORRECTO...
    if ($logueocorrecto == 1) {
        $_SESSION['logeado'] = $login;
        $_SESSION['passwi'] = $pass;

        //INSERTAR TIEMPO DE LOGUEO
        $tiempo = "INSERT INTO intranet_sad.conexiones(tiempo_entrada,id_usuario) 
                      VALUES (CURRENT_TIMESTAMP,$id_usuario)";
        $mysql->query($tiempo);
        $_SESSION['idtiempo'] = $mysql->insert_id;

        //MOSTRAR DATOS USUARIO
        while ($resultadoConsulta) {
            echo "<br>";
            echo "Tus Datos Empresariales";
            echo "<br>";
            echo "Login:";
            echo " ";
            echo $login;
            echo "<br>";
            echo "Password (Hasheada):";
            echo " ";
            echo $pass;
            echo "<br>";
            echo "Rol:";
            echo " ";
            echo $resultadoConsulta["rol"];
            echo "<br>";
            echo "<br>";
            echo "Tus Datos Personales";
            echo "<br>";
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
            echo "<br>";

            // DIFERENCIAS ENTRE DIFERENTES ROLES DE JEFE DE EQUIPO Y TRABAJADOR

            if ($resultadoConsulta["rol"] === "Jefe de Equipo") {
                echo "<a href='otrosusuarios.php'>Ver Otros Usuarios</a>";
                echo "<br>";
                echo "<a href='cerrarsession.php'>Cerrar Sesion</a>";
            } elseif ($resultadoConsulta["rol"] == "Trabajador") {
                echo "<a href='cerrarsession.php'>Cerrar Sesion</a>";

            }
            $resultadoConsulta = $res1->fetch_assoc();
        }
    } // SI EL LOGUEO NO ES CORRECTO ...
    else {
        header("location:index.php");

    }


} // SI INTENTAMOS ENTRAR POR LA URL DIRECTAMENTE...
else {
    header("location:index.php");

}

?>