<?php 

#clase para la conexion a la base de datos
   class Conexion{

      public function mostrar($data){
        
         $conectar = new Conexion();
         $conexion = $conectar->conectar();
     
         $resultado = mysqli_query($conexion, $data);
         return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
     }
      
      #atributos
      private $server;
      private $user;
      private $password;
      private $database;

      #constructor
      
      public function __construct(){

         $this->server = "127.0.0.1:3306";
         $this->user = "root";
         $this->password = "";
        // $this->password = "Neu3sP4ssw0rd2024"
         //$this->password = "";
         $this->database ="grupo_vasco";
      }

      #metodos
      public function conectar(){
         $conectar = mysqli_connect($this->server, $this->user, $this->password, $this->database);
         return $conectar;
      }
   }
   

?>