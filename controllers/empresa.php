<?php

include '../models/conexion.php';
include '../models/session.php';

$ingresar = new Session();

if(isset($_GET['e'])){
    
    $e = $_GET['e']; //camaronera
    $c = $_GET['c']; //usuario
    $u = $_GET['u']; //nombre

    if($c == 1 && $e != 1){

         $u = $u.$e;

    }else if($e == 1){

        if($c == 2 || $c == 3 || $c == 4 || $c == 5 || $c == 6){
            #eliminamos el numero del usuario (2,3,4,5,6)
            $u = substr($u, 0, -1);
            $u = $u;

        }else{

            $u;
        }
    }else{

        #eliminamos el numero del usuario (2,3,4,5,6)
        $u = substr($u, 0, -1);
        $u = $u.$e;
        
    }
    
    $sql = "SELECT correo, clave, camaronera_id, roles,valor FROM usuarios WHERE correo LIKE '$u' AND camaronera_id LIKE '$e'";
    $data = $ingresar->mostrar($sql);
    
    foreach ($data as $key){
        $user = $key['correo'];   
        $password = $key['clave']; 
        $camaronera = $key['camaronera_id'];
        $rol = $key['roles'];   
        $valor = $key['valor']; 
            $options = [
    'cost' => 12, 
];
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);
        $hashedPassword = $password ;
    }
    $datos = array( $user, $password, $camaronera, $roles,$hashedPassword,$valor );
    $datos = array( $user, $password, $camaronera, $rol,$hashedPassword,$valor );
    $ingresar->logincamaronera($datos);

}else{
    echo ' error en el servidor :(';
}

?>