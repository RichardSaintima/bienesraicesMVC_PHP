
<main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesion</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
            <?php echo $error; ?>
            </div>
        <?php endforeach; ?>
        <form method="POST" class="formulario" action="/login" novalidate>
            <fieldset>
                <legend>Imformacion personal</legend>
                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="Tu Correo" id="email">

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Tu password" id="password">
            </fieldset>

            <input type="submit" value="Iniciar Sesion" class="boton boton-verde">
        </form>
    </main>