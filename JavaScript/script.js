// JavaScript en un archivo externo (por ejemplo, script.js)
function cambiarColor(celda) {
    // Obtiene el color del atributo data-color
    var color = celda.getAttribute("data-color");
    
    // Obtiene el contenido actual de la celda
    var contenido = celda.textContent;

    // Alterna la clase CSS para cambiar el color
    if (celda.classList.contains("celda-seleccionada")) {
        celda.classList.remove("celda-seleccionada");
        // Elimina la palabra "Puedo" del contenido
        contenido = contenido.replace("Puedo", "");
    } else {
        celda.classList.add("celda-seleccionada");
        // Agrega la palabra "Puedo" al contenido
        contenido = "Puedo " + contenido;
    }

    // Actualiza el contenido de la celda
    celda.textContent = contenido;
}