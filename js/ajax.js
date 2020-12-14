function add(i) {
    $.ajax({
        type: "GET",
        url: "Cesta.php",
        data: { add: i },
        success: function (response) {
            if (response == "OK") alert("El producto se ha añadido correctamente.")
            else alert(response);
        }
    });

}

function showCart() {
    $.ajax({
        type: "GET",
        url: "mostrarCesta.php",
        success: function (response) {
            $("#show").html(response);
        }
    });
}
setInterval(function () {
    showCart();
}, 5000);