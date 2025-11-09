<?php
    namespace TECWEB\MYAPI;

    use TECWEB\MYAPI\DataBase as DataBase;
    require_once __DIR__ . '/DataBase.php';

    class Products extends DataBase {
        private $data = NULL;
        public function __construct($user='root', $pass='Tec&12Web', $db){
            $this->data= array();
            parent::__construct($user, $pass, $db);
        }

        public function list(){
                //CREAMOS EL ARREGLO A DEVOLVERSE EN FORMA JSON
                $this->data=array(); 

                //Query de búsqueda y validación de resultados 
                if($result = $this->conexion->query("SELECT * FROM productos WHERE eliminado = 0")){

                    //obtenemos resultados
                    $rows = $result->fetch_all(MYSQLI_ASSOC); 
                    if(!is_null($rows)){
                        //codificación a UTF-8 de datos y mapeo al arreglo de respuesta
                        foreach($rows as $num => $row){
                            foreach($row as $key => $value){
                                $this ->data[$num][$key]=$value; 
                            }
                        }
                    }
                    $result->free(); 
                } else{
                    die('Query Error: '.mysqli_error($this->conexion)); 
                }
                $this->conexion->close(); 
        }
    public function getData(){
        header('Content-Type: application/json');
        return json_encode($this->data, JSON_PRETTY_PRINT); 
    }
    }
?>