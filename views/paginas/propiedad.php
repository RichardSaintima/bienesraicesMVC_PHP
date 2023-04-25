<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $propiedad->titulo; ?></h1>

        <img loading="lazy" src="/imagenes/<?php echo $propiedad->imagen; ?>"" alt="Imagen de la Propiedad">


    <div class="resumen-propiedad">
        <div class="precio">$<?php  echo $propiedad->precio; ?></div>
        <ul class="icono-caracteristicos">
            <li>
                <img  class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                <p><?php  echo $propiedad->wc; ?></p>
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
        <div class="co">
            <?php echo $propiedad->descripcion;  ?>
        </div>
        
    </div>
</main>
