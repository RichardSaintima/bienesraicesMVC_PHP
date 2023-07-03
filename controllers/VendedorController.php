<?php

namespace Controllers;

use MVC\Router;
use Model\Vendedor;

class VendedorController {
    public static function crear ( Router $router ) {
        
        $errores = Vendedor::getErrores();
        $vendedor = new Vendedor;  
        
        if($_SERVER['REQUEST_METHOD']==='POST'){

            // Crear una Instancia
            $vendedor = new Vendedor($_POST['vendedor']);
            
            // Validar que no haya campos vacios
            $errores = $vendedor->validar();
            
            // Revisar que el array esta vacio
            if(empty($errores)){ 
                $vendedor->guardar();
            }
        }
        
        $router->render('vendedores/crear', [
            'errores' => $errores,
            'vendedor' => $vendedor
        ]);
    }

    public static function actualizar ( Router $router ) {
        
        $errores = Vendedor::getErrores();
        $id = validarORedicionar('/admin');
        
        // Obtener Datos del vendedor
        $vendedor = Vendedor::find($id);

        if($_SERVER['REQUEST_METHOD']==='POST'){
            // Asignar los Valores
            $args = $_POST['vendedor'];
            
            // Sincronizar en memoria con lo que el usuario escribio 
            $vendedor-> sincronizar($args);
        
            // Validacion
            $errores = $vendedor->validar();
            
            if(empty($errores)){ 
                // Guardar en la bases de datos
                $vendedor->guardar();
        
            }
        }

        $router->render('/vendedores/actualizar', [
            'errores' => $errores,
            'vendedor' => $vendedor
        ]);
    }

    public static function eliminar ( ) {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Validar id
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id) {
                // Validar el tipo a eliminar
                $tipo = $_POST['tipo'];

                if(validarTipoContenido($tipo)) {
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                }
            }
        }
    }

}