<?php

#No permitimos al usurio entrar x la url y regresesar si haber iniciado session
error_reporting(0);

session_start();

 $verficar = $_SESSION['sesion'];

if(!isset($verficar)){

  header('location:../');

  die();

}

 ?>