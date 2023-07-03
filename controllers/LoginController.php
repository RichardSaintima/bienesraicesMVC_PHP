<?php

namespace Controllers;
use MVC\Router;
use Model\Admin;
use Model\Propiedad;

class  LoginController {
    public static function login( Router $router) {
        $errores=[];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $auth = new Admin($_POST);

            $errores = $auth->validar();

            if(empty($errores)) {
                // Verificar si el usuario Existe
                
                $resultado = $auth->existeUsuario();

                if(!$resultado) {
                    // Verificar si el usuario Existe(Mensaje de Error)
                    $errores = Admin::getErrores();
                }else {
                    // Verificar el Password 
                    $autenticado = $auth->comprobarPassword($resultado);

                    if($autenticado) {
                        // Autenticado al Usuario
                        $auth->autenticar(); 

                    }else {
                        // Password Incorecto (Mensaje de Error)
                        $errores = Admin::getErrores();
                    }        
                }
            }
        }

        $router->render('auth/login',[
            'errores' => $errores,
        ]);
    }

    public static function logout() {
        session_start();
        $_SESSION =[];
        header('Location: /');
    }


}