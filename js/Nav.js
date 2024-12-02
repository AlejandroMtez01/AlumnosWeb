
function mostar_nomostrar_subMenu() {
    var claseComun = this.classList[1];

    console.log(claseComun)
    
    var css = '.subBotones.' + claseComun;


    var elemento = document.querySelector(css);

    // console.log(this);



    // console.log(elemento.classList)
    var clases = elemento.className;

    if (clases.includes("hidden")) {
        // console.log(elemento);
        elemento.classList.remove("hidden");
        elemento.classList += " visible";
        this.children[0].src = "resources/icons/flecha_hacia_arriba.png";

    } else {
        elemento.classList.remove("visible");
        elemento.classList += " hidden";
        this.children[0].src = "resources/icons/flecha_hacia_abajo.png"


    }
}

function crearTitulo(texto) {
    var principal = document.querySelector(".navGeneral");

    var div = document.createElement("div");
    div.className = "tituloNav";
    var span = document.createElement("span");
    span.className = "navTexto";
    span.innerHTML = texto;

    principal.appendChild(div);
    div.appendChild(span);


}

// function crearMenus3(clase, titulo, estilo, boolean) {
//     var principal = document.querySelector(".navGeneral");

//     var botonesNav = document.createElement("div");
//     botonesNav.style="display: flex;"
//     botonesNav.className = "perfilNav " + clase;

//     var a = document.createElement("a");
//     a.href = clase + ".php";

//     var div = document.createElement("div");
//     div.className=estilo+" estilos";

//     var span2 = document.createElement("div");
//     span2.innerText = "AM";

//     div.appendChild(span2)

//     var span = document.createElement("span");
//     span.className = titulo;
//     span.innerHTML = titulo;

//     principal.appendChild(botonesNav);
//     botonesNav.appendChild(a);
//     a.appendChild(div);
//     a.appendChild(span);

//     if (boolean) {
//         var expandirMenu = document.createElement("div");
//         expandirMenu.className = "expandirMenu";

//         var flecha = document.createElement("button");
//         flecha.className = "flecha " + clase;

//         var imgflecha = document.createElement("img");
//         imgflecha.src = "resources/icons/flecha_hacia_abajo.png";

//         botonesNav.appendChild(expandirMenu);
//         expandirMenu.appendChild(flecha);
//         flecha.appendChild(imgflecha);

//     }
// }

function obtenerEstilo(num) {


    // console.log("Valor de id: "+num)

   for (let i = 7; i > 0; i--) {
    if(parseInt(num)%i==0){
        return i;
    }else{
        // console.log("La comprobación "+num+"/"+i+" no da de resto 0");

    }
    
   }
}

function crearMenus4(clase, titulo, estilo, boolean) {
    var principal = document.querySelector(".navGeneral");
    estilo = obtenerEstilo(estilo);





    var botonesNav = document.createElement("div");
    botonesNav.className = "botonesNav especial " + clase;

    var a = document.createElement("a");
    //a.href = clase + ".php";

    var imgPersonalizada = document.createElement("div");
    imgPersonalizada.className += "estilo" + estilo + "BG" + " imgPersonalizada";

    var spanImg = document.createElement("span");
    //Reemplazar todos los valores en minúscula y sustituy el espacio por punto
    var iniciales = titulo.replace(/[a-záéíóú]/g, "").replace(" ", ".");
    spanImg.innerHTML = iniciales;


    spanImg.className = "estilo" + estilo + "FG";
    imgPersonalizada.appendChild(spanImg);
    var span = document.createElement("span");

    //
    nombreAbreviado = titulo.substring(0, titulo.search(" ")) + " " + iniciales.charAt(2) + ".";

    span.innerHTML = nombreAbreviado;

    principal.appendChild(botonesNav);
    botonesNav.appendChild(a);
    a.appendChild(imgPersonalizada);
    a.appendChild(span);

    if (boolean) {
        var expandirMenu = document.createElement("div");
        expandirMenu.className = "expandirMenu";

        var flecha = document.createElement("button");
        flecha.className = "flecha " + clase;

        var imgflecha = document.createElement("img");
        imgflecha.src = "resources/icons/flecha_hacia_abajo.png";

        botonesNav.appendChild(expandirMenu);
        expandirMenu.appendChild(flecha);
        flecha.appendChild(imgflecha);

    }
}

function crearMenus(clase, titulo, imagen, boolean) {
    var principal = document.querySelector(".navGeneral");

    var botonesNav = document.createElement("div");
    botonesNav.className = "botonesNav " + clase;

    var a = document.createElement("a");
    a.href = clase + ".php";

    var img = document.createElement("img");
    img.src = imagen;
    img.setAttribute("width", "18");
    img.setAttribute("height", "18");
    var span = document.createElement("span");
    span.className = titulo;
    span.innerHTML = titulo;

    principal.appendChild(botonesNav);
    botonesNav.appendChild(a);
    a.appendChild(img);
    a.appendChild(span);

    if (boolean) {
        var expandirMenu = document.createElement("div");
        expandirMenu.className = "expandirMenu";

        var flecha = document.createElement("button");
        flecha.className = "flecha " + clase;

        var imgflecha = document.createElement("img");
        imgflecha.src = "resources/icons/flecha_hacia_abajo.png";

        botonesNav.appendChild(expandirMenu);
        expandirMenu.appendChild(flecha);
        flecha.appendChild(imgflecha);

    }
}

function crearMenus(clase, titulo, imagen, boolean) {
    var principal = document.querySelector(".navGeneral");

    var botonesNav = document.createElement("div");
    botonesNav.className = "botonesNav " + clase;

    var a = document.createElement("a");
    a.href = clase + ".php";

    var img = document.createElement("img");
    img.src = imagen;
    img.setAttribute("width", "18");
    img.setAttribute("height", "18");
    var span = document.createElement("span");
    span.className = titulo;
    span.innerHTML = titulo;

    principal.appendChild(botonesNav);
    botonesNav.appendChild(a);
    a.appendChild(img);
    a.appendChild(span);

    if (boolean) {
        var expandirMenu = document.createElement("div");
        expandirMenu.className = "expandirMenu";

        var flecha = document.createElement("button");
        flecha.className = "flecha " + clase;

        var imgflecha = document.createElement("img");
        imgflecha.src = "resources/icons/flecha_hacia_abajo.png";

        botonesNav.appendChild(expandirMenu);
        expandirMenu.appendChild(flecha);
        flecha.appendChild(imgflecha);

    }
}

function crearSubMenus(palabra, subElementos) {
    //Creación de subBotones
    var subBotones = document.createElement("div");
    subBotones.className = "subBotones " + palabra;
    subBotones.ariaExpanded = false;
    //subBotones.hidden = true;
    subBotones.classList += " hidden";

    for (let i = 0; i < subElementos.length; i++) {
        //Creación de a
        var a = document.createElement("a");
        a.href = subElementos[i].replaceAll(" ", "_").toLowerCase() + ".php";

        //Creación de subBotonesNav
        var subBotonesNav = document.createElement("div");
        subBotonesNav.className = "subBotonesNav " + subElementos[i];

        //Creación de contenedorSubB
        var contenedorSubB = document.createElement("div");
        contenedorSubB.className = "contenedorSubB";
        contenedorSubB.innerHTML = subElementos[i];


        //Añadiendo los elementos niños a las clases pertinentes
        document.querySelector("div.navGeneral").appendChild(subBotones);
        subBotones.appendChild(a);
        a.appendChild(subBotonesNav);
        subBotonesNav.appendChild(contenedorSubB);


    }
}
function activarElemento(nombrePagina) {
    console.log("Página: " + nombrePagina)

    var elemento = document.querySelector(".botonesNav." + nombrePagina);


    //Comprobamos si se trata de un botón
    if (elemento != null) {
        elemento.classList.remove("hidden");
        elemento.classList.add("active");

        var botonPrincipal = elemento.firstChild.firstChild;
        botonPrincipal.src = botonPrincipal.src.substring(0, botonPrincipal.src.length - 4) + "-use.svg";





        var a = document.querySelector(".subBotones a[href='" + nombrePagina.toLowerCase() + ".php']");

        //Si a no es null, significa que también se trata de un subBotón
        if (a != null) {
            var elementoPadre = a.parentElement
            a.children[0].className += " active";
            elementoPadre.classList.remove("hidden");
            elementoPadre.classList.add("visible")
            elemento.ariaExpanded = true;
        }


    }
    //Si no se trata de un botón, y por ende, se trata de un subbotón
    else {
        //Obtenemos el elemento a
        var a = document.querySelector(".subBotones a[href='" + nombrePagina.toLowerCase() + ".php']");

        //Obtenemos el elemento contenedor que contiene los subElementos
        var elementoPadre = a.parentElement;
        //Quitamos la clase hidden y añadimos la visible
        elementoPadre.classList.remove("hidden");
        elementoPadre.classList.add("visible")

        //Añadimos la clase active al elemento hijo del a (div)
        a.children[0].className += " active";

        elementoPadre.ariaExpanded = true;

        elementoPadre.previousSibling.className += " active";
        var botonPrincipal = elementoPadre.previousSibling.firstChild.firstChild;
        botonPrincipal.src = botonPrincipal.src.substring(0, botonPrincipal.src.length - 4) + "-use.svg";
        console.log(botonPrincipal.src.substring(0, botonPrincipal.src.length - 4) + "-use.svg");

    }

}
function crearNav(nombreUsuario, estilo, admin) {

    /*if (admin) {
        //Menú unicamente para administradores de empresas
        crearMenus("admin", "Administrador", "resources/icons/admin.svg", true);
        var palabra = "admin";
        var subElementos = ["Departamentos", "Empleados","Festivos","Gestion Ausencias"];
        crearSubMenus(palabra, subElementos);
    }*/


    crearTitulo("GESTIÓN ALUMNOS");
    crearMenus("alumnos", "Alumnos", "resources/icons/home.svg", false);
    crearMenus("clasesSemanales", "Clases Semanales", "resources/icons/mentor.png", false);
    crearMenus("clases", "Clases", "resources/icons/mentor.png", false);

    crearTitulo("RECURSOS");
    crearMenus("alumnos", "Alumnos", "resources/icons/home.svg", false);




    //crearMenus("notificaciones", "Bandeja de entrada", "resources/icons/email.svg", true);



    //Menú unicamente para administradores de la aplicación

    //var palabra = "notificaciones";
    //var subElementos = ["Notificaciones","Solicitudes"];
    //crearSubMenus(palabra, subElementos);

    //crearTitulo("TÚ");

    //crearMenus("Perfil", "Mi Perfil", "resources/icons/perfil.svg", true);
    //var palabra = "Perfil";
    //var subElementos = ["Perfil", "Personal"];
    //crearSubMenus(palabra, subElementos);

    //crearMenus("ausencias", "Ausencias", "resources/icons/ausencia.svg", false);


    //crearTitulo("DISPONIBILIDAD");
    /*crearMenus("empleados", "Empleados", "resources/icons/equipo.svg", true);

    var palabra = "empleados";
    var subElementos = ["Empleados", "Equipos"];
    crearSubMenus(palabra, subElementos);*/

    /*crearMenus("Calendario", "Calendario", "resources/icons/calendario.svg", true);

    var palabra = "Calendario";
    var subElementos = ["Calendario", "Vista del Equipo"];
    crearSubMenus(palabra, subElementos);

    crearMenus4("perfil2", nombreUsuario, estilo, true);

    var palabra = "perfil2";
    var subElementos = ["Cambiar Contraseña", "Cerrar Sesión"];
    crearSubMenus(palabra, subElementos);


    crearSubMenus(palabra, subElementos);

    //Añadir evento a las flechas hacia abajo
    var botones = document.querySelectorAll('button');

    for (var i = 0; i < botones.length; i++) {
        botones[i].addEventListener('click', mostar_nomostrar_subMenu);
    }
        */
}
