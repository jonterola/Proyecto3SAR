<?php
include 'ProductoCesta.php';
if (!isset($_SESSION))
    session_start();
if (isset($_SESSION['email'])) {
    if (isset($_GET['add'])) {
        if (!is_numeric($_GET['add']))
            die("ERROR: ID incorrecto.");
        if (isset($_SESSION['cesta'])) {
            foreach ($_SESSION['cesta'] as $producto) {
                if ($producto->id == $_GET['add']) {
                    if ($producto->add())
                        die('OK');
                    else
                        die('ERROR: No hay suficiente stock de ese articulo o no existe.');
                }
            }
            $producto = new ProductoCesta;
            if ($producto->crear($_GET['add'])) {
                array_push($_SESSION['cesta'], $producto);
                die("OK");
            } else {
                die("ERROR: No hay suficiente stock de ese articulo o no existe.");
            }
        } else {
            $producto = new ProductoCesta;
            if ($producto->crear($_GET['add'])) {
                $_SESSION['cesta'] = array($producto);
                die("OK");
            } else {
                die("ERROR: No hay suficiente stock de ese articulo o no existe.");
            }
        }
    } elseif (isset($_GET['less'])) {
        if (!is_numeric($_GET['less']))
            die("ERROR: ID incorrecto.");
        if (isset($_SESSION['cesta'])) {
            foreach ($_SESSION['cesta'] as $producto) {
                if ($producto->id == $_GET['less']) {
                    if ($producto->sub())
                        die('OK');
                    else {
                        eliminarElemento($_GET['less']);
                        die('OK');
                    }
                }
            }
        } else
            die("ERROR: No hay articulos en la cesta.");
    } elseif (isset($_GET['del'])) {
        if (!is_numeric($_GET['del']))
            die("ERROR: ID incorrecto.");
        eliminarElemento($_GET['del']);
        die("OK");
    }
} else {
    die("ERROR: No estas logeado");
}


function eliminarElemento($id)
{
    $array = $_SESSION['cesta'];
    $arrayNew = array();
    foreach ($array as $producto) {
        if ($producto->id != $id) array_push($arrayNew, $producto);
    }
    $_SESSION['cesta'] = $arrayNew;
}
?>
<!DOCTYPE html>
<html lang="es">

<?php
include '../html/Header.html';
include '../php/Menu.php';
?>

<section id="show">

</section>

<?php include '../html/Footer.html'; ?>
<script>
    showCart();
    setInterval(function() {
        showCart();
    }, 5000);
</script>

</html>