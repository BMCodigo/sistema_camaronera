<?php


    class Session{

        #motrar datos registrados
        public function mostrar($data){
            
            $conectar = new Conexion();
            $conexion = $conectar->conectar();
        
            $resultado = mysqli_query($conexion, $data);
            return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        
        }


        public function login($datos){

            $conectar = new Conexion();
            $conexion = $conectar->conectar();
            
            #verificamos si existen los mismos datos en la tabla administracion
            $sql = "SELECT id_usuario, correo, clave, camaronera_id, roles FROM usuarios WHERE correo LIKE '$datos[0]' AND clave LIKE '$datos[1]' AND camaronera_id LIKE '$datos[2]' AND roles LIKE '$datos[3]'";
            $query = mysqli_query( $conexion, $sql );
    
            $array = mysqli_fetch_assoc($query);
    
                if ($array > 0){
                 
                   $rol = $_SESSION['sesion'] = $datos[3];

                   if($rol == 'superadmin'){

                        session_start();
                        $_SESSION['sesion'] = $datos[0];
                        $_SESSION['id'] = $array['id_usuario'];
                        echo '<script language="javascript">window.location.href="../views/index.php?page=Acumulado-modelado&d=sistemas"</script>';
                        $sqlInsert="INSERT INTO `visitas`(`fecha_ingreso`, `id_camaronera`, `usuario`, `estado`) VALUES(NOW(), '$datos[2]', '$datos[0]', 'Ingreso valido')";
                        $queryInsert = mysqli_query( $conexion, $sqlInsert);

                   }else{

                        session_start();
                        $_SESSION['sesion'] = $datos[0];
                        $_SESSION['id'] = $array['id_usuario'];
                        echo '<script language="javascript">window.location.href="../views/index.php?page=Acumulado-modelado"</script>';
                        $sqlInsert="INSERT INTO `visitas`(`fecha_ingreso`, `id_camaronera`, `usuario`, `estado`) VALUES(NOW(), '$datos[2]', '$datos[0]', 'Ingreso valido')";
                        $queryInsert = mysqli_query( $conexion, $sqlInsert);
                   }

                    exit();
                    
                }else{
                    
                    echo '<script>
                            alert(" Error en autenticacion ")
                            window.history.go(-1);
                          </script>';
                    exit;
                }
    
        }

    }
