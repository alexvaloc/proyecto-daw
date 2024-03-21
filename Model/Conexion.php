<?php

//Funcion para crear la conexión

function crearConexion(){

    //Datos para la conexión
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "travelplanificator";

    //Establecemos la conexión con la bbdd

    $conexion = mysqli_connect($host,$user,$password,$database);

    //Si hay un error, mostramos mensaje y detenemos el proceso
    if(!$conexion){
        die("<br>Error de conexión con la base de datos: " . mysqli_connect_error()."</br>");
    }else{
        // echo "<br>Conexión correcta a la base de datos: ". $database . "<br>";
    }

    return $conexion;
}

//funcion para cerrar la conexión
function cerrarConexion($conexion){
    
    mysqli_close($conexion);
    
}