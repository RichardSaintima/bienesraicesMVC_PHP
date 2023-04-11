<?php
    use App\Propiedad;

    

    if($_SERVER['SCRIPT_NAME']=== '/anuncios.php'){
        $propiedades= Propiedad::all();
    }else{
        $propiedades= Propiedad::get(3);
    }
?>

    <div class="contenedor-anuncios">
        <?php foreach ($propiedades as $propiedad) { ?>
        <div class="anuncios">

            <img loading="lazy" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="Imagen anuncios">

            <div class="contenido-anuncio">
                <h3><?php echo $propiedad->titulo; ?></h3>
                <p><?php echo $propiedad->descripcion; ?></p>

                <p class="precio"><?php echo $propiedad->precio; ?></p>

                <ul class="icono-caracteristicos">
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                        <p><?php echo $propiedad->wc; ?></p>
                    </li>
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                        <p><?php echo $propiedad->estacionamientos; ?></p>
                    </li>
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                        <p><?php echo $propiedad->habitaciones; ?></p>
                    </li>
                </ul>

                <a href="anuncio.php?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">
                    ver Propiedad
                </a>
            </div> <!--Contenido anuncio-->
        </div><!--Anuncio-->
        <?php };?>      
    </div><!---->
