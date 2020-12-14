function validarProducto() {
    var categoria = document.getElementById("categoria").value;
    var genero = document.getElementById("genero").value;
    var nombreProducto = document.getElementById("nombreProducto").value;
    var precio = document.getElementById("precio").value;
    var oferta = document.getElementById("oferta").value;
    var stock = document.getElementById("stock").value;
    var error = document.getElementById("error");

    if (categoria.length > 20) {
        error.innerHTML = "La categoría debe contener menos de 20 caracteres.";
        return false;
    }
    if (genero.length > 20) {
        error.innerHTML = "El género debe contener menos de 20 caracteres.";
        return false;
    }
    if (nombreProducto.length > 50) {
        error.innerHTML = "El nombre del producto debe contener menos de 50 caracteres.";
        return false;
    }
    if (isNaN(precio)) {
        error.innerHTML = "El precio debe ser un número.";
        return false;
    }
    if (isNaN(oferta) || (oferta < 0 || oferta > 99)) {
        error.innerHTML = "La oferta debe ser un número entre 0 y 99.";
        return false;
    }
    if (isNaN(stock)) {
        error.innerHTML = "El stock debe ser un número.";
        return false;
    }
    return true;
}