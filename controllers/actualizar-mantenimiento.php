<?php include '../models/conexion.php'; $conectar = new Conexion();$conexion = $conectar->conectar();$param1 = $_POST['registrobase1']; $param2 = $_POST['registrobase2']; $id_usuario = $_POST['thisisuser'];
if ($param1 == $param2){
    
    if($id_usuario== '2'  || $id_usuario== '28' || $id_usuario== '29' || $id_usuario== '37' || $id_usuario== '59' || $id_usuario== '90'){
      $password = $param1;$options = ['cost' => 12, ];
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);
            $alterpass = "UPDATE usuarios SET clave = '$hashedPassword',fecha_pass = (NOW()) WHERE id_usuario = '2';";
                $queryes = mysqli_query( $conexion, $alterpass);    
    }else     if($id_usuario== '3'  || $id_usuario== '30' || $id_usuario== '31' || $id_usuario== '38' || $id_usuario== '60' || $id_usuario== '91'){
          $password = $param1;$options = ['cost' => 12, ];
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options); 
            $alterpass = "UPDATE usuarios SET clave = '$hashedPassword',fecha_pass = (NOW()) WHERE id_usuario = '3';";
                $queryes = mysqli_query( $conexion, $alterpass);         
    }else     if($id_usuario== '4'  || $id_usuario== '1' || $id_usuario== '21' || $id_usuario== '39' || $id_usuario== '61' || $id_usuario== '92'){
                  $password = $param1;$options = ['cost' => 12, ];
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options); 
            $alterpass = "UPDATE usuarios SET clave = '$hashedPassword',fecha_pass = (NOW()) WHERE id_usuario = '4';";
               $queryes = mysqli_query( $conexion, $alterpass);  
    }else     if($id_usuario== '17'  || $id_usuario== '42' || $id_usuario== '62' || $id_usuario== '93' || $id_usuario== '17' || $id_usuario== '42'){
                   $password = $param1;$options = ['cost' => 12, ];
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options); 
            $alterpass = "UPDATE usuarios SET clave = '$hashedPassword',fecha_pass = (NOW()) WHERE id_usuario = '17';";
                $queryes = mysqli_query( $conexion, $alterpass);         
    } else {
    $password = $param1;$options = ['cost' => 12, ];
$hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);
$alterpass = "UPDATE usuarios SET clave = '$hashedPassword',fecha_pass = (NOW()) WHERE id_usuario = '$id_usuario';";
$queryes = mysqli_query( $conexion, $alterpass);
    }
?>
<script>
    alert(' ¡ Su clave fue actualizada !');
          window.location.href="../views/index.php?page=Alimentos";
            </script>
<?php } else { ?>
<script>
   alert(' ¡ INGRESE 2 VECES LA NUEVA CLAVE , INTENTE NUEVAMENTE !');
       window.history.go(-1);
            </script>

<?php } ?>
