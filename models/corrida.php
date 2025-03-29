<?php

class corrida{


    #motrar datos registrados
    public function mostrar($data){
        
        $conectar = new Conexion();
        $conexion = $conectar->conectar();
    
        $resultado = mysqli_query($conexion, $data);
        return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    
    
    
    }

    #Insertar de siembra engorde
    public function insert_run_engorde($datos){

        $conectar = new Conexion();
        $conexion = $conectar->conectar();

        $sql = "INSERT INTO `registro_piscina_engorde` (`fecha_siembra`, `fecha_cosecha`, `id_camaronera`, `id_piscina`, `hectareas`, `id_corrida`, `peso_trasferencia`, `densidad_transferencia`, `nauplio`, `laboratorio`, `origen`, `estado`, `id_usuario`)
                 VALUES ('$datos[0]', '$datos[1]', '$datos[2]', '$datos[3]', '$datos[4]', '$datos[5]', '$datos[6]', '$datos[7]', '$datos[8]', '$datos[9]', '$datos[10]', '$datos[11]', '$datos[12]')";
         
        $query = mysqli_query( $conexion, $sql );

    }

    #Insertar de siembra precria
    public function insert_run_precria($datos){
    
        $conectar = new Conexion();
        $conexion = $conectar->conectar();
    
        $sql = "INSERT INTO `registro_piscina_precria`(`fecha_siembra`, `fecha_cosecha`, `id_camaronera`, `id_precria`, `hectareas`, `peso_siembra`, `cantidad_siembra`, `codigo_genetico`, `nauplio`, `laboratorio`, `origen`, `dias_aprox`, `estado`, `id_usuario`, `identificacion`)
                    VALUES ('$datos[0]', '$datos[1]', '$datos[2]', '$datos[3]', '$datos[4]', '$datos[5]', '$datos[6]', '$datos[7]', '$datos[8]', '$datos[9]', '$datos[10]', '$datos[11]', '$datos[12]', '$datos[13]', '$datos[14]')";
             
        $query = mysqli_query( $conexion, $sql );
    
    }


    public function update($datos){

        $conectar = new Conexion();
        $conexion = $conectar->conectar();

        $sql = "UPDATE registro_piscina_engorde SET estado = '$datos[0]' WHERE id = '$datos[1]'";
        return $sqli = mysqli_query($conexion, $sql);

    }

}


?>