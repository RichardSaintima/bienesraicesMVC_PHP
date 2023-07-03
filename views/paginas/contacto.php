<main class="contenedor seccion">
    <h1>Contactos</h1>

    <?php  if($mensaje) { ?>
        <p class='alerta exito'> <?php echo $mensaje ?></p>;
   
    <?php   } ?>


    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">
        <img src="build/img/destacada3.jpg" alt="Texto entrada blog">

        <h2>Llene el formulario de contacto</h2>

        <form class="formulario" action="/contacto" method="post">
            <fieldset>
                <legend>Imformacion personal</legend>

                <label for="nombre">Nombre</label>
                <input type="text" placeholder="Tu Nombre" id="nombre" name="contacto[nombre]" >

                <label for="mesaje">Mensaje</label>
                <textarea  id="mesaje"  name="contacto[mensaje]" ></textarea>
            </fieldset>

            <fieldset>
                <legend>Informacion sobre la propiedad</legend>

                <label for="opciones">Vende o Compra:</label>
                <select  id="opciones"  name="contacto[tipo]" >
                    <option value="" disabled selected>--Seleccionar--</option>
                    <option value="compra">Compra</option>
                    <option value="vender">Vender</option>
                </select>

                <label for="presupresto">Precio o Presupresto</label>
                <input type="number" placeholder="Tu Presupresto" id="presupresto"  name="contacto[precio]" >
            </fieldset>

            <fieldset>
                <legend>Informacion De Contacto</legend>

                <p>Como deseas ser contactado</p>
                <div class="forma-contactar">
                    <label for="contactar-telefono">Telefono</label>
                    <input type="radio" value="telefono" id="contactar-telefono"  name="contacto[contacto]" >

                    <label for="contactar-email">E-mail</label>
                    <input type="radio" value="email" id="contactar-email"  name="contacto[contacto]" >
                </div>

                <div class="" id="contacto"></div>


                
            </fieldset>

            <input type="submit" value="Enviar" class="boton-verde">
        </form>
    </picture>
</main>
