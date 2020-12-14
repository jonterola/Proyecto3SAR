<?php if (!isset($_SESSION))
    session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<?php
include '../html/Header.html';
include '../php/Menu.php';
?>
<section>
    <!-- <h2>
        TODOS LOS PRODUCTOS <?php if (isset($_REQUEST['genero'])) {
                                echo " DE " . strtoupper($_REQUEST['genero']);
                            } ?>
    </h2> -->
    <?php
    $xml = simplexml_load_file("../xml/productos.xml");

    $cont = 0;
    echo "<div id='tabla'><table>";
    //echo "<thead><tr><th></th><th>Nombre</th><th>Precio</th></tr></thead>";
    if (isset($_REQUEST['genero'])) {
        echo "<thead><tr><th> Productos de " . $_REQUEST['genero'] . " </th><th>Nombre</th><th>Precio</th></tr></thead>";
        foreach ($xml->children() as $producto) {
            if ($producto->genero == $_REQUEST['genero'] && $producto->stock > 0) {
                $cont++;
                echo "<tr>";
                echo "<td><img width=\"150\" height=\"150\" src=\"data:image/*;base64, " . $producto->imagen . "\" onerror=\"this.src='../uploads/NoImage.jpg'\"/></td>";
                echo "<td>$producto->nombre</td>";
                $precio = $producto->precio - $producto->precio * $producto->oferta / 100;
                if ($precio == $producto->precio) {
                    echo "<td> $precio €</td>";
                } else {
                    echo "<td> <span style='text-decoration:line-through'>$producto->precio €</span>  <span >$precio €</span> </td>";
                }
                echo "</tr>";
            }
        }
    } else if (isset($_REQUEST['novedad'])) {
        echo "<thead><tr><th> Novedades  </th><th>Nombre</th><th>Precio</th></tr></thead>";

        foreach ($xml->children() as $producto) {
            if (strtotime($producto->fecha) >= strtotime("-1 week") && $producto->stock > 0) {
                $cont++;
                echo "<tr>";
                echo "<td><img width=\"150\" height=\"150\" src=\"data:image/*;base64, " . $producto->imagen . "\" onerror=\"this.src='../uploads/NoImage.jpg'\"/></td>";
                echo "<td>$producto->nombre</td>";
                $precio = $producto->precio - $producto->precio * $producto->oferta / 100;
                if ($precio == $producto->precio) {
                    echo "<td> $precio €</td>";
                } else {
                    echo "<td> <span style='text-decoration:line-through'>$producto->precio €</span>  <span>$precio €</span> </td>";
                }
                echo "</tr>";
            }
        }
    } else if (isset($_REQUEST['oferta'])) {
        echo "<thead><tr><th> Ofertas </th><th>Nombre</th><th>Precio</th></tr></thead>";

        foreach ($xml->children() as $producto) {
            if ($producto->oferta != 0 && $producto->stock > 0) {
                $cont++;
                echo "<tr>";
                echo "<td><img width=\"150\" height=\"150\" src=\"data:image/*;base64, " . $producto->imagen . "\" onerror=\"this.src='../uploads/NoImage.jpg'\"/></td>";
                echo "<td>$producto->nombre</td>";
                $precio = $producto->precio - $producto->precio * $producto->oferta / 100;
                if ($precio == $producto->precio) {
                    echo "<td> $precio €</td>";
                } else {
                    echo "<td> <span style='text-decoration:line-through'>$producto->precio €</span>  <span>$precio €</span> </td>";
                }
                echo "</tr>";
            }
        }
    } else {
        echo "<thead><tr><th> Todos los productos </th><th>Nombre</th><th>Precio</th></tr></thead>";
        foreach ($xml->producto as $producto) {
            if($producto->stock > 0){
                echo "<tr>";
                echo "<td><img width=\"150\" height=\"150\" src=\"data:image/*;base64, " . $producto->imagen . "\" onerror=\"this.src='../uploads/NoImage.jpg'\"/></td>";
                echo "<td>$producto->nombre</td>";
                $precio = $producto->precio - $producto->precio * $producto->oferta / 100;
                if ($precio == $producto->precio) {
                    echo "<td> $precio €</td>";
                } else {
                    echo "<td> <span style='text-decoration:line-through'>$producto->precio €</span>  <span>$precio €</span> </td>";
                }
                echo "</tr>";
                $cont++;
            }
        }
    }
    echo "</table></div>";
    echo ("<span>$cont productos en total</span>");
    ?>
</section>

<?php include '../html/Footer.html'; ?>

</html>