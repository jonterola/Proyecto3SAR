<!DOCTYPE html>
<html>

<head>
    <LINK REL=StyleSheet HREF="../styles/estilo.css" TYPE="text/css" MEDIA=screen>
    <title>visualizar</title>
    <meta charset="UTF-8">
    <script type="text/javascript" src="../js/ajax.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


</head>

<body>

    <h1>LIBRO DE VISITAS</h1>
    <h2>A continuacion se mostraran todos los comentarios recibidos <?php if (isset($_GET['fuser'])) echo "de los usuarios con nombre " . $_GET['fuser'];
                                                                    else echo "de todos los usuarios" ?>, pulse <a href="../html/modelo.html">aqui</a> para volver al menu principal</h2>
    <form action="visualizar.php">
        <label for="fuser">Si quiere ver los comentarios de un usuario en concreto introduzca su email:</label><br><br>
        <input type="text" id="fuser" name="fuser" required><br><br>
        <input class="boton" type="submit" value="Imprimir por nombre"> <input class="boton" type="button" onclick="location.href = 'visualizar.php'" value="Imprimir todos">
    </form>
    <br><br>
    <?php
    $xml = simplexml_load_file("../xml/visitas.xml");
    if (!$xml) die('Error al cargar el XML');

    for ($i = $xml->attributes()->ult_id; $i > 0; $i -= 1) {
        $visita = $xml->visita[$i - 1];
        if (!isset($_GET['fuser']) || (isset($_GET['fuser']) && (strpos(strtolower($visita->children()->nombre), strtolower($_GET['fuser'])) !== false))) {
            echo '<table>
        <tr class="cabecera">
            <td>Fecha: ';
            echo  htmlspecialchars($visita->children()->fecha);
            echo '</td>
            <td>Nombre: ';
            echo htmlspecialchars($visita->children()->nombre);
            echo '</td>
            <td>Email: ';
            if ($visita->children()->email->attributes()->mostrar == "si")
                echo htmlspecialchars($visita->children()->email);
            else echo 'Oculto';
            echo '</td>
        </tr>
        <tr class="resto">
            <td colspan="3">';
            echo "<div id='text" . $i . "'>";
            echo
                htmlspecialchars(substr($visita->children()->comentario, 0, 50));
            if (strlen($visita->children()->comentario) > 50) echo "  <a style='color:blue' onClick='showAll(" . $i . ");'>[+]</a>";
            echo '</div></tr>
    </table><br><br>';
        }
    }
    ?>


</body>

</html>