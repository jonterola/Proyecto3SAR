function validarOferta() {
    var oferta = document.getElementById("oferta").value;
    var error = document.getElementById("error");

    if (oferta < 0 || oferta > 100) {
        error.innerHTML("El descuento debe ser un número entre 0 y 100");
        return false;
    }
    return true;
}