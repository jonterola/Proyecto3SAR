<?php error_reporting (E_ALL ^ E_NOTICE); ?>
<?php if (!isset($_SESSION))
    session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<?php
include '../html/Header.html';
include '../php/Menu.php';
?>

<section>
    <h2>
        ÚLTIMOS EN ENTRAR AL CATÁLOGO
    </h2>
    <?php
    $xml = simplexml_load_file("../xml/productos.xml");

    $imagen = $xml->xpath("/productos/producto[last()]/imagen");
    $nombre = $xml->xpath("/productos/producto[last()]/nombre");
    $precio = $xml->xpath("/productos/producto[last()]/precio");
    echo "<img width=\"450\" height=\"450\" src=\"data:image/*;base64, " . $imagen[0] . "\" onerror=\"this.src='../uploads/NoImage.jpg'\"/>";
    echo "<h3><pre>                 " . $nombre[0] . "      " . $precio[0] . "€</pre></h3>";
    ?>
</section>

<?php include '../html/Footer.html'; ?>

</html>