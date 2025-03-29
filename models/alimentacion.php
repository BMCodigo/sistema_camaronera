<?php

class alimentacion{


    #motrar datos registrados
    public function mostrar($data){
        
        $conectar = new Conexion();
        $conexion = $conectar->conectar();
    
        $resultado = mysqli_query($conexion, $data);
        return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    
    }

    public function insert_alimento($datos){

        $conectar = new Conexion();
        $conexion = $conectar->conectar();

        $sql = "INSERT INTO `registro_alimentacion`(`fecha_alimentacion`, `id_camaronera`, `id_piscina`, `id_corrida`, `id_tipo_alimento`, `id_tipo_alimento_2`, `cantidad`, `cantidad_2`, `tiempo`, `consumo`, `poblacion`, `camarones_muertos`, `oxigeno`, `temperatura`, `id_usuario`)
                VALUES ('$datos[0]', '$datos[1]', '$datos[2]', '$datos[3]', '$datos[4]', '$datos[5]', '$datos[6]', '$datos[7]', '$datos[8]', '$datos[9]', '$datos[10]', '$datos[11]', '$datos[12]', '$datos[13]', '$datos[14]')";
            
        $query = mysqli_query( $conexion, $sql );

    }

}


?>