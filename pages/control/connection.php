<?php
    namespace control;
    require '../../vendor/autoload.php'; // include Composer's autoloader

    class Conexion {
        //Conectar al servidor
        private $connection;
        private $db;
        private $usuarios;
        private $persona;
        private $pagos;
        private $proyect;
        private $empleados;
        // private $collection;
        public function __construct(){
            $this->connection = new \MongoDB\Client("mongodb://localhost:27017");
            $this->db = $this->connection->proy_final;
            $this->usuarios= $this->db->usuarios; 
            $this->persona= $this->db->persona; 
            $this->pagos=$this->db->pagos;
            $this->project=$this->db->project;
            $this->empleados=$this->db->empleados;
            // echo "Valores encontrados: \n<br>";
            // foreach ($result as $entry) {
            // echo "<strong>Username: </strong>".$entry["name"], ': ', "<strong>pass:</strong>".$entry['pass'],"\n <br>";
            // }
        }
        public function getUsuarios(){
            return $this->usuarios;
        }
        public function regex($regex){
            return new \MongoDB\BSON\Regex($regex, 'i');
        }
        public function getPersonas(){
            return $this->personas;
        }
        public function getPagos(){
            return $this->pagos;
        }
        public function getEmployes(){
            return $this->empleados;
        }
        public function getProject(){
            return $this->project;
        }
        public function getConnection(){
            return $this->connection;
        }
       public function getDB(){
           return $this->db;
       }

    }
    $con= new Conexion();
?>