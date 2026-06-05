<?php

$conexion = new mysqli(
    "localhost",
    "root",
    "",
    "paila_db"

);

if($conexion->connect_error){
    die("Error: " . $conexion->connect_error);
}

echo "✅ Conexión exitosa a MySQL";
?>