<?php

namespace Model;

class ActiveRecord{

    // Bases de Datos
    protected static $bd;
    protected static $columnaBD=[];
    protected static $tabla = '';

    // Errores
    protected static $errores= []; 


    // Definir la coneccion a la base de datos
    public static function setBD($database){
        self::$bd = $database;
    }

    
    public function guardar(){
        if(!is_null( $this->id)){
            // Acualizando
            $this->actualizar();
        }else{
            // Creando una nuevaregistro
            $this->crear();
        }
    }

    // crea un nuevo registro
    public function crear() {
        // Sanitizar los datos
        $atributos = $this->sanitizarDatos();

        // Insertar en la base de datos
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' "; 
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";
        // Resultado de la consulta
        $resultado = self::$bd->query($query);
        // Mensaje de Exito
        if($resultado){
            // Redireccionar al usuario
            header('location: /admin?resultado=1');
        }
    }

    public function actualizar(){
        // Sanitizar Datos
        $atributos = $this -> sanitizarDatos();

        $valores=[];
        foreach ($atributos as $key => $value){
            $valores[] = "{$key}='{$value}'";
        }

        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$bd->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ";
        // debuguear($query);
        $resultado = self::$bd->query($query);
        // return $resultado;
        // Mensaje de Exito
        if($resultado){
            // Redireccionar al usuario
            header('location: /admin?resultado=2');
        }
    }

    // Eliminar un registro
    public function eliminar(){
        // Eliminar el registro
        $query = "DELETE FROM " . static::$tabla . " WHERE id = ". self::$bd->escape_string($this->id) . " LIMIT 1 ";
        $resultado = self::$bd->query($query);
        if($resultado){
            $this->borrarImagen();
            header('location: /admin?resultado=3');
        }

    }


    // Identificar y unir los archivos de la BD
    public function atributos(){
        $atributos =[];
        foreach(static::$columnaBD as $columna){
            if($columna ==='id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }
    
    
    // Definir la coneccion a la base de datos
    public function sanitizarDatos(){
        $atributos = $this-> atributos();
        $sanitizado =[];

        foreach ($atributos as $key => $value){
            $sanitizado[$key]= self::$bd->escape_string($value);
        }
        return $sanitizado;
    }
    // Subida archivos
    public function setImagen($imagen){
        // Eliminar el imagen previa
        if(!is_null( $this->id)){
            // comprobar si existe el archivo
            $this->borrarImagen();
        }
        // Asignar al atributo de imagen el nombre de la imagen
        if($imagen){
            $this->imagen = $imagen;
        }
    }

    // Eliminar Archivo
    public function borrarImagen(){
        // comprobar si existe el archivo
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this-> imagen);
        if($existeArchivo){
            unlink(CARPETA_IMAGENES . $this-> imagen);
        }
    }


    // Validación
    public static function getErrores(){

        return static::$errores;
    }

    public function validar(){
        static::$errores =[];
        return static::$errores;
    } 

    // Lista todo las propiedades
    public static function all(){
        
        $query = "SELECT * FROM " . static::$tabla;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    // Obtiene detrminado número de registros
    public static function get($cantidad){
        
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }  


    // Busca un registro propiedad
    public static function find($id){
        $query = "SELECT * FROM " . static::$tabla . " WHERE id =${id}";

        $resultado = self::consultarSQL($query);

        return array_shift($resultado);
    }

    public static function consultarSQL($query){
        // Consultar la base de datos
        $resultado = self::$bd->query($query);

        // Iterar los resultados
        $array=[];
        while ($registro = $resultado->fetch_assoc()){
            $array[]=static::crearObjeto($registro);
        }
        // Liberar la memoria
        $resultado->free();

        // Retorna los resultados
        return $array;

    }
    protected static function crearObjeto($registro){
        $objeto = new static;

        foreach($registro as $key => $value){
            if(property_exists( $objeto, $key )){
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    // Sincronizar el objeto en la memoria con los cambio realizado por el usuario
    public function sincronizar($args= []){
        foreach ($args as $key => $value){
            if(property_exists($this, $key) && !is_null($value)){
                $this ->$key = $value;
            }
        }
    } 
}