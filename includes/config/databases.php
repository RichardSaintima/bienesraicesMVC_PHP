<?php

function conectarBD() : mysqli{
    $bd = new mysqli('localhost' , 'root' , 'Nachecael999' , 'bienesraices_crud');

    if(!$bd){
        echo "Error no se pudo conectar";
        exit;
    }

    return $bd;
}