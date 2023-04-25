document.addEventListener("DOMContentLoaded",function(){

        eventListeners();

        darkMode();        
});

function darkMode(){
    const prefereDarkMode = window.matchMedia("(prefers-color-scheme: dark)");

    // console.log(preferedarkMode.matches);
    if(prefereDarkMode.matches){
        document.body.classList.add("dark-mode");
    }else{
        document.body.classList.remove("dark-mode");
    }

    prefereDarkMode.addEventListener("change" ,function(){
        if(prefereDarkMode.matches){
            document.body.classList.add("dark-mode");
        }else{
            document.body.classList.remove("dark-mode");
        }
    });

    const botonDarkMode= document.querySelector(".dark-mode-boton");

    botonDarkMode.addEventListener("click" ,function(){
        document.body.classList.toggle("dark-mode");
    })
}

function eventListeners(){
    const mobileMenu =document.querySelector(".mobile-menu");

    mobileMenu.addEventListener("click" ,navegacionResponsive);

    // Muestra Campos condicionales
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    metodoContacto.forEach(input =>input.addEventListener('click', mostrarMetodoContacto));

}

function navegacionResponsive(){
        const navegacion= document.querySelector(".navegacion");

        if(navegacion.classList.contains("mostrar")){
            navegacion.classList.remove("mostrar");
        }else{
            navegacion.classList.add("mostrar");
        }
        // O navegacion.classList.toggle("mostrar");
}

function mostrarMetodoContacto(evt) {
    const contactoDiv = document.querySelector('#contacto');

    if(evt.target.value === 'telefono') {
        contactoDiv.innerHTML = `
        <label for="telefono">Ingrasa tu N° de Telefono</label>
        <input type="tel" placeholder="Tu Telefono" id="telefono" name="contacto[telefono]">

        <p>Elija la fecha y la hora Para la llamada</p>
                
        <label for="fecha">Fecha:</label>
        <input type="date"  id="fecha"  name="contacto[fecha]">

        <label for="hora">Hora:</label>
        <input type="time"  id="hora" min="08:30" max="18:00"  name="contacto[hora]">

        `;
    }else{
        contactoDiv.innerHTML = `  
        <label for="email">Ingrasa tu E-mail</label>
        <input type="email" placeholder="Tu Correo" id="email" name="contacto[email]" >
        `;
    }
}