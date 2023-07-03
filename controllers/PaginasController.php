<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController {
    public static function index( Router $router) {
        $propiedades = Propiedad::get(3);
        $inicio = true;

        $router-> render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ]);
    }
    public static function nosotros( Router $router ) {

        $router-> render('paginas/nosotros');

    }
    public static function propiedades( Router $router ) {
        $propiedades = Propiedad::all();

        $router-> render('paginas/propiedades', [
            'propiedades' => $propiedades,

        ]);
    }
    public static function propiedad( Router $router ) {
        $id = validarORedicionar('/propiedades');

        // Buscar la propiedad por su id
        $propiedad= Propiedad::find($id);

        $router-> render('paginas/propiedad', [
            'propiedad' => $propiedad,

        ]);
    }
    public static function blog( Router $router ) {
       
        
        $router-> render('paginas/blog', [
        
        ]);
    }
    public static function entrada( Router $router ) {
       
        
        $router-> render('paginas/entrada', [

        ]);
    }
    public static function contacto( Router $router  ) {

        $mensaje = null;

       if($_SERVER['REQUEST_METHOD']==='POST'){
;
        $respuestas = $_POST['contacto'];

        // Crear una intancia de PHPMailer.
        $mail = new PHPMailer();

        // Configurar SMTP
        $mail-> isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = '40e16833e5e7ed';
        $mail->Password = 'a5cbdba8d6dcb0';
        $mail->SMTPSecure = 'tls'; 
        $mail->Port = 2525;

        // Configurar el contenido mail
        $mail->setFrom('admin@bienesraices.com');//Quien Envia el Email
        $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com' );//La direccion donde lo va a recibir
        $mail->Subject = 'Tienes un Nuevo Mensaje';

        // Habilitar HTML
        $mail->isHTML(true);
        $mail-> CharSet = 'UTP-8';//Es para Habilitar Acentos

        // Definir contenido
        $contenido = '<html>';
        $contenido .= '<p>Tienes un nuevo mensaje</p>';
        $contenido .= '<p>Nombre: ' . $respuestas['nombre']  . ' </p>';

        // Enviar de forma condinal alguna campos de email o telefono
        if($respuestas['contacto'] === 'telefono') {
            $contenido .= '<p>Eligio ser contactado por Telefono </p>';
            $contenido .= '<p>Telefono: ' . $respuestas['telefono']  . ' </p>';
            $contenido .= '<p>Fecha de Contacto: ' . $respuestas['fecha']  . ' </p>';
            $contenido .= '<p>Hora de  Contacto: ' . $respuestas['hora']  . ' </p>';
        }else{
            // Es Email , entonces agregamps el campo de email
            $contenido .= '<p>Eligio ser contactado por Email </p>';
            $contenido .= '<p>Email: ' . $respuestas['email']  . ' </p>';
        }

        $contenido .= '<p>Mensaje: ' . $respuestas['mensaje']  . ' </p>';
        $contenido .= '<p>Compra o Venta: ' . $respuestas['tipo']  . ' </p>';
        $contenido .= '<p>Precio o Presupuesto: $' . $respuestas['precio']  . ' </p>';
        $contenido .= '<p>Prefere ser Contacto por: ' . $respuestas['contacto']  . ' </p>';
        $contenido .= '</html>';


        $mail->Body =$contenido;
        $mail->AltBody = 'Este es un texto Altenativo Sin HTML ';

        // Enviar el email
        if($mail->send()){
            $mensaje = "Mensaje enviado Correctamente";
        }else{
            $mensaje = "Mensaje no se pudo enviar.... ";
        }
        
       }
        
        $router-> render('paginas/contacto', [
            'mensaje' => $mensaje,

        ]);
    }
}