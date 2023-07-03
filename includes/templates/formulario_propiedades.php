<fieldset>
    <legend>Imformación General</legend>

    <label for="titulo">Titulo</label>
    <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Titulo Propiedad" value="<?php echo s( $propiedad->titulo ); ?>">

    <label for="precio">Precio</label>
    <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio Propiedad" value="<?php echo s( $propiedad->precio ) ;?>">

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="propiedad[imagen]">

    <?php if($propiedad->imagen) { ?>
        <img src="../../imagenes/<?php echo $propiedad->imagen ?>" class="imagen-small">
    <?php } ?>

    <label for="descripcion">Descripcion</label>
    <textarea name="propiedad[descripcion]" id="descripcion"  cols="" rows="" ><?php echo s( $propiedad->descripcion ); ?></textarea>
</fieldset>

<fieldset>
    <legend>Imformación De la Propiedad</legend>

    <label for="habitaciones">Habitaciones</label>
    <input type="number" id="habitaciones" name="propiedad[habitaciones]"  placeholder="Ej:3" min="1" max="9" value="<?php echo s( $propiedad->habitaciones ); ?>">

    <label for="wc">Baños</label>
    <input type="number" id="wc" name="propiedad[wc]" placeholder="Ej:3" min="1" max="9" value="<?php echo s( $propiedad->wc ); ?>">

    <label for="estacionamientos">Parking</label>
    <input type="number" id="estacionamientos" name="propiedad[estacionamientos]" placeholder="Ej:2" min="1" max="5" value="<?php echo s( $propiedad->estacionamientos ); ?>">
</fieldset>

<fieldset>
    <legend>Vendedor</legend>

    <label for="vendedor">Vendedor</label>
    <select name="propiedad[vendedorId]" id="vendedor">
        <option selected disabled value="">---- Seleccionar ----</option>
        <?php  foreach($vendedores as $vendedor) {  ?>
            <option 
            <?php echo $propiedad->vendedorId === $vendedor->id ? 'selected' : ''; ?>
            value="<?php echo s($vendedor->id); ?>" > 
            <?php echo s($vendedor->nombre) ." ". s($vendedor->apellido) ;  ?>
         </option>
        <?php } ?>
    </select>
</fieldset>