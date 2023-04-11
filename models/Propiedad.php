<?php

namespace Model;

class Propiedad extends ActiveRecord {
    protected static $tabla = 'propiedades'; 

    protected static $columnaBD=['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamientos', 'creado', 'vendedorId'];


    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamientos;
    public $creado;
    public $vendedorId;



    public function __construct( $args = [] ) {
        $this -> id = $args['id'] ?? null;
        $this -> titulo = $args['titulo'] ?? '';
        $this -> precio = $args['precio'] ?? '';
        $this -> imagen = $args['imagen'] ?? '';
        $this -> descripcion = $args['descripcion'] ?? '';
        $this -> habitaciones = $args['habitaciones'] ?? '';
        $this -> wc = $args['wc'] ?? '';
        $this -> estacionamientos = $args['estacionamientos'] ?? '';
        $this->creado = date('Y/m/d');
        $this -> vendedorId = $args['vendedorId'] ?? '';
    }


    // Validación
    public static function getErrores(){
        return self::$errores;
    }

    public function validar(){
        if(!$this->titulo){
            self::$errores[]= 'Debes añadir un titulo';
        }
        if(!$this->precio){
            self::$errores[]= 'El Precio es Obligatoria';
        }
        if(!$this->imagen){
            self::$errores[]= 'La imagen es Obligatoria';
        }
        if(strlen($this->descripcion) < 50 ){
            self::$errores[]= 'La descripcion es Obligatoria y debe tener al menos de 50 caracteres';
        }
        if(!$this->habitaciones){
            self::$errores[]= 'La cantidad de habitaciones es Obligatoria';
        }
        if(!$this->wc){
            self::$errores[]= 'La cantidad de baño es Obligatoria';
        }
        if(!$this->estacionamientos){
            self::$errores[]= 'Debes añadir la cantidad de estacionamiento';
        }
        if(!$this->vendedorId){
            self::$errores[]= 'El vendedor es Obligatoria';
        }


        return self::$errores;
    }

}
