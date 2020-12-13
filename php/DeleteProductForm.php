<!DOCTYPE html>
<html>

<head>
</head>
<?php
include '../html/Header.html';
include '../php/Menu.php';
 ?>
<body>
	<section id="s1">
		<div>
			
			<form id='fproduct' name='fproduct' method="POST" enctype='multipart/form-data' action=''>
			<h2>Eliminar producto</h2><br />
				<table>
					
					<tr>
						<td>Código de producto:</td><td> <input type="text" size="50" id="codigo" name="codigo"></td>
					</tr>
					<tr>
						<td><input type="submit" id="submit" value="Eliminar"> <input type="reset" id="reset" value="Limpiar"></td>
					</tr>
				</table>
			</form>
        </div>
        

        <?php
        if(isset($_REQUEST['codigo'])){
            $xml = simplexml_load_file('../xml/productos.xml');

            $encontrado = false;
            $cont = 0;

            foreach($xml->producto as $producto){
                if($producto['id'] == $_REQUEST['codigo']){
                    unset($xml->producto[$cont]);
                    if($_REQUEST['codigo'] == $xml['lastid'] &&  sizeof($xml->xpath("/productos/producto[last()]"))!=0){
                        $xml['lastid'] = ($xml->xpath("/productos/producto[last()]"))[0]['id'];
                    }else if(sizeof($xml->xpath("/productos/producto[last()]")) == 0){
                        $xml['lastid'] = '0';
                    }
                    echo "<span style='margin:auto; display:table;'>Producto eliminado correctamente.</span>";
                    $encontrado = true;
                    break;
                }
                $cont++;
            }
            if ($encontrado == false)
                echo "<span style='margin:auto; display:table;'>No se ha encontrado ningún producto con ese código.</span>";

            $xml->asXML('../xml/productos.xml');

        }
        ?>
	</section>
	<?php include '../html/Footer.html';?>
</body>

</html>