<?php
include 'ProductoCesta.php';
if (!isset($_SESSION))
    session_start();
if (isset($_SESSION['cesta']) && count($_SESSION['cesta']) > 0) {
    // print_r($_SESSION['cesta']);
    $cont = 0;
    echo "<div class='showTable'><table>";
    echo "<thead><tr><th> Productos en la cesta </th><th>Nombre</th><th>Precio</th><th>Unidades</th></tr></thead>";
    foreach ($_SESSION['cesta'] as $producto) {
        $cont++;
        echo "<tr>";
        echo "<td><img width=\"150\" height=\"150\" src=\"data:image/*;base64, " . $producto->foto . "\" onerror=\"this.src='../uploads/NoImage.jpg'\"/></td>";
        echo "<td>$producto->nombre</td>";
        $precio = $producto->precio - $producto->precio * $producto->oferta / 100;
        if ($precio == $producto->precio) {
            echo "<td> $precio €";
        } else {
            echo "<td> <span style='text-decoration:line-through'>$producto->precio €</span>  <span>$precio €</span> ";
        }
        if ($producto->check(0))
            echo "</td> <td> $producto->unidades <img src='../uploads/mas.png' onclick='addfrom(" . $producto->id . ")'><img src='../uploads/menos.png' onclick='less(" . $producto->id . ")'><img src='../uploads/borrar.png' onclick='del(" . $producto->id . ")'></td> </tr>";
        else
            echo "</td> <td> No hay suficiente stock para este articulo <img src='../uploads/borrar.png' onclick='del(" . $producto->id . ")'></td> </tr>";
    }
    echo "</table></div>";
    echo ("<span>$cont productos en total</span>");
    echo '<br><input type="button" onclick="location.href=\'RealizarCompra.php\';" value="Comprar" class="boton">';
    
} else
    echo "<h2>No hay productos en la cesta<h2>";
