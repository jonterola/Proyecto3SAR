<?php
include 'ProductoCesta.php';
if (!isset($_SESSION))
    session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<?php
include '../html/Header.html';
include '../php/Menu.php';
?>

<section id="show">
    <?php
    if (isset($_SESSION['cesta']) && count($_SESSION['cesta']) > 0) {
        $xml = simplexml_load_file("../xml/productos.xml");
        foreach ($_SESSION['cesta'] as $productoCesta) {
            foreach ($xml->children() as $producto) {
                if ($producto['id'] == $productoCesta->id) {
                    if ($producto->stock >= $productoCesta->unidades) {
                        $producto->stock -= $productoCesta->unidades;
                        break;
                    } else break;
                }
            }
        }
        $xml->asXML('../xml/productos.xml');
        $_SESSION['cesta'] = array();
        echo
            '<h2 style="text-align: center;">Compra realizada con exito! Pulse <a href="layout.php">aqui</a> para ir atras.<h2><br> <img src="https://media.giphy.com/media/YnkMcHgNIMW4Yfmjxr/giphy.gif" style="display: block;margin-left: auto;margin-right: auto;">;';
    } else
        echo '<h2 style="text-align: center;">No hay productos en la cesta o no ha iniciado sesion, pulse <a href="layout.php">aqui</a> para ir atras.<h2><br> <img src="https://media.giphy.com/media/9YhoD4RQeFkT6/giphy.gif" style="display: block;margin-left: auto;margin-right: auto;">;';
    ?>

</section>
<?php include '../html/Footer.html'; ?>


</html>