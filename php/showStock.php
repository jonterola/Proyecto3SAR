<?php
    $XML_PATH = "../xml/productos.xml"
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Productos</title>
        <meta charset="UTF-8">
    <head>
    <body>
        <h1>Todos los Productos</h1>
        <?php

            if(!file_exists($XML_PATH) or !($xml = simplexml_load_file($XML_PATH))){
                echo('<p>Ha habido algún error al mostrar los productos. Disculpe las molestias');
            }
            $cont=0;
            echo("<table>");
            foreach($xml->producto as $producto){
                echo("
                        <tr>
                            <td> $producto->nombre </td>
                            <td> $producto->precio </td>
                        </tr> 
                ");
                $cont++;
            }
            echo("</table>");
            echo("<span>$cont productos en total</span>");

        ?>
    <body>
</html>