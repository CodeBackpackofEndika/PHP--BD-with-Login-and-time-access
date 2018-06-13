<?php
/**
 * Created by PhpStorm.
 * User: Endika
 * Date: 05/02/2018
 * Time: 8:55
 */

function no_sqli($cadena){
    $cadena = str_replace("'",'',$cadena);
    $cadena = str_replace(" ",'',$cadena);
    $cadena = str_replace("%20",'',$cadena);
    $cadena = str_replace("=",'',$cadena);
    $cadena = str_replace("%27",'',$cadena);
    $cadena = str_replace("table_schema",'',$cadena);
    $cadena = str_replace("table_name",'',$cadena);
    $cadena = str_replace("union",'',$cadena);
    $cadena = str_replace("select",'',$cadena);
    $cadena = str_replace("#",'',$cadena);
    $cadena = str_replace("--",'',$cadena);
    $cadena = str_replace("/*",'',$cadena);
    return $cadena;
}
?>