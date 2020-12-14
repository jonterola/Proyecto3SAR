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
function addfrom(i) {
    $.ajax({
        type: "GET",
        url: "Cesta.php",
        data: { add: i },
        success: function (response) {
            if (response.split(":")[0] == "ERROR") alert(response);
            showCart();
        }
    });

}
function less(i) {
    $.ajax({
        type: "GET",
        url: "Cesta.php",
        data: { less: i },
        success: function (response) {
            if (response != "OK") alert(response);
            showCart();
        }
    });

}

function del(i) {
    $.ajax({
        type: "GET",
        url: "Cesta.php",
        data: { del: i },
        success: function (response) {
            if (response != "OK") alert(response);
            showCart();
        }
    });

}