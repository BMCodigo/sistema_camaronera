<?php

include '../models/conexion.php';

$conectar = new Conexion();
$conexion = $conectar->conectar();

session_start();
session_destroy();
header("location:../");


?>