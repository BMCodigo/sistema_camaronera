<?php

class pesca{


    #motrar datos registrados
    public function mostrar($data){
        
        $conectar = new Conexion();
        $conexion = $conectar->conectar();
    
        $resultado = mysqli_query($conexion, $data);
        return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    
    
    
    }

    #insertar datos en la tabla registro pesca engorde
    public function insert_pesca($datos){

        $conectar = new Conexion();
        $conexion = $conectar->conectar();

        $sql = "INSERT INTO `registro_pesca_engorde`(`fecha_pesca`, `id_camaronera`, `laboratorio`, `nauplio`, `id_piscina`, `hectareas`, `id_corrida`, `libras_pescadas`, `peso_pesca`, `id_cliente`, `id_usuario`, `estado`,`rendimiento`)
                 VALUES ('$datos[0]', '$datos[1]', '$datos[2]', '$datos[3]', '$datos[4]', '$datos[5]', '$datos[6]', '$datos[7]', '$datos[8]', '$datos[9]', '$datos[10]', '$datos[11]', '$datos[12]')";
         
        $query = mysqli_query( $conexion, $sql );

    }
    
        public function insert_pescatest($datos){

        $conectar = new Conexion();
        $conexion = $conectar->conectar();

        $sql = "INSERT INTO `registro_pesca_engordetest`(`fecha_pesca`, `id_camaronera`, `laboratorio`, `nauplio`, `id_piscina`, `hectareas`, `id_corrida`, `libras_pescadas`, `peso_pesca`, `id_cliente`, `id_usuario`, `estado`,`rendimiento`)
                 VALUES ('$datos[0]', '$datos[1]', '$datos[2]', '$datos[3]', '$datos[4]', '$datos[5]', '$datos[6]', '$datos[7]', '$datos[8]', '$datos[9]', '$datos[10]', '$datos[11]', '$datos[12]')";
         
        $query = mysqli_query( $conexion, $sql );

    }
 
         public function insert_pesca_detalle($datos){

        $conectar = new Conexion();
        $conexion = $conectar->conectar();

        $sql = "INSERT INTO `registro_pesca_detalle`(`id_pesca`,`fecha_pesca`, `id_camaronera`, `laboratorio`, `nauplio`, `id_piscina`, `hectareas`, `id_corrida`, `libras_pescadas`, `peso_pesca`, `id_cliente`, `id_usuario`, `estado`,`rendimiento`)
                 VALUES ('$inserted_id', '$datos[0]', '$datos[1]', '$datos[2]', '$datos[3]', '$datos[4]', '$datos[5]', '$datos[6]', '$datos[7]', '$datos[8]', '$datos[9]', '$datos[10]', '$datos[11]', '$datos[12]')";
         
        $query = mysqli_query( $conexion, $sql );

    }

}


?>