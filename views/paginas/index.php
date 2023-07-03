<main class="contenedor seccion">
    <h1>Más Sobre Nosotros</h1>

    <?php include 'iconos.php'?>
    
</main>

<section class="seccion contenedor">
    <h2>Casas y Depas en ventas</h2>
        
    <?php
        include 'listado.php';
    ?>

    <div class="alinear-derecha">
        <a href="/propiedades" class="boton boton-verde">Ver Todas</a>
    </div>
</section>

<section class="imagen-contacto">
    <h2>Encuentre la casa de tu sueño</h2>
    <p>Llena el formulario de contacto y un asesor te comtacta en brevedad</p>
    <a href="contacto.php" class="boton-amarillo">Contactános</a>
</section>

<div class="contenedor seccion seccion-inferior">
    <section class="blog">
        <h3>Nuestro Blog</h3>

        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog1.webp" type="image/webp">
                    <source srcset="build/img/blog1.jpg" type="image/jpeg">
                    <img src="build/img/blog1.jpg" alt="Texto entrada blog">
                </picture>
            </div>

            <div class="texto-entrada">
                <a href="entrada.php">
                    <h4>Terraza en el techo de tu casa</h4>
                    <p class="imformacion-meta">Escrito el: <span> 26/02/2023 </span> por: <span> Richard</span></p>

                    <p>
                            Consejos para construir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero
                    </p>
                </a>
            </div>
        </article>

        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog2.webp" type="image/webp">
                    <source srcset="build/img/blog2.jpg" type="image/jpeg">
                    <img src="build/img/blog2.jpg" alt="Texto entrada blog">
                </picture>
            </div>    

            <div class="texto-entrada">
                <a href="entrada.php">
                    <h4>Guía para la decoracion de tu hogares</h4>
                    <p class="imformacion-meta">Escrito el: <span> 26/02/2023 </span> por: <span> Richard</span></p>

                    <p>
                        Decorar tu casa con los mejores materiales y ahorrando dinero
                    </p>
                </a>
            </div>
        </article>
    </section>

    <section class="testimoniales">
        <h3>Testimoniales</h3>

        <div class="testimonial">
            <blockquote>
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Facilis, ipsum cumque. Tempore omnis, id quos modi 
            </blockquote>
            <p>- Stanley Richard</p>
        </div>
    </section>
</div>
