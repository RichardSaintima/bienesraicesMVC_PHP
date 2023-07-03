<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController{

    public static function index( Router $router) {
        
        $propiedades = Propiedad::all();
        $vendedores= Vendedor::all();



        // Muestre mensaje condiacional
        $resultado= $_GET['resultado'] ?? null;

        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'resultado' => $resultado,
            'vendedores' => $vendedores
        ]);
    }

    public static function crear( Router $router) {
        
        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();
        // Arreglo con mensajes de vendedores
        $errores = Propiedad::getErrores();

        if($_SERVER['REQUEST_METHOD']==='POST'){
             // Crear una nueva Instancia
        $propiedad =new Propiedad($_POST['propiedad']);
    

        /* SUBIDA DE IMAGENES */
        //Generar Nombre unico 
        $nombreImagen = md5(uniqid(rand(),true) ).".jpg";
        
        // Settear la Imagen
        // Realizar un Resize a ña Imagen con Intervention
        if($_FILES['propiedad']['tmp_name']['imagen']) {
            $image =Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(600, 360);
            $propiedad->setImagen($nombreImagen);
        }     

        // Validar
        $errores = $propiedad->validar();

        // Revisar que el array esta vacio
        if(empty($errores)){  

            // Crear una Carpeta
            if(!is_dir(CARPETA_IMAGENES)){
                mkdir(CARPETA_IMAGENES);
            }
            // Guardar la Imagen el el servidor
            $image->save(CARPETA_IMAGENES . $nombreImagen);

            // Guardar en la bases de datos
            $propiedad->guardar();

         }
        }
            

        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores,
            
        ]);
    }

    public static function actualizar(Router $router) {
        $id = validarORedicionar('/admin');
        $propiedad =Propiedad::find($id);
        $vendedores = Vendedor::all();

        $errores = Propiedad::getErrores();


        // Metodo POST para actualizar.
        if($_SERVER['REQUEST_METHOD']==='POST'){

            // Asignar el atributos
            $args=$_POST['propiedad'];
    
            $propiedad -> sincronizar($args);
    
    
            // Validacion
            $errores= $propiedad->validar();
    
            /* SUBIDA DE IMAGENES */
            //Generar Nombre unico 
            $nombreImagen = md5(uniqid(rand(),true) ).".jpg";
            
            // Settear la Imagen
            // Realizar un Resize a ña Imagen con Intervention
            if($_FILES['propiedad']['tmp_name']['imagen']){
                $image =Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(600, 360);
                $propiedad->setImagen($nombreImagen);
            }      
            // Revisar que el array esta vacio
            if(empty($errores)){
                if($_FILES['propiedad']['tmp_name']['imagen']){
                // Almacenar la Imagen
                $image->save(CARPETA_IMAGENES . $nombreImagen);
               } // Guardar en la bases de datos
                $propiedad->guardar();
            }
        }

        $router->render('/propiedades/actualizar', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores,
        ]);
    }

    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD']=== 'POST'){
            // Validar id
            $id = $_POST['id'];
            $id = filter_var($id , FILTER_VALIDATE_INT);
            
            if($id){
                $tipo = $_POST['tipo'];
                
                if(validarTipoContenido($tipo)){
                    // Obtener los datos de la propiedad
                    $propiedad = Propiedad::find($id);
                    $propiedad ->eliminar();
                }
    
            }
        }
    }
}