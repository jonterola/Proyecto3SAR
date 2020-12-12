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
                <li><a href="#">Iniciar sesión</a></li>
                <li><a href="#">Registrarse</a></li>
            </ul>
        </nav>

        <section>
            <h2>
                ÚLTIMOS EN ENTRAR AL CATÁLOGO
            </h2>
            <?php
                $xml = simplexml_load_file("../xml/productos.xml");

                $imagen = $xml->xpath("/productos/producto[last()]/imagen");
                $nombre = $xml->xpath("/productos/producto[last()]/nombre"); 
                $precio = $xml->xpath("/productos/producto[last()]/precio");               
                echo "<img width=\"450\" height=\"450\" src=\"data:image/*;base64, ".$imagen[0]."\" alt=\"Sin imagen relacionada\"/>";              
                echo "<h3><pre>                 ".$nombre[0]."      ".$precio[0]."€</pre></h3>";
            ?>
        </section>

        <aside>
            <h4><a href="showStock.php">Todos los productos</a></h4>
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