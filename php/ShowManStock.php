<!DOCTYPE html>
<html lang="es">

<?php
include '../html/Header.html';
include '../php/Menu.php';
 ?>
        <section>
            <h2>
                PRODUCTOS DE HOMBRE
            </h2>
            <?php
            $xml = simplexml_load_file("../xml/productos.xml");

            $cont = 0;
            echo "<div id='tabla'><table>";
            echo "<thead><tr><th></th><th>Nombre</th><th>Precio</th></tr></thead>";
            foreach($xml->children() as $producto){
                if($producto->genero == "hombre"){
                    $cont++;
                    echo "<tr>";
                    echo "<td><img width=\"150\" height=\"150\" src=\"data:image/*;base64, ".$producto->imagen."\" alt=\"Sin imagen relacionada\"/></td>";
                    echo "<td>$producto->nombre</td>";
                    echo "<td>$producto->precio €</td>";
                    echo "</tr>";
                }
            }
            echo "</table></div>";
            echo("<span>$cont productos en total</span>");
            ?>
        </section>

        <?php include '../html/Footer.html';?>

</html>