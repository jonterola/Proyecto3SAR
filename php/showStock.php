<?php
    $XML_PATH = "../xml/productos.xml"
?>
<!DOCTYPE html>
<html lang="es">

<?php
include '../html/Header.html';
include '../php/Menu.php';
 ?>
        <section>
            <h2>
                TODOS LOS PRODUCTOS
            </h2>
        <?php

            if(!file_exists($XML_PATH) or !($xml = simplexml_load_file($XML_PATH))){
                echo('<p>Ha habido algún error al mostrar los productos. Disculpe las molestias');
            }
            $cont=0;
            echo "<div id='tabla'><table>";
            echo "<thead><tr><th></th><th>Nombre</th><th>Precio</th></tr></thead>";
            foreach($xml->producto as $producto){
                echo("
                        <tr>
                            <td><img width=\"150\" height=\"150\" src=\"data:image/*;base64, ".$producto->imagen."\" alt=\"Sin imagen relacionada\"/></td>
                            <td> $producto->nombre </td>
                            <td> $producto->precio €</td>
                        </tr> 
                ");
                $cont++;
            }
            echo("</table></div>");
            echo("<span>$cont productos en total</span>");

        ?>
    </section>

    <?php include '../html/Footer.html';?>

</html>