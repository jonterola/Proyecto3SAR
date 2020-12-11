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
            <h1>TIENDA DE ROPA DEL TEAM GARDFOLD</h1>
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
            $xml = simplexml_load_file("../xml/productos.xml");

            echo "<div id='tabla'><table>";
            echo "<thead><tr><th>Nombre</th><th>Precio</th></tr></thead>";
            foreach($xml->children() as $producto){
                if($producto->genero == "hombre"){
                    echo "<tr>";
                    echo "<td>$producto->nombre</td>";
                    echo "<td>$producto->precio €</td>";
                    echo "</tr>";
                }
            }
            echo "</table></div>";
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