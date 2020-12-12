<!DOCTYPE html>
<html lang="es">

<?php
include '../html/Header.html';
include '../php/Menu.php';
 ?>
        <section>
            <h2>
                TODOS LOS PRODUCTOS <?php if(isset($_REQUEST['genero'])){ echo " DE ".strtoupper($_REQUEST['genero']);}?>
            </h2>
            <?php
            $xml = simplexml_load_file("../xml/productos.xml");

            $cont = 0;
            echo "<div id='tabla'><table>";
            echo "<thead><tr><th></th><th>Nombre</th><th>Precio</th></tr></thead>";
            if(isset($_REQUEST['genero'])){
                foreach($xml->children() as $producto){
                    if($producto->genero == $_REQUEST['genero']){
                        $cont++;
                        echo "<tr>";
                        echo "<td><img width=\"150\" height=\"150\" src=\"data:image/*;base64, ".$producto->imagen."\" alt=\"Sin imagen relacionada\"/></td>";
                        echo "<td>$producto->nombre</td>";
                        echo "<td>$producto->precio €</td>";
                        echo "</tr>";
                    }
                }
            }else{
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
            }
            echo "</table></div>";
            echo("<span>$cont productos en total</span>");
            ?>
        </section>

        <?php include '../html/Footer.html';?>

</html>