<?php
    $XML_PATH = "../xml/productos.xml"
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <LINK REL="stylesheet" TYPE="text/css" HREF="../styles/estilos.css">
</head>

<body>

    <div class="container">


        <header>
            <h1><a href="layout.php">TIENDA DE ROPA DEL TEAM GARDFOLD</a></h1>
        </header>


        <nav>
            <ul>
                <li><a href="#">Iniciar sesion</a></li>
                <li><a href="#">Registrarse</a></li>
            </ul>
        </nav>

        <section>
            <h2>
                PRODUCTOS DE HOMBRE
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

<aside>
    <h4><a href="showStock.php">Todos los productos<a></h4>
    <h4>Novedades</h4>
    <h4><a href="showManStock.php">Hombre</a></h4>
    <h4><a href="showWomanStock.php">Mujer</a></h4>
    <h4>Ofertas</h4>




</aside>

<footer>
    
</footer>


</div>
</body>

</html>