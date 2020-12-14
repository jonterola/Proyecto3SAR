<?php if (!isset($_SESSION))
    session_start(); ?>
<!DOCTYPE html>
<html>

<?php
include '../html/Header.html';
include '../php/Menu.php';
?>

<body>
    <section id="s1">
        <div>

            <form id='fproduct' name='fproduct' method="POST" enctype='multipart/form-data' action=''>
                <h2>Añadir oferta</h2><br />
                <table>

                    <tr>
                        <td>Código de producto:</td>
                        <td> <input type="text" size="50" id="codigo" name="codigo" required></td>
                    </tr>
                    <tr>
                        <td>Descuento:</td>
                        <td> <input type="text" size="5" id="oferta" name="oferta" pattern="[0-9]{1,2}" title="El descuento debe ser un valor entre 0 y 99" required>%</td>
                    </tr>
                    <tr>
                        <td><input type="submit" id="submit" value="Añadir oferta"> <input type="reset" id="reset" value="Limpiar"></td>
                    </tr>
                </table>
            </form>
            
        </div>


        <?php
        if (isset($_REQUEST['codigo'])) {
            $xml = simplexml_load_file('../xml/productos.xml');

            $encontrado = false;
            $cont = 0;

            foreach ($xml->producto as $producto) {
                if ($producto['id'] == $_REQUEST['codigo']) {
                    $producto->oferta = $_REQUEST['oferta'];
                    echo "<span id='mensajeOferta' style='margin:auto; display:table;'>Oferta añadida correctamente.</span>";
                    $encontrado = true;
                    break;
                }
                $cont++;
            }
            if ($encontrado == false)
                echo "<span id='mensajeOferta' style='margin:auto; display:table;'>No se ha encontrado ningún producto con ese código.</span>";

            $xml->asXML('../xml/productos.xml');
        }
        ?>
    </section>
    <?php include '../html/Footer.html'; ?>


</html>